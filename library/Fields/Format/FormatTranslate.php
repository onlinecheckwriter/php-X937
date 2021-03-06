<?php

namespace X937\Fields\Format;

/**
 * Writes the fields value Formated (human readable) fashion.
 *
 * @author Austin Stanley <maxtmahem@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GNU Public Licneses v3
 * @copyright Copyright (c) 2013, Austin Stanley <maxtmahem@gmail.com>
 */
class FormatTranslate implements TextFormatInterface
{
    public static function formatTranslate(\X937\Fields\Field $field): string
    {
        $value = $field->getValue();
        
        // logic set here is complex, so we set some variables and check each state.
        $valueIsBlank   = (trim($value) === '');
        $fieldMandatory = ($field->usage === Fields\Field::USAGE_MANDATORY);
        
        // check first for a dictonary translation.
        if (isset($field->dictonary)) {
            // set more state values;
            $comprehensiveDictonary = ($field->comprehensive === 'true');
            $haveTranslation        = (isset($field->dictonary[$value]));
            
            // get our translation, if possible.
            $translation = ($haveTranslation) ? $field->dictonary[$value] : 'No Translation';
            
            // first check if we have a translation, if we have one, we always
            // want to return it.
            if ($haveTranslation) {
                // if we have a translation, we want to wrap the value if it is blank
                if ($valueIsBlank) {
                    $value = "'$value'";
                }
            
                return "$value - $translation";
            }
            
            // here we do not have a translation of our value.
            // if the value is blank, and the field is not mandatory, then we return an empty string.
            if ($valueIsBlank && !$fieldMandatory) {
                return '';
            }
            
            // here we do not have a translation of our value, and the value is mandatory.
            // if the dictonary is comprehensive, we want to indicate that there
            // should be a translation and there is not. Otherwise, we just return the value.
            if ($comprehensiveDictonary) {
                // if we have should have a translation, we want to wrap the value if it is blank
                if ($valueIsBlank) {
                    $value = "'$value'";
                }
                return "$value - $translation";
            } else {
                return $value;
            }
        }
    }
    
    
    /**
     * Returns a formated field.
     * 
     * @todo add more formating based on type!
     * @param \X937\Fields\Field $field the field to write.
     * @return string formated field
     */
    public function format(\X937\Fields\Field $field): string
    {
        return self::formatTranslate($field);
    }
}