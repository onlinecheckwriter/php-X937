<?php

namespace X937\Fields\Format;

/**
 * Writes the fields value in EBCDIC.
 *
 * @author Austin Stanley <maxtmahem@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GNU Public Licneses v3
 * @copyright Copyright (c) 2013, Austin Stanley <maxtmahem@gmail.com>
 */
class FormatEBCDIC implements TextFormatInterface
{
    /**
     * Returns a formated field.
     * 
     * @todo add more formating based on type!
     * @param \X937\Fields\Field $field the field to write.
     * @return string formated field
     */
    public function format(\X937\Fields\Field $field): string
    {
        return Util::a2e($field->getValue());
    }
}