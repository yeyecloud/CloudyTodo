<?php
/**
 * Image
 * 
 * Adds a few additional properties specific for images to the File class.
 * @author Jeff Ober
 * @see ImageField
 **/
class Phorm_Type_Image extends Phorm_Type_File
{
    /**
     * The image's width in pixels.
     **/
    public $width;
    /**
     * The image's height in pixels.
     **/
    public $height;
    /**
     * The image's type constant.
     **/
    public $type;
    
    public function __construct($file_data)
    {
        parent::__construct($file_data);
        list($this->width, $this->height, $this->type) = getimagesize($this->tmp_name);
    }
}
