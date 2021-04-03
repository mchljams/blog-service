# Blog Service 

## Getting the app started

0. Create the database.sqlite in the /database directory
1. run `php artisan serve` to start the app

## Testing

I tested my progress with postman, my collection is committed in the root of the project.
(I didn't have time to parameterize it or create an environment configuration so
it will likely have my test data in it too)

## Gotchas

Here are the items that I would have liked to flush out more

* If a user can only update and delete their own tags, can 
they use other users tags on their posts? Or can they only tag with 
the tags they have created? OR is it that an admin will define the set 
of tags that a user may choose from?
* having the JWT token returned on create and update from thr resource


##  What I would do next

* get the user logout route working
* get a proper error response set up when a user is not authenticated
* start writing the API integration tests and make use of factories
* I really like the laravel swagger package. Id probably start 
integrating that to automatically generate the API docs. Although 
I have not tried with L8 so not sure if its supported.
* If I was taking my time I'd spend more time on comments and docblock

## What would I have done differently

* I would have used a tagging package, rather than building that from scratch.
* Maybe looked for images package? Or worked that first. That's an area I have not 
really spent much time on in the past.