# Treend Test

Test was made with symfony fmk and DDD aproach.
Requirements: Docker , Docker Compose
The persitence infrastructure is mysql
All the infra (Docker image etc..) is inside the ops folder.

## Installation
Browse to folder :  ops/docker/ 

here we can access to several useful commands :

```bash
 ./compose
 ./start
 ./down 
 ./stop 
 ./console etc..
```
First step image build , docker compose up and install dependencies :
( Port 8001 and 3306 will be needed )

```bash
./build && ./up && ./composer install
```

Then is needed to create the database schema :

```bash
./console doctrine:schema:create
```

Run tests

```bash
./tests
```


Also a sql dump is provided at root project level

## REST - Usage

A Postman Collection is included at project root level




