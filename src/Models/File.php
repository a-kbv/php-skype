<?php

namespace Akbv\PhpSkype\Models;

/**
 * Details about a file contained within a message.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class File extends Base
{
    /**
     * Original filename from the client.
     * @var string
     */
    private $name;

    /**
     * Number of bytes in the file.
     * @var int
     */
    private $size;

    /**
     * URL to retrieve the original file.
     * @var string
     */
    private $urlFull;

    /**
     * URL to retrieve a thumbnail or display image for the file.
     * @var string
     */
    private $urlThumb;

    /**
     * URL for the user to access the file outside of the API.
     * @var string
     */
    private $urlView;



    /**
     * Get original filename from the client.
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set original filename from the client.
     *
     * @param  string  $name  Original filename from the client.
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get number of bytes in the file.
     *
     * @return  int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set number of bytes in the file.
     *
     * @param  int  $size  Number of bytes in the file.
     *
     * @return  self
     */
    public function setSize(int $size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get uRL to retrieve the original file.
     *
     * @return  string
     */
    public function getUrlFull()
    {
        return $this->urlFull;
    }

    /**
     * Set uRL to retrieve the original file.
     *
     * @param  string  $urlFull  URL to retrieve the original file.
     *
     * @return  self
     */
    public function setUrlFull(string $urlFull)
    {
        $this->urlFull = $urlFull;

        return $this;
    }

    /**
     * Get uRL to retrieve a thumbnail or display image for the file.
     *
     * @return  string
     */
    public function getUrlThumb()
    {
        return $this->urlThumb;
    }

    /**
     * Set uRL to retrieve a thumbnail or display image for the file.
     *
     * @param  string  $urlThumb  URL to retrieve a thumbnail or display image for the file.
     *
     * @return  self
     */
    public function setUrlThumb(string $urlThumb)
    {
        $this->urlThumb = $urlThumb;

        return $this;
    }

    /**
     * Get uRL for the user to access the file outside of the API.
     *
     * @return  string
     */
    public function getUrlView()
    {
        return $this->urlView;
    }

    /**
     * Set uRL for the user to access the file outside of the API.
     *
     * @param  string  $urlView  URL for the user to access the file outside of the API.
     *
     * @return  self
     */
    public function setUrlView(string $urlView)
    {
        $this->urlView = $urlView;

        return $this;
    }
}
