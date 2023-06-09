<?php

namespace Akbv\PhpSkype\Models\Users;

/**
 * The name of a user or contact.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Profile extends \Akbv\PhpSkype\Models\Base
{
    /**
     * The avatar URL for this user.
     * @var string
     */
    private $avatar_url;

    /**
     * The avatar of the user.
     * @var string
     */
    private $avatarUrl;

    /**
     * Username of the user.
     * @var string
     */
    private $username;

    /**
     * Username of the user.
     * @var string
     */
    private $firstname;

    /**
     * Username of the user.
     * @var string
     */
    private $lastname;

    /**
     * The birthday for this user.
     * @var string
     */
    private $birthday;

    /**
     * The gender for this user.
     * @var string
     */
    private $gender;

    /**
     * The mood for this user.
     * @var string
     */
    private $mood;

    /**
     * The name for this user.
     * @var string[]
     */
    private $name;

    /**
     * The about for this user.
     * @var string
     */
    private $about;

    /**
     * The skype handle for this user.
     * @var string
     */
    private $skype_handle;

    /**
     * The locations for this user.
     * @var string[]
     */
    private $locations;

    /**
     * The language for this user.
     * @var string
     */
    private $language;

    /**
     * The phones for this user.
     * @var string[]
     */
    private $phones;

    /**
     * The website for this user.
     * @var string
     */
    private $website;

    /**
     * Constructor.
     * @param mixed[] $data raw data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
    }

    /**
     * Get the avatar URL for this user.
     *
     * @return  string
     */
    public function getAvatar_url()
    {
        return $this->avatar_url;
    }

    /**
     * Set the avatar URL for this user.
     *
     * @param  string  $avatar_url  The avatar URL for this user.
     *
     * @return  self
     */
    public function setAvatar_url(string $avatar_url)
    {
        $this->avatar_url = $avatar_url;

        return $this;
    }

    /**
     * Get the birthday for this user.
     *
     * @return  string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the birthday for this user.
     *
     * @param  string  $birthday  The birthday for this user.
     *
     * @return  self
     */
    public function setBirthday(string $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the gender for this user.
     *
     * @return  string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the gender for this user.
     *
     * @param  string  $gender  The gender for this user.
     *
     * @return  self
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the mood for this user.
     *
     * @return  string
     */
    public function getMood()
    {
        return $this->mood;
    }

    /**
     * Set the mood for this user.
     *
     * @param  string  $mood  The mood for this user.
     *
     * @return  self
     */
    public function setMood(string $mood)
    {
        $this->mood = $mood;

        return $this;
    }

    /**
     * Get the name for this user.
     *
     * @return string[]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name for this user.
     *
     * @param string[] $name  The name for this user.
     *
     * @return  self
     */
    public function setName(array $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the about for this user.
     *
     * @return  string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set the about for this user.
     *
     * @param  string  $about  The about for this user.
     *
     * @return  self
     */
    public function setAbout(string $about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get the skype handle for this user.
     *
     * @return  string
     */
    public function getSkype_handle()
    {
        return $this->skype_handle;
    }

    /**
     * Set the skype handle for this user.
     *
     * @param  string  $skype_handle  The skype handle for this user.
     *
     * @return  self
     */
    public function setSkype_handle(string $skype_handle)
    {
        $this->skype_handle = $skype_handle;

        return $this;
    }

    /**
     * Get the locations for this user.
     *
     * @return  string[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Set the locations for this user.
     *
     * @param  string[] $locations  The locations for this user.
     *
     * @return  self
     */
    public function setLocations(array $locations)
    {
        $this->locations = $locations;

        return $this;
    }

    /**
     * Get the language for this user.
     *
     * @return  string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the language for this user.
     *
     * @param  string  $language  The language for this user.
     *
     * @return  self
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the phones for this user.
     *
     * @return string[]
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Set the phones for this user.
     *
     * @param  string[] $phones  The phones for this user.
     *
     * @return  self
     */
    public function setPhones(array $phones)
    {
        $this->phones = $phones;

        return $this;
    }

    /**
     * Get the website for this user.
     *
     * @return  string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set the website for this user.
     *
     * @param  string  $website  The website for this user.
     *
     * @return  self
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get the avatar of the user.
     *
     * @return  string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Set the avatar of the user.
     *
     * @param  string  $avatarUrl  The avatar of the user.
     *
     * @return  self
     */
    public function setAvatarUrl(string $avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Get username of the user.
     *
     * @return  string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username of the user.
     *
     * @param  string  $username  Username of the user.
     *
     * @return  self
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username of the user.
     *
     * @return  string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set username of the user.
     *
     * @param  string  $firstname  Username of the user.
     *
     * @return  self
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get username of the user.
     *
     * @return  string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set username of the user.
     *
     * @param  string  $lastname  Username of the user.
     *
     * @return  self
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }
}
