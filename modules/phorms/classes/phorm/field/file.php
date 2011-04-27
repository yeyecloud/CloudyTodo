<?php
/**
 * FileField
 * 
 * A field representing a file upload input.
 * @author Jeff Ober
 * @package Fields
 * @see File
 **/
class Phorm_Field_File extends Phorm_Field
{
    /**
     * Stores the valid types for this field.
     **/
    private $types;
    /**
     * Stores the maximum size boundary in bytes.
     **/
    private $max_size;
    
    /**
     * @author Jeff Ober
     * @param string $label the field's string label
     * @param array $mime_types a list of valid mime types
     * @param int $max_size the maximum upload size in bytes
     * @param array $validators a list of callbacks to validate the field data
     * @param array $attributes a list of key/value pairs representing HTML attributes
     **/
    public function __construct($label, array $mime_types, $max_size, array $validators=array(), array $attributes=array())
    {
        $this->types = $mime_types;
        $this->max_size = $max_size;
        parent::__construct($label, $validators, $attributes);
    }
    
    /**
     * Returns true if the file was uploaded without an error.
     * @author Jeff Ober
     * @return boolean
     **/
    protected function file_was_uploaded()
    {
        $file = $this->get_file_data();
        return !$file['error'];
    }
    
    /**
     * Returns an error message for a file upload error code.
     * @author Jeff Ober
     * @param int $errno the error code (from $_FILES['name']['error'])
     * @return string the error message
     **/
    protected function file_upload_error($errno)
    {
        switch ($errno)
        {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
            return $GLOBALS['phorms_tr']['filefield_toolarge'];
            
            case UPLOAD_ERR_PARTIAL:
            return $GLOBALS['phorms_tr']['filefield_uploaderror'];
            
            case UPLOAD_ERR_NO_FILE:
            return $GLOBALS['phorms_tr']['filefield_notsent'];
            
            case UPLOAD_ERR_NO_TMP_DIR:
            case UPLOAD_ERR_CANT_WRITE:
            case UPLOAD_ERR_EXTENSION:
            return sprintf($GLOBALS['phorms_tr']['filefield_syserror'], $errno);
            
            case UPLOAD_ERR_OK:
            default:
            return false;
        }
    }
    
    /**
     * Returns a Phorm_Widget_File.
     * @author Jeff Ober
     * @return Phorm_Widget_File
     * @see Phorm_Widget_File,FileField::$types
     **/
    protected function get_widget()
    {
        return new Phorm_Widget_File($this->types);
    }
    
    /**
     * Returns an array of file upload data.
     * @author Jeff Ober
     * @return array file upload data
     **/
    protected function get_file_data()
    {
        $data = $_FILES[ $this->get_attribute('name') ];
        $data['error'] = $this->file_upload_error($data['error']);
        return $data;
    }
    
    /**
     * Returns a new File instance for this field's data.
     * @author Jeff Ober
     * @return File a new File instance
     * @see File
     **/
    protected function get_file()
    {
        return new File( $this->get_file_data() );
    }
    
    /**
     * On a successful upload, returns a new File instance.
     * @author Jeff Ober
     * @param array $value the file data from $_FILES
     * @return File a new File instance
     * @see File
     **/
    public function import_value($value)
    {
        if ( $this->file_was_uploaded() )
            return $this->get_file();
    }
    
    /**
     * Returns the file's $_FILES data array or false if the file was not
     * uploaded.
     * @author Jeff Ober
     * @param mixed $value
     * @return boolean|File
     **/
    public function prepare_value($value)
    {
        if ( $this->file_was_uploaded() )
            return $this->get_file();
        else
            return false;
    }
    
    /**
     * Throws a Phorm_Validation_Error if the file upload resulted in an error, if
     * the file was not a valid type, or if the file exceded the maximum size.
     * @author Jeff Ober
     * @param mixed $value
     * @return null
     * @throws Phorm_Validation_Error
     **/
    protected function validate($value)
    {
        $file = $this->get_file_data();
        
        if ($file['error'])
            throw new Phorm_Validation_Error($file['error']);
        
        if (is_array($this->types) && !in_array($file['type'], $this->types))
            throw new Phorm_Validation_Error(sprintf($GLOBALS['phorms_tr']['filefield_badtype'], $file['type']));
        
        if ($file['size'] > $this->max_size)
            throw new Phorm_Validation_Error(sprintf($GLOBALS['phorms_tr']['filefield_sizelimit'], number_format($this->max_size)));
    }
}
