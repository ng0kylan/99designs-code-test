# 99movies

Please read the following instructions carefully and especially what we are looking for from this test

## Background

At 99designs, we love lots of things. Great design, great coffee, great code and when it comes time to unwind... great movies.

We want to share our enthusiasm for movies with our customers, and have decided to write a program to read in movie reviews that our employees have written, and then compose "tweets" that we can share through our company account.

## Data

We've got the following data

- `data/reviews.json` - captured via an online survey tool, this file has the list of all new employee reviews we have yet to tweet about
- `data/movies.json` - this file contains a list of the movies we've watched, and information about that movie

## Requirements

- Read in the list of reviews
- Read in the list of movies
- For each review, output a "tweet" of that review, which should follow these rules:
  - Tweets should follow the format `Movie Title (year): Review of the movie ★★★★½`
  - If the year cannot be found, it should be omitted
  - Tweets may not have more than 140 characters
  - If the tweet would go over this limit, titles should be trimmed to 25 characters
  - If the tweet is still over the limit, then the review text should be shortened too until it is exactly 140 characters
  - The score should be presented as Unicode stars, using a "five star rating" with halves

(see `tests/MoviesReviewsAppTest.php` for specific details and edge cases)

## Getting Started

Create a directory to work on your project. Copy `99designs-code-test.tar.gz` into the directory and extract using `tar -xzpf 99designs-code-test.tar.gz`

You will require php and composer to be installed to run through this exercise. Once installed, ensure the dependencies are installed by running `composer install`.

Once installed, you should be able to run the following commands:

- `./run.php` : Runs the application and prints the output to the terminal
- `vendor/bin/phpunit` : Runs the test suite; there are some tests to get you started, but you'll probably want to add more as you work

## Submitting

In your project directory, run:

```
tar -cvzf your_name.tar.gz .
```
(replacing *your_name* with your actual name, of course)

Then email the created tar.gz file back to the person who sent you the test

## What are we looking for

Firstly, you should write in PHP, even if this is not a language you are familiar with. We are not looking for perfect, idiomatic PHP, especially if this isn't your primary programming language.

We will be interested in your approach to the problem, and what methods you use, almost as much as the final result.

When coding, you should aim for:
- Clean, readable code
- Production quality - e.g. imagine this is a core part of a larger codebase
- Solid testing approach - this will involve writing more tests than those given
- Using Git
  - try and commit small changes; this helps us see your approach and workflow
  - make sure you include the `.git` directory in the packaged .tar.gz file you send back

There are no tricks or nasty surprises in the test. Just write good, solid code to solve the few requirements

## Do not republish

Please do not publish our test, or your solution publicly. We do not want candidates to see other test submissions, or have access to our test.
