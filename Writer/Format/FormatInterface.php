<?php

namespace X937\Writer\Format;

/**
 * Interface for Field Writer
 *
 * @author Austin Stanley <maxtmahem@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GNU Public Licneses v3
 * @copyright Copyright (c) 2013, Austin Stanley <maxtmahem@gmail.com>
 */
interface FormatInterface
{
    public function writeField(\X937\Fields\Field $field): string;
}

interface BinaryFormatInterface extends FormatInterface
{
    // do nothing stub
}

interface TextFormatInterface extends FormatInterface
{
    // do nothing stub
}