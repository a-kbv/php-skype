<?php

namespace Akbv\PhpSkype\Model\SkypeContact;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeContact extends \Akbv\PhpSkype\Model\Base
{
    /**
     * The unique identifier for this user.
     * person_id
     * @var string
     */
    private $personId;

    /**
     * The unique identifier for this user.
     * @var string
     */
    private $mri;

    /**
     * The display name for this user.
     * display_name
     * @var string
     */
    private $displayName;

    /**
     * The source of the display name for this user.
     * display_name_source
     * @var string
     */
    private $displayNameSource;

    /**
     * The profile for this user.
     * @var \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfile
     */
    private $profile;

    /**
     * Whether this user is authorized.
     * @var bool
     */
    private $authorized;

    /**
     * Whether this user is blocked.
     * @var bool
     */
    private $blocked;

    /**
     * Whether this user is explicit.
     * @var bool
     */
    private $explicit;

    /**
    * The creation time for this user.
    * creation_time
    * @var string
     */
    private $creationTime;

    /**
     * The relationship history for this user.
     * relationship_history
     * @var string[]
     */
    private $relationshipHistory;

    /**
     * The agent for this user.
     * @var string[]
     */
    private $agent;

    /**
     * Whether this user is suggested.
     * @var bool
     */
    private $suggested;

    /**
     * The phone hashes for this user.
     * phone_hashes
     * @var string[]
     */
    private $phoneHashes;

    /**
     * Whether this user is gone.
     * @var bool
     */
    private $gone;


    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $data['person_id'] = $this->personId;
        $data['mri'] = $this->mri;
        $data['display_name'] = $this->displayName;
        $data['display_name_source'] = $this->displayNameSource;
        $data['profile'] = !empty($this->profile) ? $this->profile->toArray(): null;
        $data['authorized'] = $this->authorized;
        $data['blocked'] = $this->blocked;
        $data['explicit'] = $this->explicit;
        $data['creation_time'] = $this->creationTime;
        $data['relationship_history'] = $this->relationshipHistory;
        $data['agent'] = $this->agent;
        $data['suggested'] = $this->suggested;
        $data['phone_hashes'] = $this->phoneHashes;
        $data['gone'] = $this->gone;

        return $data;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->personId = !empty($raw->person_id) ? $raw->person_id : null;
        $this->mri = !empty($raw->mri) ? $raw->mri : null;
        $this->displayName = !empty($raw->display_name) ? $raw->display_name : null;
        $this->displayNameSource = !empty($raw->display_name_source) ? $raw->display_name_source : null;
        $this->profile = !empty($raw->profile) ? new \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfile($raw->profile) : new \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfile((object)[]);
        $this->authorized = !empty($raw->authorized) ? $raw->authorized : null;
        $this->blocked = !empty($raw->blocked) ? $raw->blocked : null;
        $this->explicit = !empty($raw->explicit) ? $raw->explicit : null;
        $this->creationTime = !empty($raw->creation_time) ? $raw->creation_time : null;
        $this->relationshipHistory = !empty($raw->relationship_history) ? $raw->relationship_history : null;
        $this->agent = !empty($raw->agent) ? $raw->agent : null;
        $this->suggested = !empty($raw->suggested) ? $raw->suggested : null;
        $this->phoneHashes = !empty($raw->phone_hashes) ? $raw->phone_hashes : null;
        $this->gone = !empty($raw->gone) ? $raw->gone : null;
    }



    /**
     * Get person_id
     *
     * @return  string
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set person_id
     *
     * @param  string  $personId  person_id
     *
     * @return  self
     */
    public function setPersonId(string $personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get the unique identifier for this user.
     *
     * @return  string
     */
    public function getMri()
    {
        return $this->mri;
    }

    /**
     * Set the unique identifier for this user.
     *
     * @param  string  $mri  The unique identifier for this user.
     *
     * @return  self
     */
    public function setMri(string $mri)
    {
        $this->mri = $mri;

        return $this;
    }

    /**
     * Get display_name
     *
     * @return  string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set display_name
     *
     * @param  string  $displayName  display_name
     *
     * @return  self
     */
    public function setDisplayName(string $displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get display_name_source
     *
     * @return  string
     */
    public function getDisplayNameSource()
    {
        return $this->displayNameSource;
    }

    /**
     * Set display_name_source
     *
     * @param  string  $displayNameSource  display_name_source
     *
     * @return  self
     */
    public function setDisplayNameSource(string $displayNameSource)
    {
        $this->displayNameSource = $displayNameSource;

        return $this;
    }

    /**
     * Get the profile for this user.
     *
     * @return  \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set the profile for this user.
     *
     * @param  \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfile  $profile  The profile for this user.
     *
     * @return  self
     */
    public function setProfile(\Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get whether this user is authorized.
     *
     * @return  bool
     */
    public function getAuthorized()
    {
        return $this->authorized;
    }

    /**
     * Set whether this user is authorized.
     *
     * @param  bool  $authorized  Whether this user is authorized.
     *
     * @return  self
     */
    public function setAuthorized(bool $authorized)
    {
        $this->authorized = $authorized;

        return $this;
    }

    /**
     * Get whether this user is blocked.
     *
     * @return  bool
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * Set whether this user is blocked.
     *
     * @param  bool  $blocked  Whether this user is blocked.
     *
     * @return  self
     */
    public function setBlocked(bool $blocked)
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * Get whether this user is explicit.
     *
     * @return  bool
     */
    public function getExplicit()
    {
        return $this->explicit;
    }

    /**
     * Set whether this user is explicit.
     *
     * @param  bool  $explicit  Whether this user is explicit.
     *
     * @return  self
     */
    public function setExplicit(bool $explicit)
    {
        $this->explicit = $explicit;

        return $this;
    }

    /**
     * Get creation_time
     *
     * @return  string
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set creation_time
     *
     * @param  string  $creationTime  creation_time
     *
     * @return  self
     */
    public function setCreationTime(string $creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get relationship_history
     *
     * @return  string[]
     */
    public function getRelationshipHistory()
    {
        return $this->relationshipHistory;
    }

    /**
     * Set relationship_history
     *
     * @param  string[]  $relationshipHistory  relationship_history
     *
     * @return  self
     */
    public function setRelationshipHistory(array $relationshipHistory)
    {
        $this->relationshipHistory = $relationshipHistory;

        return $this;
    }

    /**
     * Get the agent for this user.
     *
     * @return  string[]
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set the agent for this user.
     *
     * @param  string[]  $agent  The agent for this user.
     *
     * @return  self
     */
    public function setAgent(array $agent)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get whether this user is suggested.
     *
     * @return  bool
     */
    public function getSuggested()
    {
        return $this->suggested;
    }

    /**
     * Set whether this user is suggested.
     *
     * @param  bool  $suggested  Whether this user is suggested.
     *
     * @return  self
     */
    public function setSuggested(bool $suggested)
    {
        $this->suggested = $suggested;

        return $this;
    }

    /**
     * Get phone_hashes
     *
     * @return  string[]
     */
    public function getPhoneHashes()
    {
        return $this->phoneHashes;
    }

    /**
     * Set phone_hashes
     *
     * @param  string[]  $phoneHashes  phone_hashes
     *
     * @return  self
     */
    public function setPhoneHashes(array $phoneHashes)
    {
        $this->phoneHashes = $phoneHashes;

        return $this;
    }

    /**
     * Get whether this user is gone.
     *
     * @return  bool
     */
    public function getGone()
    {
        return $this->gone;
    }

    /**
     * Set whether this user is gone.
     *
     * @param  bool  $gone  Whether this user is gone.
     *
     * @return  self
     */
    public function setGone(bool $gone)
    {
        $this->gone = $gone;

        return $this;
    }
}
