<?php

namespace NinetyNineDesigns\PhpCodingTest;

class MoviesReviewsApp
{
    /**
     * @param string $reviewsJson
     * @param string $moviesJson
     */
    public static function run(string $reviewsJson, string $moviesJson)
    {
        try
        {
            $application = new Application();
            $application->run();
        }
        catch (\Exception $e)
        {

        }
    }
}
