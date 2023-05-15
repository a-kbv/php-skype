<?php

namespace Akbv\PhpSkype\Models;

/**
 * Class representing a contact in Skype
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Contact extends Base
{
    /**
     * The Skype ID of the contact
     *
     * @var string
     */
    private $personId;

    /**
     * The MRI (Microsoft Routing Identifier) of the contact
     *
     * @var string
     */
    private $mri;

    /**
     * The display name of the contact
     *
     * @var string
     */
    private $displayName;

    /**
     * The source of the display name (e.g. "profile")
     *
     * @var string
     */
    private $displayNameSource;

    /**
     * The profile information of the contact
     *
     * @var mixed[]
     */
    private $profile = [];

    /**
     * Whether the contact is authorized to communicate with the user
     *
     * @var bool
     */
    private $authorized;

    /**
     * Whether the contact is currently blocked by the user
     *
     * @var bool
     */
    private $blocked;

    /**
     * Whether the contact has been explicitly added by the user
     *
     * @var bool
     */
    private $explicit;

    /**
     * The date and time when the contact was added
     *
     * @var \DateTime
     */
    private $creationTime;

    /**
     * The relationship history of the contact
     *
     * @var mixed[]
     */
    private $relationshipHistory = [];

    /**
     * The agent information of the contact (if applicable)
     *
     * @var mixed[]
     */
    private $agent = [];

    /**
     * The suggested status of the contact (if applicable)
     *
     * @var bool|null
     */
    private $suggested;

    /**
     * The phone hashes of the contact (if applicable)
     *
     * @var mixed[]
     */
    private $phoneHashes = [];

    /**
     * Information about the contact
     * @var string
     */
    private $about;

    /**
     * The URL of the avatar of the contact
     * @var string
     */
    private $avatarUrl;

    /**
     * The birthday of the contact
     * @var string
     */
    private $birthday;

    /**
     * The city of the contact
     * @var string
     */
    private $city;

    /**
     * The country of the contact
     * @var string
     */
    private $country;

    /**
     * The emails of the contact
     * @var mixed[]
     */
    private $emails = [];

    /**
     * The first name of the contact
     * @var string
     */
    private $firstName;

    /**
     * The gender of the contact
     * @var string
     */
    private $gender;

    /**
     * The homepage of the contact
     * @var string
     */
    private $homepage;

    /**
     * The job title of the contact
     * @var string
     */
    private $jobTitle;

    /**
     * The language of the contact
     * @var string
     */
    private $language;

    /**
     * The last name of the contact
     * @var string
     */
    private $lastName;

    /**
     * The mood of the contact
     * @var string
     */
    private $mood;

    /**
     * The namespace of the contact
     * @var string
     */
    private $namespace;

    /**
     * The home phone number of the contact
     * @var string
     */
    private $phoneHome;

    /**
     * The mobile phone number of the contact
     * @var string
     */
    private $phoneMobile;

    /**
     * The office phone number of the contact
     * @var string
     */
    private $phoneOffice;

    /**
     * The province of the contact
     * @var string
     */
    private $province;

    /**
     * The rich mood of the contact
     * @var string
     */
    private $richMood;

    /**
     * The username of the contact
     * @var string
     */
    private $username;

    /**
     * Constructor
     *
     * @param mixed[] $data The data to map to properties
     */
    public function __construct(array $data)
    {
        $this->personId = $data['person_id'] ?? null;
        $this->mri = $data['mri'] ?? null;
        $this->displayName = $data['display_name'] ?? null;
        $this->displayNameSource = $data['display_name_source'] ?? null;
        $this->profile = $data['profile'] ?? null;
        $this->authorized = $data['authorized'] ?? null;
        $this->blocked = $data['blocked'] ?? null;
        $this->explicit = $data['explicit'] ?? null;

        if (isset($data['creation_time'])) {
            $this->creationTime = new \DateTime($data['creation_time']);
        }

        $this->relationshipHistory = $data['relationship_history'] ?? null;
        $this->agent = $data['agent'] ?? null;
        $this->suggested = $data['suggested'] ?? null;
        $this->phoneHashes = $data['phone_hashes'] ?? null;
        $this->about = $data['about'] ?? null;
        $this->avatarUrl = $data['avatar_url'] ?? null;
        $this->birthday = $data['birthday'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->country = $data['country'] ?? null;
        $this->emails = $data['emails'] ?? null;
        $this->firstName = $data['firstname'] ?? null;
        $this->gender = $data['gender'] ?? null;
        $this->homepage = $data['homepage'] ?? null;
        $this->jobTitle = $data['jobtitle'] ?? null;
        $this->language = $data['language'] ?? null;
        $this->lastName = $data['lastname'] ?? null;
        $this->mood = $data['mood'] ?? null;
        $this->namespace = $data['namespace'] ?? null;
        $this->phoneHome = $data['phoneHome'] ?? null;
        $this->phoneMobile = $data['phoneMobile'] ?? null;
        $this->phoneOffice = $data['phoneOffice'] ?? null;
        $this->province = $data['province'] ?? null;
        $this->richMood = $data['richMood'] ?? null;
        $this->username = $data['username'] ?? null;


    }

    /**
     * Get the Skype ID of the contact
     *
     * @return  string
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set the Skype ID of the contact
     *
     * @param  string  $personId  The Skype ID of the contact
     *
     * @return  self
     */
    public function setPersonId(string $personId): self
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get the MRI (Microsoft Routing Identifier) of the contact
     *
     * @return  string
     */
    public function getMri()
    {
        return $this->mri;
    }

    /**
     * Set the MRI (Microsoft Routing Identifier) of the contact
     *
     * @param  string  $mri  The MRI (Microsoft Routing Identifier) of the contact
     *
     * @return  self
     */
    public function setMri(string $mri): self
    {
        $this->mri = $mri;

        return $this;
    }

    /**
     * Get the display name of the contact
     *
     * @return  string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set the display name of the contact
     *
     * @param  string  $displayName  The display name of the contact
     *
     * @return  self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get the source of the display name (e.g. "profile")
     *
     * @return  string
     */
    public function getDisplayNameSource()
    {
        return $this->displayNameSource;
    }

    /**
     * Set the source of the display name (e.g. "profile")
     *
     * @param  string  $displayNameSource  The source of the display name (e.g. "profile")
     *
     * @return  self
     */
    public function setDisplayNameSource(string $displayNameSource): self
    {
        $this->displayNameSource = $displayNameSource;

        return $this;
    }

    /**
     * Get the profile information of the contact
     *
     * @return  mixed[]
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set the profile information of the contact
     *
     * @param  mixed[]  $profile  The profile information of the contact
     *
     * @return  self
     */
    public function setProfile(array $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get whether the contact is authorized to communicate with the user
     *
     * @return  bool
     */
    public function getAuthorized()
    {
        return $this->authorized;
    }

    /**
     * Set whether the contact is authorized to communicate with the user
     *
     * @param  bool  $authorized  Whether the contact is authorized to communicate with the user
     *
     * @return  self
     */
    public function setAuthorized(bool $authorized): self
    {
        $this->authorized = $authorized;

        return $this;
    }

    /**
     * Get whether the contact is currently blocked by the user
     *
     * @return  bool
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * Set whether the contact is currently blocked by the user
     *
     * @param  bool  $blocked  Whether the contact is currently blocked by the user
     *
     * @return  self
     */
    public function setBlocked(bool $blocked): self
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * Get whether the contact has been explicitly added by the user
     *
     * @return  bool
     */
    public function getExplicit()
    {
        return $this->explicit;
    }

    /**
     * Set whether the contact has been explicitly added by the user
     *
     * @param  bool  $explicit  Whether the contact has been explicitly added by the user
     *
     * @return  self
     */
    public function setExplicit(bool $explicit): self
    {
        $this->explicit = $explicit;

        return $this;
    }

    /**
     * Get the date and time when the contact was added
     *
     * @return  \DateTime
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set the date and time when the contact was added
     *
     * @param  \DateTime  $creationTime  The date and time when the contact was added
     *
     * @return  self
     */
    public function setCreationTime(\DateTime $creationTime): self
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get the relationship history of the contact
     *
     * @return mixed[]
     */
    public function getRelationshipHistory()
    {
        return $this->relationshipHistory;
    }

    /**
     * Set the relationship history of the contact
     *
     * @param  mixed[]  $relationshipHistory  The relationship history of the contact
     *
     * @return  self
     */
    public function setRelationshipHistory(array $relationshipHistory): self
    {
        $this->relationshipHistory = $relationshipHistory;

        return $this;
    }

    /**
     * Get the agent information of the contact (if applicable)
     *
     * @return  mixed[]
     */
    public function getAgent(): array
    {
        return $this->agent;
    }

    /**
     * Set the agent information of the contact (if applicable)
     *
     * @param  mixed[]  $agent  The agent information of the contact (if applicable)
     *
     * @return  self
     */
    public function setAgent($agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get the suggested status of the contact (if applicable)
     *
     * @return  bool|null
     */
    public function getSuggested()
    {
        return $this->suggested;
    }

    /**
     * Set the suggested status of the contact (if applicable)
     *
     * @param  bool|null  $suggested  The suggested status of the contact (if applicable)
     *
     * @return  self
     */
    public function setSuggested($suggested): self
    {
        $this->suggested = $suggested;

        return $this;
    }

    /**
     * Get the phone hashes of the contact (if applicable)
     *
     * @return  mixed[]
     */
    public function getPhoneHashes(): array
    {
        return $this->phoneHashes;
    }

    /**
     * Set the phone hashes of the contact (if applicable)
     *
     * @param mixed[] $phoneHashes  The phone hashes of the contact (if applicable)
     */
    public function setPhoneHashes(array $phoneHashes): self
    {
        $this->phoneHashes = $phoneHashes;

        return $this;
    }

    /**
     * Get information about the contact
     *
     * @return  string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set information about the contact
     *
     * @param  string  $about  Information about the contact
     *
     * @return  self
     */
    public function setAbout(string $about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get the URL of the avatar of the contact
     *
     * @return  string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Set the URL of the avatar of the contact
     *
     * @param  string  $avatarUrl  The URL of the avatar of the contact
     *
     * @return  self
     */
    public function setAvatarUrl(string $avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Get the birthday of the contact
     *
     * @return  string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the birthday of the contact
     *
     * @param  string  $birthday  The birthday of the contact
     *
     * @return  self
     */
    public function setBirthday(string $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the city of the contact
     *
     * @return  string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the city of the contact
     *
     * @param  string  $city  The city of the contact
     *
     * @return  self
     */
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the country of the contact
     *
     * @return  string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the country of the contact
     *
     * @param  string  $country  The country of the contact
     *
     * @return  self
     */
    public function setCountry(string $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the emails of the contact
     *
     * @return  mixed[]
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set the emails of the contact
     *
     * @param  mixed[]  $emails  The emails of the contact
     *
     * @return  self
     */
    public function setEmails(array $emails)
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Get the first name of the contact
     *
     * @return  string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the first name of the contact
     *
     * @param  string  $firstName  The first name of the contact
     *
     * @return  self
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the gender of the contact
     *
     * @return  string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the gender of the contact
     *
     * @param  string  $gender  The gender of the contact
     *
     * @return  self
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the homepage of the contact
     *
     * @return  string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set the homepage of the contact
     *
     * @param  string  $homepage  The homepage of the contact
     *
     * @return  self
     */
    public function setHomepage(string $homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get the job title of the contact
     *
     * @return  string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set the job title of the contact
     *
     * @param  string  $jobTitle  The job title of the contact
     *
     * @return  self
     */
    public function setJobTitle(string $jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get the language of the contact
     *
     * @return  string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the language of the contact
     *
     * @param  string  $language  The language of the contact
     *
     * @return  self
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the last name of the contact
     *
     * @return  string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the last name of the contact
     *
     * @param  string  $lastName  The last name of the contact
     *
     * @return  self
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the mood of the contact
     *
     * @return  string
     */
    public function getMood()
    {
        return $this->mood;
    }

    /**
     * Set the mood of the contact
     *
     * @param  string  $mood  The mood of the contact
     *
     * @return  self
     */
    public function setMood(string $mood)
    {
        $this->mood = $mood;

        return $this;
    }

    /**
     * Get the namespace of the contact
     *
     * @return  string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set the namespace of the contact
     *
     * @param  string  $namespace  The namespace of the contact
     *
     * @return  self
     */
    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Get the home phone number of the contact
     *
     * @return  string
     */
    public function getPhoneHome()
    {
        return $this->phoneHome;
    }

    /**
     * Set the home phone number of the contact
     *
     * @param  string  $phoneHome  The home phone number of the contact
     *
     * @return  self
     */
    public function setPhoneHome(string $phoneHome)
    {
        $this->phoneHome = $phoneHome;

        return $this;
    }

    /**
     * Get the mobile phone number of the contact
     *
     * @return  string
     */
    public function getPhoneMobile()
    {
        return $this->phoneMobile;
    }

    /**
     * Set the mobile phone number of the contact
     *
     * @param  string  $phoneMobile  The mobile phone number of the contact
     *
     * @return  self
     */
    public function setPhoneMobile(string $phoneMobile)
    {
        $this->phoneMobile = $phoneMobile;

        return $this;
    }

    /**
     * Get the office phone number of the contact
     *
     * @return  string
     */
    public function getPhoneOffice()
    {
        return $this->phoneOffice;
    }

    /**
     * Set the office phone number of the contact
     *
     * @param  string  $phoneOffice  The office phone number of the contact
     *
     * @return  self
     */
    public function setPhoneOffice(string $phoneOffice)
    {
        $this->phoneOffice = $phoneOffice;

        return $this;
    }

    /**
     * Get the province of the contact
     *
     * @return  string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set the province of the contact
     *
     * @param  string  $province  The province of the contact
     *
     * @return  self
     */
    public function setProvince(string $province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get the rich mood of the contact
     *
     * @return  string
     */
    public function getRichMood()
    {
        return $this->richMood;
    }

    /**
     * Set the rich mood of the contact
     *
     * @param  string  $richMood  The rich mood of the contact
     *
     * @return  self
     */
    public function setRichMood(string $richMood)
    {
        $this->richMood = $richMood;

        return $this;
    }

    /**
     * Get the username of the contact
     *
     * @return  string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the username of the contact
     *
     * @param  string  $username  The username of the contact
     *
     * @return  self
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }
}
