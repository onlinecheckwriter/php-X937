<?php

require_once 'X937Record.php';
require_once 'X937RecordFactory.php';
require_once 'X937Field.php';

class X937File implements Countable, Iterator {
    const DATA_ASCII  = 'ASCII';
    const DATA_EBCDIC = 'EBCDIC-US';
    
    /**
     * Our FileHandle.
     * @var resource
     */
    private $fileHandle;
    
    /**
     * A SplFileInfo object for our file.
     * @var SplFileInfo
     */
    private $fileInfo;
    
    /**
     * The type of the data, either self::DATA_ASCII self::DATA_EBCDIC
     * @var string
     */
    private $dataType = self::DATA_ASCII;
    
    /**
     * Current position of the itterator in the file.
     * @var int
     */
    private $currentRecordPosition;
    
    /**
     * Current record
     * @var X937Record
     */
    private $currentRecord;
    
    /**
     * Current record length
     * @var int
     */
    private $curentRecordLength;
    
    /**
     * File Control Record for the File
     * @var X937RecordFileControl
     */
    private $fileControlRecord;

    /**
     * array of records position in the X937 File. Indexed the same as file
     * @var array
     */
    private $recordPositions;
    
    /**
     * Count of the number of records in the file. Retrieved from File Control Record.
     * @var int
     */
    private $recordCount;
    
    private $fileTotalAmount;
    private $fileItemCount;
	
    public function __construct($filename) {
	// input validation		
	// check for existance of our file
	if (!file_exists($filename)) {
	    throw new InvalidArgumentException("X937File created with file that does not exist, filename: $filename");
	}
		
	// so we have a file, get info on it.
	$this->fileInfo = new SplFileInfo($filename);
		
//	if (strtoupper($this->fileInfo->getExtension()) !== 'X937') {
//	    throw new InvalidArgumentException("X937File created with file with non X937 file extension, filename: $filename.");
//	}
		
	// open our file for reading in binary mode.
	$this->fileHandle = fopen($filename, 'rb');
	
	/**
	 * @todo add record type check here, DATA_ASCII or DATA_EBCDIC
	 */
	$this->dataType = self::DATA_EBCDIC;
		
	// seek to 80 characters before the end of file. This SHOULD give us the file control recored.
	fseek($this->fileHandle, -80, SEEK_END);
	
	// read those 80 characters
	$fileControlRecordData = fread($this->fileHandle, 80);
	
	// build our file record from this data.
	$this->fileControlRecord = X937RecordFactory::newRecordFromRawData($fileControlRecordData, $this->dataType);
	if ($this->fileControlRecord instanceof X937RecordFileControl) {
	    $this->fileTotalAmount = $this->fileControlRecord->getFieldByNumber(5)->getValue()/100;
	    $this->fileItemCount   = $this->fileControlRecord->getFieldByNumber(4)->getValue();
	    $this->recordCount     = $this->fileControlRecord->getFieldByNumber(3)->getValue();
	}
	
	// rewind the file pointer;
	rewind($this->fileHandle);
	
	// set the position of our itterator at the beginging
	$this->currentRecordPosition = 0;
    }
	
    public function getFileInfo()        { return $this->fileInfo; }

    public function getFileTotalAmount() { return $this->fileTotalAmount; }
    public function getFileItemCount()   { return $this->fileItemCount; }
	
    public function readRecord() {
        // save our record position
        $this->recordPositions = ftell($this->fileHandle);
            
        // pull 4 bytes, this should contain our record length.
	$recordLengthData = fread($this->fileHandle, 4);
		
	// check to see if we have a value here. If not, we've reached the eof, and just return
	// if (!$recordLengthData) { return false; }
		
	// unpack our data into an int, unpack should return an with a single value
	// i.e. array '['int']=>RECORDLENGTH so array shift will get us the raw value.
	$this->curentRecordLength = array_shift(unpack("Nint", $recordLengthData));

	// read the data for our record. Build a record.
	$recordData = fread($this->fileHandle, $this->curentRecordLength);	
	$record     = X937RecordFactory::newRecordFromRawData($recordData, $this->dataType);
	
	// seek back to the old position
	fseek($this->fileHandle, -$this->curentRecordLength, SEEK_CUR);

	return $record;
    }

    /**
     * Implementation for countable. Returns the number of records from the file
     * control record. Be aware that if that count is wrong, this count is wrong.
     * @return int
     */
    public function count() {
	return $this->recordCount;
    }
    
    /**
     * Rewind to the first record.
     */
    public function rewind() {
	// set position back to 0, rewind file pointer.
	$this->currentRecordPosition = 0;
	rewind($this->fileHandle);
    }
    
    /**
     * Returns the current key for our record.
     * @return int Current position in the file.
     */
    public function key() {
	return $this->currentRecordPosition;
    }
    
    /**
     * Returns current record in the file.
     * @return X937Record The current x937Record
     */
    public function current() {
	$this->currentRecord = $this->readRecord();
	return $this->currentRecord;
    }
    
    public function next() {
	// advance the index
	$this->currentRecordPosition++;
	
	// seek to the next record position
	fseek($this->fileHandle, $this->curentRecordLength, SEEK_CUR);
    }
    
    /**
     * Returns true if we are at the end of our record set, false otherwise.
     * @return bool True if end of record set. False if not.
     */
    public function valid() {
	// if we are at the last record our file handle should point to the eof.
	// feof will return true in this case, we wan't the opposite.
	$currentPosition = ftell($this->fileHandle);
	$size = $this->fileInfo->getSize();
	
	if ($currentPosition >= $size) {
	    return false;
	} else {
	    return true;
	}
    }


    public function __destruct() {
	// close our file handle.
	fclose($this->fileHandle);
    }

}
