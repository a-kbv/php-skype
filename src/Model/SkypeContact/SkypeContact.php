<?php

namespace Akbv\PhpSkype\Model\SkypeContact;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeContact
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
     * @var \Akbv\PhpSkype\Models\SkypeContact\SkypeContactProfile
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
        $data['profile'] = $this->profile->toArray();
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
        $this->profile = !empty($raw->profile) ? new \Akbv\PhpSkype\Model\SkypeContact\SkypeContactProfile($raw->profile) : null;
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
     * Get the unique identifier for this user.
     *
     * @return  string
     */
    public function getMri()
    {
        return $this->mri;
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
     * Get display_name_source
     *
     * @return  string
     */
    public function getDisplayNameSource()
    {
        return $this->displayNameSource;
    }

    /**
     * Get the profile for this user.
     *
     * @return  \Akbv\PhpSkype\Models\SkypeContact\SkypeContactProfile
     */
    public function getProfile()
    {
        return $this->profile;
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
     * Get whether this user is blocked.
     *
     * @return  bool
     */
    public function getBlocked()
    {
        return $this->blocked;
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
     * Get creation_time
     *
     * @return  string
     */
    public function getCreationTime()
    {
        return $this->creationTime;
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
     * Get the agent for this user.
     *
     * @return  string[]
     */
    public function getAgent()
    {
        return $this->agent;
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
     * Get phone_hashes
     *
     * @return  string[]
     */
    public function getPhoneHashes()
    {
        return $this->phoneHashes;
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
}
