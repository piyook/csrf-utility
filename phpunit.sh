#!/bin/bash
alias phpunit='docker-compose run --rm php ./vendor/bin/phpunit'

##to run multiple tests
# phpunit --repeat=10