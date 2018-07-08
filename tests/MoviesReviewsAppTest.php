<?php

use NinetyNineDesigns\PhpCodingTest\MoviesReviewsApp;

class MoviesReviewsAppTest extends PHPUnit_Framework_TestCase
{
    private $reviewsJson;
    private $moviesJson;
    private $results;

    protected function setUp()
    {
        $reviewsJson = <<<'JSON'
            [
                {"title":"Star Wars","review":"Great, this film was","score":77},
                {"title":"Star Wars The Force Awakens","review":"A long time ago in a galaxy far far away someone made the best sci-fi film of all time. Then some chap came along and basically made the same movie again","score":50},
                {"title":"Metropolis","review":"Another movie about a robot. Very strong futuristic look. But also very very old. Hard to understand what was happening because the audio was too low","score":15},
                {"title":"Dr. Strangelove or How I Learned to Stop Worrying and Love the Bomb","review":"Hilarious Kubrick satire","score":100},
                {"title":"Plan 9 from outer space","review":"So bad it's bad","score":7},
                {"title":"Spartan","review":"","score":7},
                {"title":"Hercule","review":"Hercule legend","score":120},
                {"title":"Lion king","review":"Cartoon movie","score":-12},
                {"title":"","review":"Empty title movie","score":7}
            ]
JSON;

        $moviesJson = <<<'JSON'
            [
                {"title":"Star Wars","year":1977},
                {"title":"Star Wars The Force Awakens","year":2015},
                {"title":"Dr. Strangelove or How I Learned to Stop Worrying and Love the Bomb","year":1964},
                {"title":"Plan 9 from outer space","year":1959},
                {"title":"Spartan","year":2004},
                {"title":"Hercule","year":1988},
                {"title":"Lion king","year":2009},
                {"title":"","year":2003}
            ]
JSON;

        $this->results = MoviesReviewsApp::run($reviewsJson, $moviesJson);
    }

    public function testFormatsTheStarWarsReviewCorrectly()
    {
        $this->assertEquals($this->results[0], 'Star Wars (1977): Great, this film was ★★★★');
    }

    public function testFormatsTheForceAwakensCorrectly()
    {
        $this->assertEquals($this->results[1], 'Star Wars The Force Awake (2015): A long time ago in a galaxy far far away someone made the best sci-fi film of all time. Then some chap ★★½');
    }

    public function testFormatsTheMetropolisCorrectly()
    {
        $this->assertEquals($this->results[2], 'Metropolis: Another movie about a robot. Very strong futuristic look. But also very very old. Hard to understand what was happening becaus ★');
    }

    public function testFormatsDrStrangeLoveCorrectly()
    {
        $this->assertEquals($this->results[3], 'Dr. Strangelove or How I Learned to Stop Worrying and Love the Bomb (1964): Hilarious Kubrick satire ★★★★★');
    }

    public function testFormatsPlan9Correctly()
    {
        $this->assertEquals($this->results[4], "Plan 9 from outer space (1959): So bad it's bad ½");
    }

    public function testEmptyReview()
    {
        $this->assertEquals($this->results[5], 'Spartan (2004) ½');
    }

    public function testOverlimitRating()
    {
        $this->assertEquals($this->results[6], 'Hercule (1988): Hercule legend ★★★★★');
    }

    public function testNegativeScore()
    {
        $this->assertEquals($this->results[7], 'Lion king (2009): Cartoon movie');
    }

    public function testEmptyTitle()
    {
        $this->assertEquals($this->results[8], '(2003): Empty title movie ½');
    }
}
