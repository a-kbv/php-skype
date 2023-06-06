<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Utils\Utils;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class ThreadProperties extends \Akbv\PhpSkype\Models\Base
{
    /**
    * The lastjoinat for this thread.
    * @var string
    */
    private $lastjoinat;

    /**
     * The topic for this thread.
     */
    private $topic;

    /**
     * The membercount for this thread.
     */
    private $membercount;

    /**
     * The members for this thread.
     */
    private $members;

    /**
     * The version for this thread.
     */
    private $version;

    /**
     * The joiningenabled for this thread.
     */
    private $joiningenabled;


    /**
     * Constructor.
     * @param mixed[] $raw
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
    }


    /**
     * Get the lastjoinat for this thread.
     *
     * @return  string
     */
    public function getLastjoinat()
    {
        return $this->lastjoinat;
    }

    /**
     * Set the lastjoinat for this thread.
     *
     * @param  string  $lastjoinat  The lastjoinat for this thread.
     *
     * @return  self
     */
    public function setLastjoinat(string $lastjoinat)
    {
        $this->lastjoinat = $lastjoinat;

        return $this;
    }

    /**
     * Get the topic for this thread.
     *
     * @return  string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the topic for this thread.
     *
     * @param  string  $topic  The topic for this thread.
     *
     * @return  self
     */
    public function setTopic(string $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get the membercount for this thread.
     *
     * @return  string
     */
    public function getMembercount()
    {
        return $this->membercount;
    }

    /**
     * Set the membercount for this thread.
     *
     * @param  string  $membercount  The membercount for this thread.
     *
     * @return  self
     */
    public function setMembercount(string $membercount)
    {
        $this->membercount = $membercount;

        return $this;
    }

    /**
     * Get the members for this thread.
     *
     * @return  string
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set the members for this thread.
     *
     * @param  string  $members  The members for this thread.
     *
     * @return  self
     */
    public function setMembers(string $members)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get the version for this thread.
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version for this thread.
     *
     * @param  string  $version  The version for this thread.
     *
     * @return  self
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the joiningenabled for this thread.
     *
     * @return  string
     */
    public function getJoiningenabled()
    {
        return $this->joiningenabled;
    }

    /**
     * Set the joiningenabled for this thread.
     *
     * @param  string  $joiningenabled  The joiningenabled for this thread.
     *
     * @return  self
     */
    public function setJoiningenabled(string $joiningenabled)
    {
        $this->joiningenabled = $joiningenabled;

        return $this;
    }
}
