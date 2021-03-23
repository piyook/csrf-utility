#!/bin/bash
alias phpunit='docker-compose run --rm server ./vendor/bin/phpunit'

## if container running
## alias phpunit='docker-compose exec server ./vendor/bin/phpunit'

##to run multiple tests
# phpunit --repeat=10

##to test header information (phpunit sends header when run and then no more can be set ..)
##phpunit --stderr <options>