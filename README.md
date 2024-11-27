# About the Application

Simple subscription platform.

##  Clone the repository
`https://github.com/zakaria-achaghour/subscription-platform.git`
##  CD to the new directory
`cd subscription-platform`

## Rename cp .env.example .env
## Update the following fields in .env

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=subscriptionPlatform
DB_USERNAME=user
DB_PASSWORD=secret

QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null

##  Build the containers
`docker-compose up -d --build`

##  Run Command
`docker exec -it app bash`

##  Run Command
`composer install`

##  Run doctrine migrations
`php artisan migrate`

## run seed
`php artisan db:seed`

## 7. Run the queue worker for processing background jobs
`php artisan queue:work`


# Getting started with the Api EndPoints

## Websites
List Websites: GET /api/websites
`curl --request GET \
  --url 'http://localhost:80/api/websites?per_page=5&offset=0' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: Insomnia/2023.5.7'`

Create Website: POST /api/websites

curl --request POST \
  --url http://localhost:80/api/websites \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: Insomnia/2023.5.7' \
  --data '{
	"name": "test",
	"url": "https://techblosg.com"
}'

View Website: GET /api/websites/{id}
Update Website: PUT /api/websites/{id}
Delete Website: DELETE /api/websites/{id}

## Posts
List Posts: GET /api/posts
`curl --request GET \
  --url 'http://localhost:80/api/posts?per_page=5&offset=0' \
  --header 'User-Agent: Insomnia/2023.5.7'`

Create Post: POST /api/websites/{websiteId}/posts
`curl --request POST \
  --url http://localhost:80/api/websites/1/posts \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: Insomnia/2023.5.7' \
  --data '{
    "title": "New Post Title",
    "description": "This is the description of the post."
}'`
View Post: GET /api/posts/{id}
Update Post: PUT /api/posts/{id}
Delete Post: DELETE /api/posts/{id}


## Subscriptions
List Subscriptions: GET /api/subscriptions
Subscribe to Website: POST /api/websites/{websiteId}/subscriptions
View Subscription: GET /api/subscriptions/{id}
Delete Subscription: DELETE /api/subscriptions/{id}
