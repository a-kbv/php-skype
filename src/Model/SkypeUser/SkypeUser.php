<?php

namespace Akbv\PhpSkype\Model\SkypeUser;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeUser extends \Akbv\PhpSkype\Model\Base
{
    /**
     * @var string
     */
    private $about;

    /**
     * @var string
     */
    private $avatarUrl;

    /**
     * @var string
     */
    private $birthday;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string[]
     */
    private $emails;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $homepage;

    /**
     * @var string
     */
    private $jobTitle;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $mood;

    /**
     * @var string
     */
    private $phoneHome;

    /**
     * @var string
     */
    private $phoneMobile;

    /**
     * @var string
     */
    private $phoneOffice;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $richMood;

    /**
     * @var string
     */
    private $username;

    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $data['about'] = $this->about;
        $data['avatarUrl'] = $this->avatarUrl;
        $data['birthday'] = $this->birthday;
        $data['city'] = $this->city;
        $data['country'] = $this->country;
        $data['emails'] = $this->emails;
        $data['firstname'] = $this->firstName;
        $data['gender'] = $this->gender;
        $data['homepage'] = $this->homepage;
        $data['jobtitle'] = $this->jobTitle;
        $data['language'] = $this->language;
        $data['lastname'] = $this->lastName;
        $data['mood'] = $this->mood;
        $data['phoneHome'] = $this->phoneHome;
        $data['phoneMobile'] = $this->phoneMobile;
        $data['phoneOffice'] = $this->phoneOffice;
        $data['province'] = $this->province;
        $data['richMood'] = $this->richMood;
        $data['username'] = $this->username;

        return $data;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->about = !empty($raw->about) ? $raw->about : null;
        $this->avatarUrl = !empty($raw->avatarUrl) ? $raw->avatarUrl : null;
        $this->birthday = !empty($raw->birthday) ? $raw->birthday : null;
        $this->city = !empty($raw->city) ? $raw->city : null;
        $this->country = !empty($raw->country) ? $raw->country : null;
        $this->emails = !empty($raw->emails) ? $raw->emails : null;
        $this->firstName = !empty($raw->firstname) ? $raw->firstname : null;
        $this->gender = !empty($raw->gender) ? $raw->gender : null;
        $this->homepage = !empty($raw->homepage) ? $raw->homepage : null;
        $this->jobTitle = !empty($raw->jobtitle) ? $raw->jobtitle : null;
        $this->language = !empty($raw->language) ? $raw->language : null;
        $this->lastName = !empty($raw->lastname) ? $raw->lastname : null;
        $this->mood = !empty($raw->mood) ? $raw->mood : null;
        $this->phoneHome = !empty($raw->phoneHome) ? $raw->phoneHome : null;
        $this->phoneMobile = !empty($raw->phoneMobile) ? $raw->phoneMobile : null;
        $this->phoneOffice = !empty($raw->phoneOffice) ? $raw->phoneOffice : null;
        $this->province = !empty($raw->province) ? $raw->province : null;
        $this->richMood = !empty($raw->richMood) ? $raw->richMood : null;
        $this->username = !empty($raw->username) ? $raw->username : null;
    }



    /**
     * Get the value of about
     *
     * @return  string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set the value of about
     *
     * @param  string  $about
     *
     * @return  self
     */
    public function setAbout(string $about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get the value of avatarUrl
     *
     * @return  string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Set the value of avatarUrl
     *
     * @param  string  $avatarUrl
     *
     * @return  self
     */
    public function setAvatarUrl(string $avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Get the value of birthday
     *
     * @return  string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the value of birthday
     *
     * @param  string  $birthday
     *
     * @return  self
     */
    public function setBirthday(string $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the value of city
     *
     * @return  string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @param  string  $city
     *
     * @return  self
     */
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of country
     *
     * @return  string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @param  string  $country
     *
     * @return  self
     */
    public function setCountry(string $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of emails
     *
     * @return  string[]
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set the value of emails
     *
     * @param  string[]  $emails
     *
     * @return  self
     */
    public function setEmails(array $emails)
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Get the value of firstName
     *
     * @return  string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param  string  $firstName
     *
     * @return  self
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of gender
     *
     * @return  string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @param  string  $gender
     *
     * @return  self
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of homepage
     *
     * @return  string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set the value of homepage
     *
     * @param  string  $homepage
     *
     * @return  self
     */
    public function setHomepage(string $homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get the value of jobTitle
     *
     * @return  string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set the value of jobTitle
     *
     * @param  string  $jobTitle
     *
     * @return  self
     */
    public function setJobTitle(string $jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get the value of language
     *
     * @return  string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the value of language
     *
     * @param  string  $language
     *
     * @return  self
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return  string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param  string  $lastName
     *
     * @return  self
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of mood
     *
     * @return  string
     */
    public function getMood()
    {
        return $this->mood;
    }

    /**
     * Set the value of mood
     *
     * @param  string  $mood
     *
     * @return  self
     */
    public function setMood(string $mood)
    {
        $this->mood = $mood;

        return $this;
    }

    /**
     * Get the value of phoneHome
     *
     * @return  string
     */
    public function getPhoneHome()
    {
        return $this->phoneHome;
    }

    /**
     * Set the value of phoneHome
     *
     * @param  string  $phoneHome
     *
     * @return  self
     */
    public function setPhoneHome(string $phoneHome)
    {
        $this->phoneHome = $phoneHome;

        return $this;
    }

    /**
     * Get the value of phoneMobile
     *
     * @return  string
     */
    public function getPhoneMobile()
    {
        return $this->phoneMobile;
    }

    /**
     * Set the value of phoneMobile
     *
     * @param  string  $phoneMobile
     *
     * @return  self
     */
    public function setPhoneMobile(string $phoneMobile)
    {
        $this->phoneMobile = $phoneMobile;

        return $this;
    }

    /**
     * Get the value of phoneOffice
     *
     * @return  string
     */
    public function getPhoneOffice()
    {
        return $this->phoneOffice;
    }

    /**
     * Set the value of phoneOffice
     *
     * @param  string  $phoneOffice
     *
     * @return  self
     */
    public function setPhoneOffice(string $phoneOffice)
    {
        $this->phoneOffice = $phoneOffice;

        return $this;
    }

    /**
     * Get the value of province
     *
     * @return  string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set the value of province
     *
     * @param  string  $province
     *
     * @return  self
     */
    public function setProvince(string $province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get the value of richMood
     *
     * @return  string
     */
    public function getRichMood()
    {
        return $this->richMood;
    }

    /**
     * Set the value of richMood
     *
     * @param  string  $richMood
     *
     * @return  self
     */
    public function setRichMood(string $richMood)
    {
        $this->richMood = $richMood;

        return $this;
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
}
