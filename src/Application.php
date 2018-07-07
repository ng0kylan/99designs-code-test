<?php

namespace NinetyNineDesigns\PhpCodingTest;

use NinetyNineDesigns\PhpCodingTest\model\FileIO;
use NinetyNineDesigns\PhpCodingTest\model\Movie;
use NinetyNineDesigns\PhpCodingTest\model\Review;
use NinetyNineDesigns\PhpCodingTest\model\Transformer;
use NinetyNineDesigns\PhpCodingTest\model\Utilities;

class Application
{
    const REVIEWS_FILE_PATH = '/data/movies.json';
    const MOVIES_FILE_PATH = '/data/movies.json';

    /** @var string */
    protected $reviewFullPath = '';
    /** @var string  */
    protected $movieFullPath = '';

    /** @var Movie[] */
    protected $movies;

    /** @var Review[] */
    protected $reviews;

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
        $this->reviewFullPath = $_SERVER['DOCUMENT_ROOT'] . self::REVIEWS_FILE_PATH;
        $this->movieFullPath = $_SERVER['DOCUMENT_ROOT'] . self::MOVIES_FILE_PATH;
    }

    public function run()
    {
        /**
         * The application will need following classes
         *
         * - FileIO class is used to read and process data from json files
         * - Transformer class is used to transform raw data into objects
         * - Review class
         * - Movie class
         * - Utility class is used to process array, trim string, search for characters, etc
         */

        /**
         * Read and transform Data from movies.json and reviews.json
         */
        $this->readData();

        /**
         * Process Tweet Reviews for each Movie
         */
    }

    /**
     * @return array|bool|Review[]
     */
    private function readData()
    {
        /**
         * Read and transform reviews.json datasource
         */
        $this->reviews = $this->transformer->transform(
            $this->fileIO->readFile($this->reviewFullPath), Review::TYPE
        );

        if(empty($this->reviews) | !is_array($this->reviews)) return false;

        /**
         * Read and tranform movies.json datasource
         */
        $this->movies = $this->transformer->transform(
            $this->fileIO->readFile($this->movieFullPath), Movie::TYPE
        );

        if(empty($this->movies) || !is_array($this->movies)) return false;

        /**
         * @var int $index
         * @var Movie $movie
         */
        foreach ($this->movies as $movie)
        {
            if(isset($this->reviews[$movie->getTitle()]))
            {
                $this->reviews[$movie->getTitle()]->setMovieYear($movie->getYear());
            }
        }

        return $this->reviews;
    }

    private function process()
    {

    }
}