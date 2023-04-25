<?php

namespace Akbv\PhpSkype\Models;

/**
 * Class representing a contact in Skype
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
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
}
