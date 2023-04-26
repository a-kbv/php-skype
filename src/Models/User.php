<?php

namespace Akbv\PhpSkype\Models;

use Akbv\PhpSkype\Utils\Utils;
use Akbv\PhpSkype\Models\Users\Name;
use Akbv\PhpSkype\Models\Users\Location;

/**
 * User on skype - the current one,a contact, or someone else.
 * Properties differ slightly between the current user and others.
 * Only public properties are available here.
 * Searches different possible attributes for each property.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class User extends Base
{
    /**
     * Skype Name of User or Group.
     *
     * @var string
     */
    private $id;

    /**
     * The name of User.
     *
     * @var Name
     */
    private $name;

    /**
     * The location of User.
     *
     * @var Location
     */
    private $location;

    /**
     * The language of User.
     *
     * @var string
     */
    private $language;

    /**
     * The avatar of User.
     *
     * @var string
     */
    private $avatar;

    /**
     * The gender of User
     * @var string
     */
    private $gender;

    /**
     * construct user.
     * @param mixed[] $raw raw data
     */
    public function __construct(array $raw)
    {
        $this->id = Utils::removePrefix($raw["id"] ?: $raw["mri"] ?: $raw["skypeId"] ?: $raw["username"]);
        $this->name = new Name($raw);
        $this->location = new Location($raw);
        $this->language = strtoupper(isset($raw['profile']['language']) ? $raw['profile']['language'] : null);
        $this->avatar = isset($raw['profile']['avatarUrl']) ? $raw['profile']['avatarUrl'] : null;
        $this->gender = isset($raw['profile']['gender']) ? $raw['profile']['gender'] : null;
    }

    /**
     * Get skype Name of User or Group.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the language of User.
     *
     * @return  string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Get the avatar of User.
     *
     * @return  string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the avatar of User.
     *
     * @param  string  $avatar  The avatar of User.
     *
     * @return  self
     */
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the name of User.
     *
     * @return  Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the gender of User
     *
     * @return  string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the location of User.
     *
     * @return  Location
     */
    public function getLocation()
    {
        return $this->location;
    }
}
