<?php

namespace NinetyNineDesigns\PhpCodingTest\model;

use NinetyNineDesigns\PhpCodingTest\Exceptions\InvalidRecordException;

class Movie extends BaseObject
{
    const TYPE = 'Movie';

    const TITILE_INDEX = 'title';
    const YEAR_INDEX = 'year';

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $year;

    /**
     * @param $movie
     * @return bool
     * @throws InvalidRecordException
     */
    public function initateMovie($movie)
    {
        if(!$this->isValidData($movie))
        {
            return false;
        }

        $this->setTitle($movie[self::TITILE_INDEX]);
        $this->setYear($movie[self::YEAR_INDEX]);
    }

    /**
     * @param $movie
     * @return bool
     * @throws InvalidRecordException
     */
    protected function isValidData($movie)
    {
        if(empty($movie) || is_array($movie))
        {
            throw new InvalidRecordException();
        }

        if(!isset($movie[self::TITILE_INDEX]) || !isset($movie[self::YEAR_INDEX]))
        {
            throw new InvalidRecordException();
        }

        return true;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }
}