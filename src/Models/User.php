<?php

namespace Akbv\PhpSkype\Models;

use Akbv\PhpSkype\Utils\Utils;

/**
 * User on skype - the current one,a contact, or someone else.
 * Properties differ slightly between the current user and others.
 * Only public properties are available here.
 * Searches different possible attributes for each property.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class User
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
     * @var string
     */
    private $name;

    /**
     * The location of User.
     *
     * @var string
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
     * construct user.
     */
    public function __construct(array $raw)
    {
        $id = Utils::removePrefix($raw["id"] ?: $raw["mri"] ?: $raw["skypeId"] ?: $raw["username"]);
        $this->id = $id;

        $name = isset($raw["name"]) ? $raw["name"] : $raw["displayName"];
        $this->name = $name;

        if (isset($raw["locations"])) {
            $locParts = $raw["locations"][0];
        } else {
            $locParts = [
                "city" => $raw["city"],
                "region" => $raw["province"] ?: $raw["state"],
                "country" => $raw["countryCode"] ?: $raw["country"]
            ];
        }

        $this->location = $locParts["city"] . ", " . $locParts["region"] . ", " . $locParts["country"];

        $language = strtoupper($raw["language"]);
        $this->language = $language;

        $avatar = $raw["avatar_url"] ?: $raw["avatarUrl"];
        $this->avatar = $avatar;
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
     * Get the name of User.
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the location of User.
     *
     * @return  string
     */
    public function getLocation()
    {
        return $this->location;
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
}
