
##How to run:

`$ composer install`

`$ cp .env.dist .env`

`$ php bin\console doctrine:schema:create`

`$ php bin\console doctrine:fixtures:load`

##Tests

`$ php bin\phpunit`

##API methods:

- [GET] `/users` - get list of users
- [POST] `/users` - create a user
- [GET] `/users/{id}` - get info about user
- [PUT] `/users/{id}` - edit a user info
- [GET] `/groups` - get list of groups
- [POST] `/groups` - create a group
- [GET] `/groups/{id}` - get info about group
- [PUT] `/groups/{id}` - edit a group info
