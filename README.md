

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


## Next steps

* wordpress plugin
* consolidate insights for all ads
* retarget users with a new related product
* use FB webhook/insights API to create ads specific to a new prospect or target fans

other (useless) ideas
* launch a campaign with an email?



## third party tools

* ifttt to automate (watch RSS feeds, emails...)
* embed.ly to extract the main features of the content
* official FB php SDK
* cloudflare and ngrok for tunnelling and work locally with https URLs for webhooks


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
* http://embed.ly/code?url=http%3A%2F%2Fwww.vauxhall.co.uk%2Foffers-finance%2Fcars_offers%2Fcorsa%2Fflexible-personal-lease.html
* http://www.vauxhall.co.uk/offers-finance/cars_offers/corsa/flexible-personal-lease.html
* http://embed.ly/docs/explore/extract?url=http%3A%2F%2Fwww.vauxhall.co.uk%2Foffers-finance%2Fcars_offers%2Fcorsa%2Fflexible-personal-lease.html

redirect
* https://www.cloudflare.com/a/page-rules/lexoyo.me
* https://github.com/ns1/contrib (
* https://lexoyo.me/proto-fb/advertize.php
* used in https://developers.facebook.com/apps/1948258332120118/settings/ and https://ifttt.com/applets/60555094d-if-new-feed-item-from-http-lexoyo-me-so-simple-theme-feed-xml-then-make-a-web-request and https://ifttt.com/applets/60553950d-if-new-feed-item-from-http-www-silexlabs-org-feed-then-make-a-web-request


