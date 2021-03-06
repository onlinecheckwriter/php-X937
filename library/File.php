<?php

namespace X937;

use X937\Records;
use X937\Records\Record;

/**
 * An X937File
 *
 * @todo Test ASCII file codepaths. Currently untested as have no example work.
 */
class File implements \Iterator
{
    // data type constants
    const DATA_ASCII = 'ASCII';
    const DATA_EBCDIC = 'EBCDIC-US';
    
    // data type constat array
    const DATA_TYPES = array(
        self::DATA_ASCII => self::DATA_ASCII,
        self::DATA_EBCDIC => self::DATA_EBCDIC,
    );

    // file signature constants.
    const FILE_SIGNATURE_ASCII = '3031';
    const FILE_SIGNATURE_EBCDIC = 'f0f1';

    /**
     * Our FileHandle.
     * @var resource
     */
    private $fileHandle;

    /**
     * A SplFileInfo object for our file.
     * @var \SplFileInfo
     */
    private $fileInfo;

    /**
     * The type of the data, either self::DATA_ASCII self::DATA_EBCDIC
     * @var string
     */
    private $dataType = self::DATA_ASCII;

    /**
     * File Header Records for the File
     * @var Record
     */
    private $fileHeaderRecord;

    /**
     * File Control Records for the File
     * @var Record
     */
    private $fileControlRecord;

    /**
     * Factory for creating records.
     *
     * @var Records\RecordFactory
     */
    private $recordFactory;

    /**
     * Creates a new X937File. It is immediatly validated for dataType (EBCDIC
     * vs ASCII) and for presence of the File Header Records at the start of the
     * file and File Control Records at the end of the file. Throws exception if
     * these two mandatory Records are not present.
     * @param string $filename the path to the X937File
     * @param string $recordSpecFilename the path to the x937 specification xml
     * @throws \InvalidArgumentException
     */
    public function __construct(string $filename, string $recordSpecFilename)
    {
        // input validation        
        // check for existance of our file
        $filename = realpath($filename);
        if (!file_exists($filename)) {
            throw new \InvalidArgumentException("X937File created with file that does not exist, filename: $filename");
        }

        // so we have a file, get info on it.
        $this->fileInfo = new \SplFileInfo($filename);

        // open our file for reading in binary mode.
        $this->fileHandle = fopen($filename, 'rb');

        // read our file data type.
        $this->dataType = $this->readFileDataType();

        // build our factory
        $recordSpecFilename = realpath($recordSpecFilename);
        $this->recordFactory = new Records\RecordFactory($recordSpecFilename);

        // pull the first record, this should always be the file header record.
        $this->fileHeaderRecord = $this->current();

        if ($this->fileHeaderRecord->type !== Records\RecordType::FILE_HEADER) {
            throw new \InvalidArgumentException('Bad file given, first record is not a File Header Records.');
        }

        // seek to 80 bytes from the EOF. This should be the File Control Records
        fseek($this->fileHandle, -80, SEEK_END);

        // read those 80 characters
        $fileControlRecordData = fread($this->fileHandle, 80);

        // build our file record from this data.
        $this->fileControlRecord = $this->recordFactory->generateRecord($fileControlRecordData, $this->dataType);
        if ($this->fileControlRecord->type !== Records\RecordType::FILE_CONTROL) {
            throw new \InvalidArgumentException('Bad file given, last record is not a File Control Records.');
        }

        // rewind to the beginning so users can start itteration.
        $this->rewind();
    }

    /**
     * Read teh file data type. According to spec this is done by checking the
     * first field in the first record (that is the File Header Records - Type 01
     * Field 01 - Records Type). Should be 0xf0f1 for EBCDIC and 0x3031 for ASCII
     * If neither of those, we got bad data. The file pointer is rewinded by
     * this function.
     * @return string the file data type.
     * @throws \InvalidArgumentException
     */
    private function readFileDataType(): string
    {
        // seek to the right location. 4 bytes from the start of the file.
        fseek($this->fileHandle, 4, SEEK_SET);

        // parse the first two bytes, which contain the appropriate record.
        $initialRecordDataTypeRaw = fread($this->fileHandle, 2);
        $initialRecordDataTypeHex = bin2hex($initialRecordDataTypeRaw);

        // switch on that data, comparing them to the known hex values.
        switch ($initialRecordDataTypeHex) {
            case self::FILE_SIGNATURE_EBCDIC:
                $dataType = self::DATA_EBCDIC;
                break;
            case self::FILE_SIGNATURE_ASCII:
                $dataType = self::DATA_ASCII;
                break;
            default:
                throw new \InvalidArgumentException('Unable to parse file, bad data given.');
        }

        // rewind to the start of the file.
        rewind($this->fileHandle);

        return $dataType;
    }

    /**
     * Returns current record in the file.
     * @return Record The current x937Record
     */
    public function current(): Records\Record
    {
        // get the current record length.
        $recordLength = $this->readRecordLength();

        // read the data for our record. Build a record.
        $recordData = $this->readRecord($recordLength);
        $record = $this->recordFactory->generateRecord($recordData, $this->dataType);

        return $record;
    }

    /**
     * Reads the current record length and returns it.
     * The file cursor is returned to its original position.
     * @return int Length of the record (in bytes)
     */
    private function readRecordLength(): int
    {
        // pull 4 bytes, this should contain our record length.
        $recordLengthData = fread($this->fileHandle, 4);

        // unpack our data into an int, unpack should return an with a single
        // value i.e. array '['int']=>RECORDLENGTH so array shift will get us
        // the raw value.
        $unpackedData = unpack('N', $recordLengthData);
        $curentRecordLength = array_shift($unpackedData);

        // return the cursor to it's previous position.
        fseek($this->fileHandle, -4, SEEK_CUR);

        return $curentRecordLength;
    }

    /**
     * Reads the data for the current record.
     * The file cursor is returned to its original position.
     * @param int $recordLength
     * @return string the raw record data.
     */
    private function readRecord(int $recordLength): string
    {
        // seek forward 4 bytes, our cursor should always be at the beginning of
        // a record, so we need to advance 4 bytes (past the record length part)
        // to get to our data.
        fseek($this->fileHandle, 4, SEEK_CUR);

        // read the data for our record.
        $recordData = fread($this->fileHandle, $recordLength);

        // return the cursor to it's previous position.
        fseek($this->fileHandle, -$recordLength, SEEK_CUR);
        fseek($this->fileHandle, -4, SEEK_CUR);

        return $recordData;
    }

    /**
     * Rewind to the first record.
     */
    public function rewind()
    {
        // rewind file pointer.
        rewind($this->fileHandle);
    }

    public function getFileTotalAmount()
    {
        return $this->fileControlRecord[5]->getValue() / 100;
    }

    public function getFileItemCount()
    {
        return $this->fileControlRecord[4]->getValue();
    }

    /**
     * Returns the current key for our record, which is the location of the
     * beginning of the record in the file, in bytes, with the data length record
     * field. I.E. 4 bytes before the actual data's position.
     * @return int Key for the record, it's position in the file (in bytes)
     */
    public function key(): int
    {
        return ftell($this->fileHandle);
    }

    /**
     * Advance to the next record in the file.
     */
    public function next()
    {
        // get the current record length
        $currentRecordLength = $this->readRecordLength();

        // seek to the next record position
        fseek($this->fileHandle, $currentRecordLength + 4, SEEK_CUR);
    }

    /**
     * Returns true if we are at the end of our record set, false otherwise.
     * @return bool True if end of record set. False if not.
     */
    public function valid(): bool
    {
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

    public function __destruct()
    {
        // close our file handle.
        fclose($this->fileHandle);
    }
}
