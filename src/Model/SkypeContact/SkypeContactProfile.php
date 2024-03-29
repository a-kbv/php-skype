<?php

namespace Akbv\PhpSkype\Model\SkypeContact;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeContactProfile extends \Akbv\PhpSkype\Model\Base
{
    // "profile": {
    //     "avatar_url": "https://avatar.skype.com/v1/avatars/echo123?auth_key=242200701",
    //     "locations": [{ "type": "home", "country": "gb" }],
    //     "name": { "first": "Echo / Sound Test Service", "surname": "." },
    //     "about": "Hi, this is Skype automatic sound test service. Add me to your contact list and give me a call to test your sound setup. See https://www.skype.com/go/help for more assistance. Thank you.",
    //     "language": "en",
    //     "website": "https://www.skype.com/go/help",
    //     "skype_handle": "echo123"
    //   },

    /**
     * The avatar URL for this user.
     * avatar_url
     * @var string
     */
    private $avatarUrl;

    /**
     * The locations for this user.
     * locations
     * @var string[]
     */
    private $locations;

    /**
     * The name for this user.
     * name
     * @var \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfileName
     */
    private $name;

    /**
     * The about for this user.
     * about
     * @var string
     */
    private $about;

    /**
     * The language for this user.
     * language
     * @var string
     */
    private $language;

    /**
     * The website for this user.
     * website
     * @var string
     */
    private $website;

    /**
     * The skype handle for this user.
     * skype_handle
     * @var string
     */
    private $skypeHandle;


    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $data['avatar_url'] = $this->avatarUrl;
        $data['locations'] = $this->locations;
        $data['name'] = !empty($this->name) ? $this->name->toArray() : null;
        $data['about'] = $this->about;
        $data['language'] = $this->language;
        $data['website'] = $this->website;
        $data['skype_handle'] = $this->skypeHandle;
        return $data;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->avatarUrl = !empty($raw->avatar_url) ? $raw->avatar_url : null;
        $this->locations = !empty($raw->locations) ? $raw->locations : null;
        $this->name = !empty($raw->name) ? new \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfileName($raw->name) : new \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfileName((object)[]);
        $this->about = !empty($raw->about) ? $raw->about : null;
        $this->language = !empty($raw->language) ? $raw->language : null;
        $this->website = !empty($raw->website) ? $raw->website : null;
        $this->skypeHandle = !empty($raw->skype_handle) ? $raw->skype_handle : null;
    }



    /**
     * Get avatar_url
     *
     * @return  string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Set avatar_url
     *
     * @param  string  $avatarUrl  avatar_url
     *
     * @return  self
     */
    public function setAvatarUrl(string $avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Get locations
     *
     * @return  string[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Set locations
     *
     * @param  string[]  $locations  locations
     *
     * @return  self
     */
    public function setLocations(array $locations)
    {
        $this->locations = $locations;

        return $this;
    }

    /**
     * Get name
     *
     * @return  \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfileName
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfileName  $name  name
     *
     * @return  self
     */
    public function setName(\Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfileName $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get about
     *
     * @return  string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set about
     *
     * @param  string  $about  about
     *
     * @return  self
     */
    public function setAbout(string $about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get language
     *
     * @return  string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param  string  $language  language
     *
     * @return  self
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get website
     *
     * @return  string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set website
     *
     * @param  string  $website  website
     *
     * @return  self
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get skype_handle
     *
     * @return  string
     */
    public function getSkypeHandle()
    {
        return $this->skypeHandle;
    }

    /**
     * Set skype_handle
     *
     * @param  string  $skypeHandle  skype_handle
     *
     * @return  self
     */
    public function setSkypeHandle(string $skypeHandle)
    {
        $this->skypeHandle = $skypeHandle;

        return $this;
    }
}
