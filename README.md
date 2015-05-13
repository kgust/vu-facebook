# Vanderbilt Facebook Photos

For Jason Tan.

## Installation Instructions

1. `git clone ...`
2. `composer install`


## Running the development server

1. `php -S 0.0.0.0 index.php`

## NOTES:

For your simple requirements, this is very over-engineered but it helped me to organize my code.

Not to mention that it was really fun to create my own micro-framework out of a single composer dependency.

Field           | Description
--------------- | -----------
id              | numeric string
album           | Album node
created_time    | datetime
from            | User or Page node
height          | unsigned int32
icon            | string
images          | different stored representations of the photo
link            | link to the photo on facebook
name            | user-provided caption
width           | unsigned int32
picture         | link to 100px version
likes           | Edge: people who like this

### Running the photo updater

TBD
