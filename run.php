#!/usr/bin/env php
<?php

use NinetyNineDesigns\PhpCodingTest\MoviesReviewsApp;

require_once __DIR__ . '/vendor/autoload.php';

// load the data files into strings for you
$reviewsJson = file_get_contents(__DIR__ . '/data/reviews.json');
$moviesJson = file_get_contents(__DIR__ . '/data/movies.json');

// call the app, passing the data as strings containing JSON
$results = MoviesReviewsApp::run($reviewsJson, $moviesJson);

// pretty print the output
echo "Tweets:\n";
echo "-------\n";
echo implode($results, "\n");
