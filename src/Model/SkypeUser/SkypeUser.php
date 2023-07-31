<?php

namespace Akbv\PhpSkype\Model\SkypeUser;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeUser
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
     * Get the value of avatarUrl
     *
     * @return  string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
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
     * Get the value of city
     *
     * @return  string
     */
    public function getCity()
    {
        return $this->city;
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
     * Get the value of emails
     *
     * @return  string[]
     */
    public function getEmails()
    {
        return $this->emails;
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
     * Get the value of gender
     *
     * @return  string
     */
    public function getGender()
    {
        return $this->gender;
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
     * Get the value of jobTitle
     *
     * @return  string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
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
     * Get the value of lastName
     *
     * @return  string
     */
    public function getLastName()
    {
        return $this->lastName;
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
     * Get the value of phoneHome
     *
     * @return  string
     */
    public function getPhoneHome()
    {
        return $this->phoneHome;
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
     * Get the value of phoneOffice
     *
     * @return  string
     */
    public function getPhoneOffice()
    {
        return $this->phoneOffice;
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
     * Get the value of richMood
     *
     * @return  string
     */
    public function getRichMood()
    {
        return $this->richMood;
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
}
