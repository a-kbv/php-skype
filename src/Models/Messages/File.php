<?php

namespace Akbv\PhpSkype\Models\Messages;

/**
 * Details about a file contained within a message.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class Text extends \Akbv\PhpSkype\Models\Message
{
    /**
     * File object embedded in the message.
     * @var string
     */
    private $file;

    /**
     * Raw content of the file. (bytes)
     * @var string
     */
    private $fileContent;

    /**
     * URL to retrieve the raw file content.
     * @var string
     */
    private $urlContent;


    /**
     * Get file object embedded in the message.
     *
     * @return  string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file object embedded in the message.
     *
     * @param  string  $file  File object embedded in the message.
     *
     * @return  self
     */
    public function setFile(string $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get raw content of the file. (bytes)
     *
     * @return  string
     */
    public function getFileContent()
    {
        return $this->fileContent;
    }

    /**
     * Set raw content of the file. (bytes)
     *
     * @param  string  $fileContent  Raw content of the file. (bytes)
     *
     * @return  self
     */
    public function setFileContent(string $fileContent)
    {
        $this->fileContent = $fileContent;

        return $this;
    }

    /**
     * Get uRL to retrieve the raw file content.
     *
     * @return  string
     */
    public function getUrlContent()
    {
        return $this->urlContent;
    }

    /**
     * Set uRL to retrieve the raw file content.
     *
     * @param  string  $urlContent  URL to retrieve the raw file content.
     *
     * @return  self
     */
    public function setUrlContent(string $urlContent)
    {
        $this->urlContent = $urlContent;

        return $this;
    }
}
