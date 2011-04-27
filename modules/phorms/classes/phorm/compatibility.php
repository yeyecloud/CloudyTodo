<?php defined('SYSPATH') or die('No direct script access.');
/**
 * ValidationError
 * 
 * Thrown when a field's data fails to validate.
 * @author Jeff Ober
 * @package Fields
 **/
class ValidationError extends Phorm_Validation_Error { }

/**
 * PhormField
 * 
 * Abstract class from which all other field classes are derived.
 * @author Jeff Ober
 * @package Fields
 **/
abstract class PhormField extends Phorm_Field { }

/**
 * AlphaField
 * 
 * A text field that only accepts alpha (a-z) characters.
 * @author Lété Thomas
 * @package Fields
 **/
class AlphaField extends Phorm_Field_Alpha { }

/**
 * AlphaNumField
 * 
 * A text field that only accepts alpha (a-z) or numeric (0-9) characters.
 * @author Lété Thomas
 * @package Fields
 **/
class AlphaNumField extends Phorm_Field_Alphanum { }

/**
 * BooleanField
 * 
 * A field representing a boolean choice using a checkbox field.
 * @author Jeff Ober
 * @package Fields
 **/
class BooleanField extends Phorm_Field_Boolean { }

/**
 * DateField
 * 
 * A text field that accepts a variety of date formats (those accepted by
 * PHP's built-in strtotime.) Note that due to the reliance on strtotime, this
 * class has a serious memory leak in PHP 5.2.8 (I am unsure if it is present
 * as well in 5.2.9+.)
 * @author Jeff Ober
 * @package Fields
 **/
class DateField extends Phorm_Field_Date { }

/**
 * DateTimeField
 * 
 * A text field that accepts a variety of date/time formats (those accepted by
 * PHP's built-in strtotime.) Note that due to the reliance on strtotime, this
 * class has a serious memory leak in PHP 5.2.8 (I am unsure if it is present
 * as well in 5.2.9+.)
 * @author Jeff Ober
 * @package Fields
 **/
class DateTimeField extends Phorm_Field_Datetime { }

/**
 * DecimalField
 * 
 * A field that accepts only decimals of a specified precision.
 * @author Jeff Ober
 * @package Fields
 **/
class DecimalField extends Phorm_Field_Decimal { }

/**
 * DropDownField
 * 
 * A field that presents a list of options as a drop-down.
 * @author Jeff Ober
 * @package Fields
 **/
class DropDownField extends Phorm_Field_Dropdown { }

/**
 * EmailField
 * 
 * A text field that only accepts a valid email address.
 * @author Jeff Ober
 * @package Fields
 **/
class EmailField extends Phorm_Field_Email { }

/**
 * FileField
 * 
 * A field representing a file upload input.
 * @author Jeff Ober
 * @package Fields
 * @see File
 **/
class FileField extends Phorm_Field_File { }

/**
 * HiddenField
 * 
 * A hidden text field that does not print a label.
 * @author Jeff Ober
 * @package Fields
 **/
class HiddenField extends Phorm_Field_Hidden { }

/**
 * ImageField
 * 
 * A FileField that is pre-configured for images. Valid types are PNG, GIF, and
 * JPG. Returns an Image instance instead of a File instance. Identical to the
 * FileField in all other ways.
 * @author Jeff Ober
 * @package Fields
 * @see FileField,Image
 **/
class ImageField extends Phorm_Field_Image { }

/**
 * IntegerField
 * 
 * A field that accepts only integers.
 * @author Jeff Ober
 * @package Fields
 **/
class IntegerField extends Phorm_Field_Integer { }

/**
 * LargeTextField
 * 
 * A large text field using a textarea tag.
 * @author Jeff Ober
 * @package Fields
 **/
class LargeTextField extends Phorm_Field_Largetext { }

/**
 * MultipleChoiceField
 * 
 * A compound field offering multiple choices as a select multiple tag.
 * @author Jeff Ober
 * @package Fields
 **/
class MultipleChoiceField extends Phorm_Field_Multiplechoice { }

/**
 * OptionsField
 * 
 * A selection of choices represented as a series of labeled checkboxes.
 * @author Jeff Ober
 * @package Fields
 **/
class OptionsField extends Phorm_Field_Options { }

/**
 * PasswordField
 * 
 * A password field that uses a user-specified hash function to import values.
 * @author Jeff Ober
 * @package Fields
 **/
class PasswordField extends Phorm_Field_Password { }

/**
 * RegexField
 * 
 * A text field that validates using a regular expression and imports to an
 * array of captured values.
 * @author Jeff Ober
 * @package Fields
 **/
class RegexField extends Phorm_Field_Regex { }

/**
 * ScanField
 * 
 * Akin to the RegexField, but instead using sscanf() for more rigid matching
 * and type-cast values.
 * @author Jeff Ober
 * @package Fields
 * @see RegexField
 **/
class ScanField extends Phorm_Field_Scan { }

/**
 * 
 * A simple text field.
 * @author Jeff Ober
 * @package Fields
 **/
class TextField extends Phorm_Field_Text { }

/**
 * URLField
 * 
 * A text field that only accepts a reasonably-formatted URL. Supports HTTP(S)
 * and FTP. If a value is missing the HTTP(S)/FTP prefix, adds it to the final
 * value.
 * @author Jeff Ober
 * @package Fields
 **/
class URLField extends Phorm_Field_Url { }

