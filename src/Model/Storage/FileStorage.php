<?php
namespace Akbv\PhpSkype\Model\Storage;

use Akbv\PhpSkype\Exception\SessionDirCreateException;
use \Akbv\PhpSkype\Exception\SessionFileSaveException;
use \Akbv\PhpSkype\Exception\SessionFileLoadException;
use \Akbv\PhpSkype\Exception\SessionFileRemoveException;
use Akbv\PhpSkype\Model\Session;

class FileStorage extends AbstractStorage
{
    private $sessionDir;

    public function __construct(string $sessionDir)
    {
        $this->sessionDir = $sessionDir;
        $this->prepareSessionDir();
    }

    public function save(array $sessionData): void
    {
        $sessionFilePath = $this->sessionDir . '/' . $this->buildSessionFileName($sessionData['username']);
        $jsonData = json_encode($sessionData, JSON_PRETTY_PRINT);
        if (false === file_put_contents($sessionFilePath, $jsonData)) {
            throw new SessionFileSaveException($sessionFilePath);
        }
    }

    public function load(string $username): ?array
    {
        $sessionFilePath = $this->sessionDir . '/' . $this->buildSessionFileName($username);
        if (!file_exists($sessionFilePath)) {
            return null;
        }
        $jsonData = file_get_contents($sessionFilePath);
        return json_decode($jsonData, true);
    }

    public function delete(string $username): void
    {
        $sessionFilePath = $this->sessionDir . '/' . $this->buildSessionFileName($username);
        if (file_exists($sessionFilePath) && !unlink($sessionFilePath)) {
            throw new SessionFileRemoveException($sessionFilePath);
        }
    }

    private function buildSessionFileName(string $username): string
    {
        $accountHash = hash(Session::CACHE_ALGO, $username);
        return sprintf('skypeSession_%s', $accountHash);
    }

    private function prepareSessionDir(): void
    {
        if (!file_exists($this->sessionDir) && !mkdir($this->sessionDir, 0755, true)) {
            throw new SessionDirCreateException($this->sessionDir);
        }
    }
}
