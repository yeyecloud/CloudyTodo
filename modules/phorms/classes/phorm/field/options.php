<?php
/**
 * OptionsField
 * 
 * A selection of choices represented as a series of labeled checkboxes.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Options extends Phorm_Field_Multiplechoice
{
    /**
     * Returns a new Phorm_Widget_Optiongroup.
     * @author Jeff Ober
     * @return Phorm_Widget_Optiongroup
     **/
    public function get_widget()
    {
        return new Phorm_Widget_Optiongroup($this->options);
    }
}
