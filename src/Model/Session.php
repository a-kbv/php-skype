<?php

namespace Akbv\PhpSkype\Model;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Session extends \Akbv\PhpSkype\Model\Base
{
    /**
     * Algo to recognize cache name.
     */
    public const CACHE_ALGO = 'sha512';

    /**
     * @var bool
     */
    private $isDirty = false;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $sessionDir;

    /**
     * @var string
     */
    private $securityToken;

    /**
     * @var string
     */
    private $skypeToken;

    /**
     * @var \DateTime|null
     */
    private $skypeTokenExpires;

    /**
     * @var string
     */
    private $registrationToken;

    /**
     * @var \DateTime|null
     */
    private $registrationTokenExpires;

    /**
     * @var string
     */
    private $endpointId;

    /**
     * @var string
     */
    private $messengerHost;

    /**
     * Subscribed to events.
     * @var bool
     */
    private $subscribed = false;

    public function __construct(string $username, string $password, string $sessionDir = null)
    {
        $this->username = $username;
        $this->password = md5($password);
        $this->sessionDir = $sessionDir;
        $this->loadSession();
    }

    /**
     * Try to retrieve from storage cached data and populate Session.
     * If cached data are absent or expired, then skip population.
     * @throws SessionFileLoadException
     */
    public function loadSession(): void
    {
        if ($this->loadSessionData()) {
            $session = $this->loadSessionData();
            if ($session->getCreatedAt() < new \DateTime()) {
                $session = $this->destroySession();
            }

        } else {
            $session = $this;
        }
    }

    public function toArray(): array // function to convert object properties to an array representation
    {
        return [
            'createdAt' => $this->getCreatedAt()->format('Y-m-d H:i:s'),
            'isDirty' => $this->getIsDirty(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'sessionDir' => $this->getSessionDir(),
            'securityToken' => $this->getSecurityToken(),
            'skypeToken' => $this->getSkypeToken(),
            'skypeTokenExpires' => $this->getSkypeTokenExpires()->format('Y-m-d H:i:s'),
            'registrationToken' => $this->getRegistrationToken(),
            'registrationTokenExpires' => $this->getRegistrationTokenExpires()->format('Y-m-d H:i:s'),
            'endpointId' => $this->getEndpointId(),
            'subscribed' => $this->getSubscribed(),
            'messengerHost' => $this->getMessengerHost(),
        ];
    }

    public function fromArray(array $array): self // function to load object properties from an array
    {
        if (isset($array['createdAt'])) {
            $this->setCreatedAt(new \DateTime($array['createdAt']));
        }
        if (isset($array['isDirty'])) {
            $this->setIsDirty($array['isDirty']);
        }
        if (isset($array['username'])) {
            $this->setUsername($array['username']);
        }
        if (isset($array['password'])) {
            $this->setPassword($array['password']);
        }
        if (isset($array['sessionDir'])) {
            $this->setSessionDir($array['sessionDir']);
        }
        if (isset($array['securityToken'])) {
            $this->setSecurityToken($array['securityToken']);
        }
        if (isset($array['skypeToken'])) {
            $this->setSkypeToken($array['skypeToken']);
        }
        if (isset($array['skypeTokenExpires'])) {
            $this->setSkypeTokenExpires(new \DateTime($array['skypeTokenExpires']));
        }
        if (isset($array['registrationToken'])) {
            $this->setRegistrationToken($array['registrationToken']);
        }
        if (isset($array['registrationTokenExpires'])) {
            $this->setRegistrationTokenExpires(new \DateTime($array['registrationTokenExpires']));
        }
        if (isset($array['endpointId'])) {
            $this->setEndpointId($array['endpointId']);
        }
        if (isset($array['subscribed'])) {
            $this->setSubscribed($array['subscribed']);
        }
        if (isset($array['messengerHost'])) {
            $this->setMessengerHost($array['messengerHost']);
        }
        return $this;
    }

    public function saveSession()
    {
        $this->prepareSessionDir();
        $sessionFilePath = $this->getSessionDir() . '/' . $this->buildSessionFileName();
        $this->setCreatedAt(new \DateTime('+6 hours'));
        $jsonData = json_encode($this->toArray(), JSON_PRETTY_PRINT);
        if (false === file_put_contents($sessionFilePath, $jsonData)) {
            throw new \Akbv\PhpSkype\Exception\SessionFileSaveException($sessionFilePath);
        }

    }

    private function loadSessionData()
    {
        $sessionFilePath = $this->getSessionDir() . '/' . $this->buildSessionFileName();
        if (!file_exists($sessionFilePath)) {
            return null;
        }
        if (!file_get_contents($sessionFilePath)) {
            throw new \Akbv\PhpSkype\Exception\SessionFileLoadException($sessionFilePath);
        }
        $jsonData = file_get_contents($sessionFilePath);
        $this->fromArray(json_decode($jsonData, true));
        return $this;

    }

    /**
     * Destroy account session and stored cache.
     * @param Session $session
     * @throws SessionFileRemoveException
     */
    public function destroySession(): void
    {
        $this->removeSessionFile();
    }

    private function removeSessionFile()
    {
        $sessionFilePath = $this->getSessionDir() . '/' . $this->buildSessionFileName();
        if (false === unlink($sessionFilePath)) {
            throw new \Akbv\PhpSkype\Exception\SessionFileRemoveException($sessionFilePath);
        }
    }

    /**
     * @throws SessionDirCreateException
     */
    private function prepareSessionDir(): void
    {
        if (!file_exists($this->sessionDir) && !mkdir($this->sessionDir)) {
            throw new \Akbv\PhpSkype\Exception\SessionDirCreateException($this->sessionDir);
        }
    }

    /**
     * Generate file path for cached data for @see Session
     * @return string
     */
    private function buildSessionFileName()
    {
        $accountHash = hash(self::CACHE_ALGO, $this->getUsername());
        $result = sprintf('skypeSession_%s', $accountHash);
        return $result;
    }

    /**
     * Get the value of username
     *
     * @return  string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of sessionDir
     *
     * @return  string
     */
    public function getSessionDir()
    {
        return $this->sessionDir;
    }

    /**
     * Set the value of sessionDir
     *
     * @param  string  $sessionDir
     *
     * @return  self
     */
    public function setSessionDir(string $sessionDir)
    {
        $this->sessionDir = $sessionDir;

        return $this;
    }

    /**
     * Get the value of securityToken
     *
     * @return  string
     */
    public function getSecurityToken()
    {
        return $this->securityToken;
    }

    /**
     * Set the value of securityToken
     *
     * @param  string  $securityToken
     *
     * @return  self
     */
    public function setSecurityToken(string $securityToken)
    {
        $this->securityToken = $securityToken;

        return $this;
    }

    /**
     * Get the value of skypeToken
     *
     * @return  string
     */
    public function getSkypeToken()
    {
        return $this->skypeToken;
    }

    /**
     * Set the value of skypeToken
     *
     * @param  string  $skypeToken
     *
     * @return  self
     */
    public function setSkypeToken(string $skypeToken)
    {
        $this->skypeToken = $skypeToken;

        return $this;
    }

    /**
     * Get the value of skypeTokenExpires
     *
     * @return  \DateTime|null
     */
    public function getSkypeTokenExpires()
    {
        return $this->skypeTokenExpires;
    }

    /**
     * Set the value of skypeTokenExpires
     *
     * @param  \DateTime|null  $skypeTokenExpires
     *
     * @return  self
     */
    public function setSkypeTokenExpires($skypeTokenExpires)
    {
        $this->skypeTokenExpires = $skypeTokenExpires;

        return $this;
    }

    /**
     * Get the value of registrationToken
     *
     * @return  string
     */
    public function getRegistrationToken()
    {
        return $this->registrationToken;
    }

    /**
     * Set the value of registrationToken
     *
     * @param  string  $registrationToken
     *
     * @return  self
     */
    public function setRegistrationToken(string $registrationToken)
    {
        $this->registrationToken = $registrationToken;

        return $this;
    }

    /**
     * Get the value of registrationTokenExpires
     *
     * @return  \DateTime|null
     */
    public function getRegistrationTokenExpires()
    {
        return $this->registrationTokenExpires;
    }

    /**
     * Set the value of registrationTokenExpires
     *
     * @param  \DateTime|null  $registrationTokenExpires
     *
     * @return  self
     */
    public function setRegistrationTokenExpires($registrationTokenExpires)
    {
        $this->registrationTokenExpires = $registrationTokenExpires;

        return $this;
    }

    /**
     * Get the value of endpointId
     *
     * @return  string
     */
    public function getEndpointId()
    {
        return $this->endpointId;
    }

    /**
     * Set the value of endpointId
     *
     * @param  string  $endpointId
     *
     * @return  self
     */
    public function setEndpointId(string $endpointId)
    {
        $this->endpointId = $endpointId;

        return $this;
    }

    /**
     * Get the value of messengerHost
     *
     * @return  string
     */
    public function getMessengerHost()
    {
        return $this->messengerHost;
    }

    /**
     * Set the value of messengerHost
     *
     * @param  string  $messengerHost
     *
     * @return  self
     */
    public function setMessengerHost(string $messengerHost)
    {
        $this->messengerHost = $messengerHost;

        return $this;
    }


    /**
     * Get the value of createdAt
     *
     * @return  \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param  \DateTime  $createdAt
     *
     * @return  self
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of isDirty
     *
     * @return  bool
     */
    public function getIsDirty()
    {
        return $this->isDirty;
    }

    /**
     * Set the value of isDirty
     *
     * @param  bool  $isDirty
     *
     * @return  self
     */
    public function setIsDirty(bool $isDirty)
    {
        $this->isDirty = $isDirty;

        return $this;
    }

    /**
     * Get subscribed to events.
     *
     * @return  bool
     */
    public function getSubscribed()
    {
        return $this->subscribed;
    }

    /**
     * Set subscribed to events.
     *
     * @param  bool  $subscribed  Subscribed to events.
     *
     * @return  self
     */
    public function setSubscribed(bool $subscribed)
    {
        $this->subscribed = $subscribed;

        return $this;
    }
}
