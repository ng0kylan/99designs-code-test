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
                {"title":"Plan 9 from outer space","review":"So bad it's bad","score":7}
            ]
JSON;

        $moviesJson = <<<'JSON'
            [
                {"title":"Star Wars","year":1977},
                {"title":"Star Wars The Force Awakens","year":2015},
                {"title":"Dr. Strangelove or How I Learned to Stop Worrying and Love the Bomb","year":1964},
                {"title":"Plan 9 from outer space","year":1959}
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
}
