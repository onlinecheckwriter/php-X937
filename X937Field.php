<?php
/**
 * Description of X937Field
 *
 * @author astanley
 */
class X937Field {
	protected $fieldNumber;	// the sequential number of the field in the record
	protected $fieldName;	// the filed name;
	protected $usage;		// usage, Mandatory or Conditional.
	protected $position;	// starting ending location of the field
	protected $size;		// number of characters within the field
	protected $type;		// type of characters within the field
	
	protected $value;		// the value of the field;
	
	// Usage Types
	const MANDATORY   = 'M';
	const CONDITIONAL = 'C';
	
	// field types
	const ALPHABETIC                  = 'A';
	const NUMERIC                     = 'N';
	const BLANK                       = 'B';
	const SPECIAL                     = 'S';
	const ALPHAMERIC                  = 'AN';
	const ALPHAMERICSPECIAL           = 'ANS';
	const NUMERICBLANK                = 'NB';
	const NUMERICSPECIAL              = 'NS';
	const NUMERICBLANKSPECIALMICR     = 'NBSM';
	const NUMERICBLANKSPECIALMICRONUS = 'NBSMOS';
	const BINARY                      = 'Binary';
	
	public function X937Field($fieldNumber, $filedName, $usage, $position, $size, $type) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = $filedName;
		$this->usage       = $usage;
		$this->position    = $position;
		$this->size        = $size;
		$this->type        = $type;
	}
	
	// validate?
	public static function validate() {}
	
	// getters
	public function getFieldName()   { return $this->fieldName; }
	public function getFieldNumber() { return $this->fieldNumber; }
	public function getUsage()       { return $this->usage; }
	public function getPosition()    { return $this->position; }
	public function getSize()        { return $this->size; }
	public function getType()        { return $this->type; }
	public function getValue()       { return $this->value; }
	
	public function parseValue($recordASCII) {
		$this->value = substr($recordASCII, $this->position - 1, $this->size);
	}
}

class X937FieldRecordType extends X937Field {
	public function X937FieldRecordType($value) {
		$this->fieldNumber = 1;						// Always #1 field.
		$this->fieldName   = 'Record Type';
		$this->usage       = X937Field::MANDATORY;	// Always mandatory.
		$this->position    = '1';                   // Always pos 01-02
		$this->size        = '2';					// Always 2
		$this->type        = X937Field::NUMERIC;	// Always Numeric
		
		$this->value       = $value;
	}
}

class X937FieldReserved extends X937Field {
	public function X937FieldReserved($fieldNumber, $position, $size) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = 'Reserved';
		$this->usage       = X937Field::MANDATORY;
		$this->position    = $position;
		$this->size        = $size;
		$this->type        = X937Field::BLANK;
	}
}

class X937FieldUser extends X937Field {
	public function X937FieldUser($fieldNumber, $position, $size) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = 'User Field';
		$this->usage       = X937Field::CONDITIONAL;
		$this->position    = $position;
		$this->size        = $size;
		$this->type        = X937Field::ALPHAMERICSPECIAL;
	}	
}

class X937FieldDate extends X937Field {
	public function X937FieldDate($fieldNumber, $fieldName, $usage, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = $fieldName;
		$this->usage       = $usage;
		$this->position    = $position;
		$this->size        = 8;
		$this->type        = X937Field::NUMERIC;
	}	
}

class X937FieldTime extends X937Field {
	public function X937FieldTime($fieldNumber, $fieldName, $usage, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = $fieldName;
		$this->usage       = $usage;
		$this->position    = $position;
		$this->size        = 4;
		$this->type        = X937Field::NUMERIC;
	}	
}

class X937FieldInstitutionName extends X937Field {
	public function X937FieldInstitutionName($fieldNumber, $fieldNamePrefix, $usage, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = $fieldNamePrefix . ' ' . 'Name';
		$this->usage       = $usage;
		$this->position    = $position;
		$this->size        = 18;
		$this->type        = X937Field::ALPHABETIC;
	}	
}

class X937FieldContactName extends X937Field {
	public function X937FieldContactName($fieldNumber, $fieldName, $usage, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = $fieldName;
		$this->usage       = $usage;
		$this->position    = $position;
		$this->size        = 14;
		$this->type        = X937Field::ALPHAMERICSPECIAL;
	}	
}

class X937FieldPhoneNumber extends X937Field {
	public function X937FieldPhoneNumber($fieldNumber, $fieldNamePrefix, $usage, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = $fieldNamePrefix . ' ' . 'Phone Number';
		$this->usage       = $usage;
		$this->position    = $position;
		$this->size        = 10;
		$this->type        = X937Field::NUMERIC;
	}	
}

class X937FieldRoutingNumber extends X937Field {
	public function X937FieldRoutingNumber($fieldNumber, $fieldNamePrefix, $usage, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = $fieldNamePrefix . ' ' . 'Routing Number';
		$this->usage       = $usage;
		$this->position    = $position;
		$this->size        = 9;
		$this->type        = X937Field::NUMERIC;
	}	
}

class X937FieldDepositAccountNumber extends X937Field {
	public function X937FieldDepositAccountNumber($fieldNumber, $usage, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = 'Deposit Account Number at BOFD';
		$this->usage       = X937Field::CONDITIONAL;
		$this->position    = $position;
		$this->size        = 18;
		$this->type        = X937Field::ALPHAMERICSPECIAL;
	}	
}

class X937FieldItemAmount extends X937Field {
	public function X937FieldItemAmount($fieldNumber, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = 'Item Amount';
		$this->usage       = X937Field::MANDATORY;
		$this->position    = $position;
		$this->size        = 10;
		$this->type        = X937Field::NUMERIC;
	}	
}

class X937FieldItemSequenceNumber extends X937Field {
	public function X937FieldItemSequenceNumber($fieldNumber, $fieldNamePrefix, $usage, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = $fieldNamePrefix . ' ' . 'Item Sequence Number';
		$this->usage       = $usage;
		$this->position    = $position;
		$this->size        = 15;
		$this->type        = X937Field::NUMERICBLANK;
	}	
}

class X937FieldReturnReason extends X937Field {
	public function X937FieldReturnReason($fieldNumber, $usage, $position) {
		$this->fieldNumber = $fieldNumber;
		$this->fieldName   = 'Return Reason';
		$this->usage       = $usage;
		$this->position    = $position;
		$this->size        = 1;
		$this->type        = X937Field::ALPHAMERIC;
	}	
}
?>
