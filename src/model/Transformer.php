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

    /**
     * @param $chunks
     * @param $type
     * @return array|Review[]
     */
    public function transform($chunks, $type)
    {
        if(empty($chunks) || !is_array($chunks)) return [];

        if(empty($type) || in_array($type, [Review::TYPE, Movie::TYPE])) return [];

        $this->resetTransformedData();

        foreach ($chunks as $index => $record)
        {
            $transformedRecord = $this->transformSingleRecord($record, $type);

            if($this->isValidRecord($record))
            {
                /**
                 * Log invalid records to produce invalid records exceptions
                 * Also continue to process the rest of valid records
                 * without stopping the application
                 */
                $this->invalidRecords[$index] = $record;
                continue;
            }

            $this->transformedData[] = $transformedRecord;
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
     * @return bool
     */
    private function transformSingleRecord($record, $type)
    {
        try
        {
            $transformedRecord = $this->utilities->convertStringToArray($record);

            switch ($type)
            {
                case Review::TYPE:
                    return (new Review())->initiateReview($transformedRecord);

                    break;

                case Movie::TYPE:
                    return (new Movie())->initateMovie($transformedRecord);

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