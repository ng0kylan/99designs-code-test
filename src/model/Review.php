<?php

namespace NinetyNineDesigns\PhpCodingTest\model;

use NinetyNineDesigns\PhpCodingTest\Exceptions\InvalidRecordException;

class Review extends BaseObject
{
    const TYPE = 'Review';
    const MAX_TWEET_CHARS_COUNT = 140;
    const TRIM_CHARACTERS_AMOUNT = 25;

    const REVIEW_INDEX = 'review';
    const SCORE_INDEX = 'score';

    const MAX_STAR_REVIEW = 5;
    const MAX_SCORE = 100;
    const STAR_CHARACTER = '★';
    const HALF_CHARACTER = '½';

    const CALC_RETURN_FORMAT_STRING = 'string';
    const CALC_RETURN_COUNT_STRING = 'count_string';

    /** @var string */
    protected $review;

    /** @var int */
    protected $score;

    /** @var Movie */
    protected $Movie;

    /**
     * Review constructor.
     */
    public function __construct()
    {
        $this->Movie = new Movie();
        $this->utilities = new Utilities();
    }

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

        $this->Movie->setTitle($review->{Movie::TITILE_INDEX});

        $this->setReview($review->{self::REVIEW_INDEX});
        $this->setScore($review->{self::SCORE_INDEX});

        return $this;
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
            !isset($review->{Movie::TITILE_INDEX})
            || !isset($review->{self::REVIEW_INDEX})
            || !isset($review->{self::SCORE_INDEX})
        )
        {
            throw new InvalidRecordException();
        }

        return true;
    }

    /**
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param string $review
     */
    public function setReview(string $review)
    {
        $this->review = $review;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param int $score
     * @return $this
     */
    public function setScore(int $score)
    {
        if($score < 0)
        {
            $this->score = 0;
            return $this;
        }

        if($score > self::MAX_SCORE)
        {
            $this->score = self::MAX_SCORE;
        }
        else
        {
            $this->score = $score;
        }

        return $this;
    }

    /**
     * @return Movie
     */
    public function getMovie()
    {
        return $this->Movie;
    }

    /**
     * @param Movie $Movie
     */
    public function setMovie(Movie $Movie)
    {
        $this->Movie = $Movie;
    }

    /**
     * @param $year
     * @return bool
     */
    public function setMovieYear($year)
    {
        if(!$this->isValidMovie()) return false;

        $this->getMovie()->setYear($year);
    }

    /**
     * @return bool|string
     */
    public function getMovieTitle()
    {
        if(!$this->isValidMovie()) return false;

        return $this->getMovie()->getMovieTitle();
    }

    /**
     * @return bool
     */
    private function isValidMovie()
    {
        return $this->getMovie() instanceof Movie;
    }

    /**
     * @param string $returnFormat
     * @return float|int|string
     */
    private function getCalculatedRating($returnFormat = self::CALC_RETURN_FORMAT_STRING)
    {
        $stars   = floor((round($this->score / 10) / 2));
        $halves  = round($this->score / 10) % 2;
        $empties = 5 - $stars - $halves;

        $countSpaces = ($stars > 0 || $halves > 0) ? 1 : 0;
        $emptySpace = ($stars > 0 || $halves > 0) ? ' ' : '';

        switch ($returnFormat)
        {
            case self::CALC_RETURN_COUNT_STRING:
                return $stars + $halves;
                break;

            default:
                return $emptySpace. str_repeat(self::STAR_CHARACTER, $stars)
                    . str_repeat(self::HALF_CHARACTER, $halves)
                    . str_repeat('', $empties);
                break;
        }
    }

    /**
     * @return string
     */
    private function getTweetWithTrimedTitle()
    {
        $this->getMovie()->setTrimmedTitle(self::TRIM_CHARACTERS_AMOUNT);

        return $this->toString();
    }

    /**
     * @param $trimmedTweet
     * @return string
     */
    private function getTweetWithTrimmedTitleAndReview($trimmedTweet)
    {
        /**
         * if there is no movie year
         * should remove an extra 1 empty space from limit
         */
        $overLimitAmount = $this->calculateTotalTweetLength() - self::MAX_TWEET_CHARS_COUNT;

        $this->setReview($this->utilities->trimCharacters($this->getReview(), $overLimitAmount));

        return $this->toString();
    }

    /**
     * @param $review
     * @return string
     */
    public function getTweet($review)
    {
        if(!$review instanceof Review) return '';

        /**
         * append tweet review to the results
         * if tweet is under limit
         * continue the next review
         */
        if($this->calculateTotalTweetLength() <= self::MAX_TWEET_CHARS_COUNT)
        {
            return $review->toString();
        }

        $trimmedTweet = $this->getTweetWithTrimedTitle();
        if($this->calculateTotalTweetLength() <= self::MAX_TWEET_CHARS_COUNT)
        {
            return $trimmedTweet;
        }

        return $this->getTweetWithTrimmedTitleAndReview($trimmedTweet);
    }

    /**
     * @return float|int|string
     */
    public function calculateTotalTweetLength()
    {
        $titleLength = strlen($this->Movie->getMovieTitle());
        $yearLength = (empty($this->Movie->getYear())) ? 0 : strlen(" ({$this->Movie->getYear()})");
        $reviewLength = (empty($this->review)) ? 0 : strlen(": {$this->review}");
        $ratingLength = $this->getCalculatedRating(self::CALC_RETURN_COUNT_STRING);

        return $titleLength + $yearLength + $reviewLength + $ratingLength;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $movieTitle = $this->Movie->getMovieTitle();
        $movieYear = (empty($this->Movie->getYear())) ? '' : " ({$this->Movie->getYear()})";
        $reviewDescription = (empty($this->review)) ? '' : ": {$this->review}";

        return trim("{$movieTitle}{$movieYear}{$reviewDescription}{$this->getCalculatedRating()}");
    }
}