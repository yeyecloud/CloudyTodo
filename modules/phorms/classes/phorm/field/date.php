<?php
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
class Phorm_Field_Date extends Phorm_Field_Datetime
{

}
