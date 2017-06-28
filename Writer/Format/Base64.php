<?php

namespace X937\Writer\Format;

/**
 * Writes Binary Fields in Base64.
 *
 * @author Austin Stanley <maxtmahem@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GNU Public Licneses v3
 * @copyright Copyright (c) 2013, Austin Stanley <maxtmahem@gmail.com>
 */
class Base64 implements BinaryFormatInterface
{

    /**
     * Returns the Field Binary data Base64 encoded.
     * @param \X937\Fields\Field $field
     * @return string The binary data encoded Base64
     */
    public function writeField(\X937\Fields\Field $field): string
    {
        return base64_encode($field->getValue());
    }
}