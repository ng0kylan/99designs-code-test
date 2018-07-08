<?php

namespace NinetyNineDesigns\PhpCodingTest;

class MoviesReviewsApp
{
    /**
     * @param string $reviewsJson
     * @param string $moviesJson
     * @return array
     */
    public static function run(string $reviewsJson, string $moviesJson)
    {
        try
        {
            $application = new Application();
            return $application->run($reviewsJson, $moviesJson);
        }
        catch (\Exception $e)
        {
            
        }
    }
}
