<?php
/**
 * Created by PhpStorm.
 * User: ducnguyen
 * Date: 6/7/18
 * Time: 9:26 AM
 */

namespace NinetyNineDesigns\PhpCodingTest\model;


class Movie
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $year;

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