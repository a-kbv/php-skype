<?php

namespace Akbv\PhpSkype\Models;

use Akbv\PhpSkype\Utils\Utils;
use Akbv\PhpSkype\Models\Users\Name;
use Akbv\PhpSkype\Models\Users\Location;

/**
 * User on skype - the current one,a contact, or someone else.
 * Properties differ slightly between the current user and others.
 * Only public properties are available here.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class User extends Base
{

    /**
     * The unique identifier for this user.
     * @var string
     */
    private $person_id;

    /**
     * The unique identifier for this user.
     * @var string
     */
    private $mri;

    /**
     * The display name for this user.
     * @var string
     */
    private $display_name;

    /**
     * The source of the display name for this user.
     * @var string
     */
    private $display_name_source;

    /**
     * The profile for this user.
     * @var \Akbv\PhpSkype\Models\Users\Profile
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
     * @var string
     */
    private $creation_time;

    /**
     * The relationship history for this user.
     * @var \Akbv\PhpSkype\Models\Users\RelationshipHistory
     */
    private $relationship_history;

    /**
     * The agent for this user.
     * @var \Akbv\PhpSkype\Models\Users\Agent
     */
    private $agent;

    /**
     * Whether this user is suggested.
     * @var bool
     */
    private $suggested;

    /**
     * The phone hashes for this user.
     * @var string[]
     */
    private $phone_hashes;

    /**
     * Whether this user is gone.
     * @var bool
     */
    private $gone;

    /**
     * construct user.
     * @param mixed[] $data raw data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
        $this->profile = new \Akbv\PhpSkype\Models\Users\Profile(isset($data["profile"]) ? $data["profile"] : []);
        $this->relationship_history = new \Akbv\PhpSkype\Models\Users\RelationshipHistory(isset($data["relationship_history"]) ? $data["relationship_history"] : []);
        $this->agent = new \Akbv\PhpSkype\Models\Users\Agent(isset($data["agent"]) ? $data["agent"] : []);
        $this->jsonSerialize();
    }

    /**
     * Get the unique identifier for this user.
     *
     * @return  string
     */
    public function getPerson_id()
    {
        return $this->person_id;
    }

    /**
     * Set the unique identifier for this user.
     *
     * @param  string  $person_id  The unique identifier for this user.
     *
     * @return  self
     */
    public function setPerson_id(string $person_id)
    {
        $this->person_id = $person_id;

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
     * Get the display name for this user.
     *
     * @return  string
     */
    public function getDisplay_name()
    {
        return $this->display_name;
    }

    /**
     * Set the display name for this user.
     *
     * @param  string  $display_name  The display name for this user.
     *
     * @return  self
     */
    public function setDisplay_name(string $display_name)
    {
        $this->display_name = $display_name;

        return $this;
    }

    /**
     * Get the source of the display name for this user.
     *
     * @return  string
     */
    public function getDisplay_name_source()
    {
        return $this->display_name_source;
    }

    /**
     * Set the source of the display name for this user.
     *
     * @param  string  $display_name_source  The source of the display name for this user.
     *
     * @return  self
     */
    public function setDisplay_name_source(string $display_name_source)
    {
        $this->display_name_source = $display_name_source;

        return $this;
    }

    /**
     * Get the profile for this user.
     *
     * @return  \Akbv\PhpSkype\Models\Users\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set the profile for this user.
     *
     * @param  \Akbv\PhpSkype\Models\Users\Profile  $profile  The profile for this user.
     *
     * @return  self
     */
    public function setProfile(\Akbv\PhpSkype\Models\Users\Profile $profile)
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
     * Get the creation time for this user.
     *
     * @return  string
     */
    public function getCreation_time()
    {
        return $this->creation_time;
    }

    /**
     * Set the creation time for this user.
     *
     * @param  string  $creation_time  The creation time for this user.
     *
     * @return  self
     */
    public function setCreation_time(string $creation_time)
    {
        $this->creation_time = $creation_time;

        return $this;
    }

    /**
     * Get the relationship history for this user.
     *
     * @return  \Akbv\PhpSkype\Models\Users\RelationshipHistory
     */
    public function getRelationship_history()
    {
        return $this->relationship_history;
    }

    /**
     * Set the relationship history for this user.
     *
     * @param  \Akbv\PhpSkype\Models\Users\RelationshipHistory  $relationship_history  The relationship history for this user.
     *
     * @return  self
     */
    public function setRelationship_history(\Akbv\PhpSkype\Models\Users\RelationshipHistory $relationship_history)
    {
        $this->relationship_history = $relationship_history;

        return $this;
    }

    /**
     * Get the agent for this user.
     *
     * @return  \Akbv\PhpSkype\Models\Users\Agent
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set the agent for this user.
     *
     * @param  \Akbv\PhpSkype\Models\Users\Agent  $agent  The agent for this user.
     *
     * @return  self
     */
    public function setAgent(\Akbv\PhpSkype\Models\Users\Agent $agent)
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
     * Get the phone hashes for this user.
     *
     * @return  string[]
     */
    public function getPhone_hashes()
    {
        return $this->phone_hashes;
    }

    /**
     * Set the phone hashes for this user.
     *
     * @param  string[]  $phone_hashes  The phone hashes for this user.
     *
     * @return  self
     */
    public function setPhone_hashes(array $phone_hashes)
    {
        $this->phone_hashes = $phone_hashes;

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
