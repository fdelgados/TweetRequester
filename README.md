# Tweet Requester

We need a small REST API with one endpoint that given a Twitter username, should return the user’s last 10 tweets, in JSON format.
 
 * Feel free to use any frameworks or libraries you need. 
 * If you want to use a framework, take into account that we use Symfony2.
 * The application should not save anything to MySQL or to any other relational DB.

## We will value

 * Code tested with Behat and/or PHPUnit (or with any other testing tool).
 * The code's architecture and the paradigm usage like Hexagonal Architecture and DDD.

## Bonus

 * Improve the application’s speed caching the response using Memcache(d), Redis or any other system you may know.

## Description

I have designed my application as an integration between two bounded context: TweetRequester and Twitter. The Twitter API
provides a lot of information of each tweet, but in my context we only need a few data, so I needed a translation layer.
This layer in DDD is called anticorruption layer and is placed in the infrastructure layer. This infrastructure service 
(TranslatingTweetService) is a combination of Adapter and Facade patterns. Facade pattern encapsulates and hide the operation
complexities and Adapter is in charge of translation.

TweeterRequester has an only point of entry, an application service (or use case) called GetLatestTweetsService. This service recives
a DTO with the request from the outside world, and call to domain service that get the tweets from TranslatingTweetService
and returns the info according to the business rule (ten tweets per user) to the application layer. Finally, the tweets are
returned within another DTO to the presentation layer.

## Technologies

 * Symfony2. Bundles: redis-bundle, guzzlehttp, fos/res-bundle
 * Redis