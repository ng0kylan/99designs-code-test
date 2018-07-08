<?php

namespace NinetyNineDesigns\PhpCodingTest\model;

use NinetyNineDesigns\PhpCodingTest\Exceptions\InvalidRecordException;

class Transformer
{
    /** @var array  */
    protected $invalidRecords = [];

    /** @var array|Review[]  */
    protected $transformedData = [];

    /** @var Utilities */
    private $utilities;

    public function __construct()
    {
        $this->utilities = new Utilities();
    }

    /**
     * @param string $jsonData
     * @param string $type
     * @return array|Review[]
     */
    public function transform($jsonData, $type)
    {
        if(empty($jsonData)) return [];

        if(empty($type) || !in_array($type, [Review::TYPE, Movie::TYPE])) return [];

        $this->resetTransformedData();

        try
        {
            $records = $this->utilities->convertStringToArray($jsonData);

            foreach ($records as $index => $record)
            {
                $transformedRecord = $this->transformSingleRecord($record, $type);

                if(!$this->isValidRecord($record))
                {
                    /**
                     * Log invalid records to produce invalid records exceptions
                     * Also continue to process the rest of valid records
                     * without stopping the application
                     */
                    $this->invalidRecords[$index] = $record;
                    continue;
                }

                $this->transformedData[$transformedRecord->getMovieTitle()] = $transformedRecord;
            }
        }
        catch(InvalidRecordException $e)
        {
            return false;
        }

        return $this->transformedData;
    }

    private function resetTransformedData()
    {
        $this->transformedData = [];
    }

    /**
     * @param $record
     * @param $type
     * @return Movie|Review|bool
     */
    private function transformSingleRecord($record, $type)
    {
        try
        {
            switch ($type)
            {
                case Review::TYPE:
                    return (new Review())->initiateReview($record);

                    break;

                case Movie::TYPE:
                    return (new Movie())->initateMovie($record);

                    break;
            }
        }
        catch(InvalidRecordException $e)
        {
            return false;
        }
    }

    /**
     * @param $record
     * @return bool
     */
    private function isValidRecord($record)
    {
        return (!$record instanceof Movie || !$record instanceof Review);
    }
}