<?php

namespace NinetyNineDesigns\PhpCodingTest\model;

use NinetyNineDesigns\PhpCodingTest\Exceptions\InvalidRecordException;

class Review extends BaseObject
{
    const TYPE = 'Review';

    const REVIEW_INDEX = 'review';
    const SCORE_INDEX = 'score';

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

    /**
     * @param $review
     * @return bool
     * @throws InvalidRecordException
     */
    public function initiateReview($review)
    {
        if(!$this->isValidData($review))
        {
            return false;
        }

        $this->Movie = new Movie();
        $this->Movie->setTitle($review[Movie::TITILE_INDEX]);

        $this->setReview($review[self::REVIEW_INDEX]);
        $this->setScore($review[self::SCORE_INDEX]);
    }

    /**
     * @param $review
     * @return bool|mixed
     * @throws InvalidRecordException
     */
    protected function isValidData($review)
    {
        if(empty($review) || is_array($review))
        {
            throw new InvalidRecordException();
        }

        if(
            !isset($review[Movie::TITILE_INDEX])
            || !isset($review[self::REVIEW_INDEX])
            || !isset($review[self::SCORE_INDEX])
        )
        {
            throw new InvalidRecordException();
        }

        return true;
    }

    /**
     * @return string
     */
    public function getReview(): string
    {
        return $this->review;
    }

    /**
     * @param string $review
     */
    public function setReview(string $review): void
    {
        $this->review = $review;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    /**
     * @return Movie
     */
    public function getMovie(): Movie
    {
        return $this->Movie;
    }

    /**
     * @param Movie $Movie
     */
    public function setMovie(Movie $Movie): void
    {
        $this->Movie = $Movie;
    }

    /**
     * @param $year
     * @return bool
     */
    public function setMovieYear($year)
    {
        if(!$this->getMovie() instanceof Movie) return false;

        $this->getMovie()->setYear($year);
    }

    /**
     * @return string
     */
    public function toString()
    {
        return "{$this->Movie->getTitle()} ({$this->Movie->getYear()}): {$this->review} {}";
    }
}