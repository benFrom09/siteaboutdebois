<?php
namespace App\Entities;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class File
{
    private $name;
    private $size;
    private $extension;
    private $description;
    private $maxSize;
    public function __construct(UploadedFile $file)
    {
        $this->name = $file->getClientOriginalName();
        $this->size = $file->getClientSize();
        $this->extension = $file->getClientOriginalExtension();
        $this->maxSize = $file->getMaxFilesize();
        $this->description = null;
    }
    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }
    /**
     * Get the value of exyention
     */
    public function getExtension()
    {
        return $this->extension;
    }
    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Get the value of maxSize
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }
    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}