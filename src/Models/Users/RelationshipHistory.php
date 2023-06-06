<?php

namespace Akbv\PhpSkype\Models\Users;

/**
 * The Phone of a user or contact.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class RelationshipHistory extends \Akbv\PhpSkype\Models\User
{
    /**
     * @var string[]
     */
    private $sources;

    /**
     * Constructor.
     * @param mixed[] $data raw data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
    }


    /**
     * Get the value of sources
     *
     * @return  string[]
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * Set the value of sources
     *
     * @param  string[]  $sources
     *
     * @return  self
     */
    public function setSources(array $sources)
    {
        $this->sources = $sources;

        return $this;
    }
}
