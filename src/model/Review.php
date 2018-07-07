<?php
/**
 * Created by PhpStorm.
 * User: ducnguyen
 * Date: 6/7/18
 * Time: 9:26 AM
 */

namespace NinetyNineDesigns\PhpCodingTest\model;


class Review
{
    /**
     * @var string
     */
    protected $review;

    /**
     * @var int
     */
    protected $score;

    /**
     * @var Movie
     */
    protected $Movie;

    public function toString()
    {
        return "{$this->Movie->getTitle()} ({$this->Movie->getYear()}): {$this->review} {}";
    }
}