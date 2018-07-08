<?php

namespace NinetyNineDesigns\PhpCodingTest;

use NinetyNineDesigns\PhpCodingTest\model\FileIO;
use NinetyNineDesigns\PhpCodingTest\model\Movie;
use NinetyNineDesigns\PhpCodingTest\model\Review;
use NinetyNineDesigns\PhpCodingTest\model\Transformer;
use NinetyNineDesigns\PhpCodingTest\model\Utilities;


class Application
{
    /** @var string */
    protected $reviewFullPath = '';
    /** @var string  */
    protected $movieFullPath = '';

    /** @var Movie[] */
    protected $movies = [];

    /** @var Review[] */
    protected $reviews = [];

    /** @var FileIO */
    protected $fileIO;

    /** @var Transformer */
    protected $transformer;

    /** @var Utilities */
    protected $utilities;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        /**
         * @TODO: convert these attributes into services
         * and injected to this class
         *
         * Prerequisite: install this bundle JMS\DiExtraBundle\Annotation
         */
        $this->transformer = new Transformer();
        $this->utilities = new Utilities();
    }

    /**
     * @param $reviewsJson
     * @param $moviesJson
     * @return array
     */
    public function run($reviewsJson, $moviesJson)
    {
        /**
         * The application will need following classes
         *
         * - Transformer class is used to transform raw data into objects
         * - Review class
         * - Movie class
         * - Utility class is used to process array, trim string, search for characters, etc
         */

        /**
         * Read and transform Data from movies.json and reviews.json
         */
        $this->readData($reviewsJson, $moviesJson);

        /**
         * Process Tweet Reviews for each Movie
         */
        return $this->processTweets();
    }

    /**
     * @param $reviewsJson
     * @param $moviesJson
     * @return array|bool|Review[]
     */
    private function readData($reviewsJson, $moviesJson)
    {
        /**
         * Read and transform reviews.json datasource
         */
        $this->reviews = $this->transformer->transform(
            $reviewsJson, Review::TYPE
        );

        if(empty($this->reviews) | !is_array($this->reviews)) return false;

        /**
         * Read and tranform movies.json datasource
         */
        $this->movies = $this->transformer->transform(
            $moviesJson, Movie::TYPE
        );

        if(empty($this->movies) || !is_array($this->movies)) return false;

        /**
         * @var int $index
         * @var Movie $movie
         */
        foreach ($this->movies as $movie)
        {
            /**
             * We can have performance slightly better performance from here if
             * - Implement tweet process result within this loop
             *
             * However, to separate of concern and make cleaner code
             * The process to ouput the tweets should be in a different function
             */
            if(isset($this->reviews[$movie->getMovieTitle()]))
            {
                $this->reviews[$movie->getMovieTitle()]->setMovieYear($movie->getYear());
            }
        }
    }

    /**
     * @return array
     */
    private function processTweets()
    {
        if(count($this->reviews) === 0) return [];

        $results = [];

        /**
         * @var string $index
         * @var Review $review
         */
        foreach ($this->reviews as $index => $review)
        {
            $results[] = $review->getTweet($review);
        }

        return $results;
    }
}