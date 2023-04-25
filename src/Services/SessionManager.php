<?php

namespace Akbv\PhpSkype\Services;

use Akbv\PhpSkype\Exceptions\AccountCacheFileSaveException;
use Akbv\PhpSkype\Exceptions\SessionDirCreateException;
use Akbv\PhpSkype\Exceptions\SessionFileLoadException;
use Akbv\PhpSkype\Exceptions\SessionFileRemoveException;
use Akbv\PhpSkype\Factories\SessionFactory;
use Akbv\PhpSkype\Models\Account;
use Akbv\PhpSkype\Models\Session;
use DateTime;
use Random\Engine\Secure;

/**
 * Class helps to manage cached data for @see Session.
 * Cached data are stored in files for fast access.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class SessionManager
{
    /**
     * Algo to recognize cache name.
     */
    public const CACHE_ALGO = 'sha512';

    /**
     * Algo to encode/decode session.
     */
    public const ENCRYPT_ALGO = 'AES-128-ECB';

    /**
     * Store caches for sessions.
     *
     * @var string
     */
    private $sessionDir;

    /**
     * Session encrypting key.
     *
     * @var string
     */
    private $secret;

    public function __construct(string $sessionDir, string $secret)
    {
        $this->sessionDir = $sessionDir;
        $this->secret = $secret;
    }

    /**
     * Save session data for next fast access.
     * Set expiration time.
     * @throws AccountCacheFileSaveException
     * @throws SessionDirCreateException
     */
    public function saveSession(Session $session, \DateTime $now = null): void
    {
        if (null === $now) {
            $now = new \DateTime();
        }
        $now->modify('+6 hours');
        $session->setExpiry($now);
        $this->saveSessionData($session->getAccount(), SessionFactory::buildDataFromSession($session));
    }

    /**
     * Try to retrieve from storage cached data and populate Session.
     * If cached data are absent or expired, then skip population.
     * @throws SessionFileLoadException
     */
    public function loadAccountSession(Account $account): Session
    {
        if (($data = $this->loadSessionData($account))) {
            $session = SessionFactory::buildSessionFromData($account, $data);
            if ($session->getExpiry() < new DateTime()) {
                $this->removeSession($session);
                $session = new Session($account);
            }
        } else {
            $session = new Session($account);
        }
        return $session;
    }

    /**
     * Destroy account session and stored cache.
     * @param Session $session
     * @throws SessionFileRemoveException
     */
    public function removeSession(Session $session): void
    {
        $session->reset();
        $this->removeSessionFile($session->getAccount());
    }

    /**
     * Generate file path for cached data for @see Session
     * @param Account $account
     * @return string
     */
    private function buildAccountSessionFileName(Account $account)
    {
        $accountHash = hash(self::CACHE_ALGO, $account->getUsername());
        $result = sprintf('session_%s', $accountHash);
        return $result;
    }

    /**
     * Remove account session file.
     * @param Account $account
     * @throws SessionFileRemoveException
     */
    private function removeSessionFile(Account $account): void
    {
        $sessionFileName = $this->buildAccountSessionFileName($account);
        $sessionFilePath = $this->sessionDir . '/' . $sessionFileName;
        if (false === unlink($sessionFilePath)) {
            throw new SessionFileRemoveException($sessionFilePath);
        }
    }

    /**
     * @throws SessionDirCreateException
     */
    private function prepareSessionDir(): void
    {
        if (!file_exists($this->sessionDir) && !mkdir($this->sessionDir)) {
            throw new SessionDirCreateException($this->sessionDir);
        }
    }


    /**
     * Encrypt data by secret from the Env to the file.
     * @param Account $account
     * @param mixed[] $data
     * @throws AccountCacheFileSaveException
     * @throws SessionDirCreateException
     */
    private function saveSessionData(Account $account, array $data): void
    {
        $this->prepareSessionDir();
        $sessionFileName = $this->buildAccountSessionFileName($account);
        $sessionFilePath = $this->sessionDir . '/' . $sessionFileName;
        $dataJson = json_encode($data, JSON_PRETTY_PRINT);
        $encryptedData = base64_encode(openssl_encrypt($dataJson, self::ENCRYPT_ALGO, $this->secret));
        if (false === file_put_contents($sessionFilePath, $encryptedData)) {
            throw new AccountCacheFileSaveException($sessionFilePath);
        }
    }

    /**
     * Decrypt encrypted text from the file by secret from the Env.
     * @param Account $account
     * @return mixed[]|null
     * @throws SessionFileLoadException
     */
    private function loadSessionData(Account $account): ?array
    {
        $sessionFileName = $this->buildAccountSessionFileName($account);
        $sessionFilePath = $this->sessionDir . '/' . $sessionFileName;
        if (!file_exists($sessionFilePath)) {
            return null;
        }
        if (!($encryptedData = file_get_contents($sessionFilePath))) {
            throw new SessionFileLoadException($sessionFilePath);
        }
        $dataJson = openssl_decrypt(base64_decode($encryptedData), self::ENCRYPT_ALGO, $this->secret);
        $data = json_decode($dataJson, true);
        return $data;
    }
}
