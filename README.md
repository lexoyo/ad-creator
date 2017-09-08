# Facebook Ad Creator

## About

This app is made for companies to create ads automatically every time an event occures, e.g. publication of a new blog post, new items for sale, promotions, daily specials... The content used to generate the app is created with a smart algorithm, which is able to get the best title and text out of your content. The generated apps are then available in your Ad Manager, ready to be activated or modified.

The php script `advertise.php` is a web hook called by IFTTT when an event occures and it uses embed.ly to extract the main features of the content. The page `index.php` is there for you to test the service, so you can submit an URL to advertise.php the same way IFTTT does it.

Here this is a demo of this app online:
https://ad-creator.herokuapp.com/

detailed step-by-step instructions:
* open https://ad-creator.herokuapp.com/
* authorize the app to access your ad account **which needs to have a payment method set** (be careful it may delete ads in the 1st ad set if it needs to)
* submit an URL like this one: https://www.thinkgeek.com/product/knio/
* go to your ad manager and you should see the new ad (for now the app uses a sandbox account so you will not actually see your ad)


## Use case

online shop
* client is the owner of an online shop
* every new product generates an ad
* when a product is not soldout after 30 days it generates an ad with a promo
* he can start the generated ads in his ads manager

influencer
* new posts a 5$ ad
* every month, the best post is promoted 

help create large advert campaign
* generate articles
* use the app to generate multiple ads out of the articles

## Demo

test urls (http://ad-creator.herokuapp.com/):
* http://www.vauxhall.co.uk/offers-finance/cars_offers/corsa/flexible-personal-lease.html
* https://www.silexlabs.org/event/silex-labs-aperopensource-edition-mois-daout/
* https://www.thinkgeek.com/product/knio/
* https://singchan.github.io/bot-emploi/

The web hook (http://localhost:8080/advertise.php?url=)
* https://github.com/lexoyo/so-simple-theme/
* https://ifttt.com/applets/60555094d-if-new-feed-item-from-http-lexoyo-me-so-simple-theme-feed-xml-then-make-a-web-request

third party tools
* ifttt to automate (watch RSS feeds, emails...)
* embed.ly to extract the main features of the content
* official FB php SDK
* cloudflare and ngrok for tunnelling and work locally with https URLs for webhooks

difficulties
* had to understand the different accounts involved (ad account, business, my account)
* best way to lookup for properties and methods on a class is to look at the source code of the php sdk
* ad manager do not see the sandbox ad accounts
* 50 ads per set, had to check and cleanup

Next steps
* error handling!!
* wordpress plugin
* consolidate insights for all ads
* retarget users with a new related product
* use FB webhook/insights API to create ads specific to a new prospect or target fans

other (useless) ideas
* launch a campaign with an email or sms?


## use

commands
* source config.sh
* `tail -f logs.txt`
* sudo tail -f /var/log/httpd/error_log
* php -S localhost:8080
* ngrok http 8080

## notes and links

rss
* https://github.com/lexoyo/so-simple-theme/
* https://ifttt.com/applets/60555094d-if-new-feed-item-from-http-lexoyo-me-so-simple-theme-feed-xml-then-make-a-web-request
* https://ifttt.com/applets/60553950d-if-new-feed-item-from-http-www-silexlabs-org-feed-then-make-a-web-request
* https://adce2c63.ngrok.io/advertize.php

embed ly
* https://api.embed.rocks/api/?url=http://www.vauxhall.co.uk/offers-finance/cars_offers/corsa/flexible-personal-lease.html&key=85f6a5c5-06f8-45d9-b3cc-c41f931c79d2

redirect
* https://www.cloudflare.com/a/page-rules/lexoyo.me
* https://github.com/ns1/contrib (
* https://lexoyo.me/proto-fb/advertize.php
* used in https://developers.facebook.com/apps/1948258332120118/settings/ and https://ifttt.com/applets/60555094d-if-new-feed-item-from-http-lexoyo-me-so-simple-theme-feed-xml-then-make-a-web-request and https://ifttt.com/applets/60553950d-if-new-feed-item-from-http-www-silexlabs-org-feed-then-make-a-web-request


