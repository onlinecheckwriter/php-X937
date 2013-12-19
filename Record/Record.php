<?php

namespace X937\Record;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Fields' . DIRECTORY_SEPARATOR . 'Field.php';

use X937\Fields\Predefined\RecordType;
use X937\Fields\Field;

/**
 * X937Record represent a single variable length line of a X937 file.
 *
 * @author Austin Stanley <maxtmahem@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GNU Public Licneses v3
 * @copyright Copyright (c) 2013, Austin Stanley
 */
abstract class Record implements \IteratorAggregate, \Countable {
    
    /**
     * The type of the record. Should be one of the class constants.
     * @var int
     */
    protected $recordType;

    /**
     * The raw record string. Generally EBCDIC data, possibly binary or ASCII.
     * @var string
     */
    protected $recordData;
    
    /**
     * The raw record data, preserved so we can have it for binary fields.
     * @var string
     */
    protected $recordDataRaw;
    
    /**
     * The length of the record. In bytes
     * @var int 
     */
    protected $recordLength;

    /**
     * Contains all the field in the record.
     * @var SplFixedArray
     */
    protected $fields;

    /**
     * Reference array that links field name => filed number.
     * @var array
     */
    protected $fieldsRef;

    /**
     * Creates a X937Record. Basic input validation, currently ignores TIFF data.
     * Calls addFields which should be overriden in a subclass to add all the
     * fields to the record. And then calls all those fields parseValue function
     * to parse in the data.
     * @param string $recordType the type of the record, in ASCII.
     * @param string $recordData the raw data for the record. EBCDIC/Binary/ASCII
     * @throws InvalidArgumentException If given bad input.
     */
    public function __construct($recordType, $recordData) {
	// input validation
        if (array_key_exists($recordType, RecordType::defineValues()) === FALSE) { 
	    throw new InvalidArgumentException("Bad record: $recordData passed.");
	}
	if (is_string($recordData) === FALSE) {
	    throw new InvalidArgumentException("Bad data type $recordData passed.");
	}

        $this->recordType = $recordType;
	$this->recordData = $recordData;

	$this->addFields();
	
	// added error check because I seem to be missing some.
	foreach($this->fields as $field) {
	    if (($field instanceof Field) === FALSE) {
		throw new LogicException("Field" . ' ' . $this->fields->key() . ' ' . "undefined.");
	    }
	}
	
	foreach($this->fields as $field) {
	    if ($field->getType() === Field::TYPE_BINARY) {
		$field->parseValue($this->recordDataRaw);
	    } else {
		$field->parseValue($this->recordData);
	    }
	}
    }
    
    /**
     * Returns an Array Iterator object of the fields (natively a SplFixedArray),
     * this lets X937Record implement tranversiable.
     * @return ArrayIterator
     */
    public function getIterator() {
	return $this->fields;
    }
    
    /**
     * Returns a count of the number of fields. For Countable.
     * @return int
     */
    public function count() {
	return count($this->fields);
    }
    
    public function validate() {
	foreach ($this->fields as $field) {
	    echo $field->validate();
	}
    }

    /**
     * Get the Record Type, should be one of the class constents.
     * @return int The record type of the record.
     */
    public function getType() { return $this->recordType; }
    public function getData() { return $this->recordData; }
    
    /**
     * Get the raw Record data
     * @return string Raw (untranslated) Record Data
     */
    public function getDataRaw()
    {
	return $this->recordDataRaw;
    }

    public function getFieldByNumber($fieldNumber) { return $this->fields[$fieldNumber-1]; }
    
    /**
     * Returns the field named.
     * @todo more elegant handling of out of range fields.
     * @param string $fieldName
     * @return \X937\Fields\Field the field named.
     */
    public function getFieldByName($fieldName) 
    {
	$fieldNumber = $this->fieldsRef[$fieldName];
	return $this->fields[$fieldNumber];
    }

    abstract public static function defineFields();
    
    protected function addFields()
    {
	$fields     = static::defineFields();
	$fieldCount = count($fields);
	
	$this->fields = new \SplFixedArray($fieldCount);
		
	foreach ($fields as $field) {
	    $this->addField($field);
	}
    }

    /**
     * Adds a X937Field (or one of it's subclasses) to the Record.
     * @param X937Field $field
     */
    protected function addField(\X937\Fields\Field $field) {
	// since field numbers are 1 indexed and the array 0 indexed, we need to
	// subtract one to correlate.
	$fieldNumber = $field->getNumber() - 1;
	
	// assign our field to the array.
        $this->fields[$fieldNumber] = $field;
	
	// update fieldRef with a key to correct position.
	$this->fieldsRef[$field->getName()] = $fieldNumber;
    }
}