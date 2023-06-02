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
     * First and middle names of the user.
     * @var string[]
     */
    private $name;

    /**
     * The Skype handle of the user.
     * @var string
     */
    private $skypeHandle;

    /**
     * The URL of the user's avatar.
     * @var string
     */
    private $avatarUrl;

    /**
     * The birthday of the user.
     * @var string
     */
    private $birthday;

    /**
     * The gender of the user.
     * @var string
     */
    private $gender;

    /**
     * The locations of the user.
     * @var string[]
     */
    private $locations;

    /**
     * The language of the user.
     * @var string
     */
    private $language;

    /**
     * The mood of the user.
     * @var string
     */
    private $mood;

    /**
     * The phones of the user.
     * @var string[]
     */
    private $phones;

    /**
     * The about of the user.
     * @var string
     */
    private $about;

    /**
     * The website of the user.
     * @var string
     */
    private $website;

    /**
     * Constructor.
     * @param mixed[] $raw raw data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
    }

    /**
     * Get first and middle names of the user.
     *
     * @return  string[]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set first and middle names of the user.
     *
     * @param  string[]  $name  First and middle names of the user.
     *
     * @return  self
     */
    public function setName(array $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the Skype handle of the user.
     *
     * @return  string
     */
    public function getSkypeHandle()
    {
        return $this->skypeHandle;
    }

    /**
     * Set the Skype handle of the user.
     *
     * @param  string  $skypeHandle  The Skype handle of the user.
     *
     * @return  self
     */
    public function setSkypeHandle(string $skypeHandle)
    {
        $this->skypeHandle = $skypeHandle;

        return $this;
    }

    /**
     * Get the URL of the user's avatar.
     *
     * @return  string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Set the URL of the user's avatar.
     *
     * @param  string  $avatarUrl  The URL of the user's avatar.
     *
     * @return  self
     */
    public function setAvatarUrl(string $avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Get the birthday of the user.
     *
     * @return  string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the birthday of the user.
     *
     * @param  string  $birthday  The birthday of the user.
     *
     * @return  self
     */
    public function setBirthday(string $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the gender of the user.
     *
     * @return  string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the gender of the user.
     *
     * @param  string  $gender  The gender of the user.
     *
     * @return  self
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the locations of the user.
     *
     * @return  string[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Set the locations of the user.
     *
     * @param  string[]  $locations  The locations of the user.
     *
     * @return  self
     */
    public function setLocations(array $locations)
    {
        $this->locations = $locations;

        return $this;
    }

    /**
     * Get the language of the user.
     *
     * @return  string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the language of the user.
     *
     * @param  string  $language  The language of the user.
     *
     * @return  self
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the mood of the user.
     *
     * @return  string
     */
    public function getMood()
    {
        return $this->mood;
    }

    /**
     * Set the mood of the user.
     *
     * @param  string  $mood  The mood of the user.
     *
     * @return  self
     */
    public function setMood(string $mood)
    {
        $this->mood = $mood;

        return $this;
    }

    /**
     * Get the phones of the user.
     *
     * @return  string[]
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Set the phones of the user.
     *
     * @param  string[]  $phones  The phones of the user.
     *
     * @return  self
     */
    public function setPhones(array $phones)
    {
        $this->phones = $phones;

        return $this;
    }

    /**
     * Get the about of the user.
     *
     * @return  string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set the about of the user.
     *
     * @param  string  $about  The about of the user.
     *
     * @return  self
     */
    public function setAbout(string $about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get the website of the user.
     *
     * @return  string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set the website of the user.
     *
     * @param  string  $website  The website of the user.
     *
     * @return  self
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;

        return $this;
    }
}
