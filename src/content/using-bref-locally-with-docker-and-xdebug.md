# Using Bref.sh locally with Docker and Xdebug

Add the following configuration to VS Code debug.

```
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for XDebug",
            "type": "php",
            "request": "launch",
            "pathMappings": {
                "/var/task": "${workspaceRoot}"
            },
            "port": 9000
        },
        {
            "name": "Launch currently open script",
            "type": "php",
            "request": "launch",
            "program": "${file}",
            "cwd": "${fileDirname}",
            "port": 9000
        }
    ]
}
```

The docker-compose.yaml file would look like:

```
version: "3.5"
services:
    postgres:
        image: postgres:11-alpine
        ports:
            - 5432:5432
    web:
        image: bref/fpm-dev-gateway
        ports:
            - "8000:80"
        volumes:
            - .:/var/task:ro # Read only, like a lambda function
        depends_on:
            - php
        env_file: .env
        environment:
            HANDLER: web/index.php
            SITE_URL: http://localhost:8000
    php:
        image: bref/php-73-fpm-dev
        env_file: .env
        volumes:
            - .:/var/task:ro # Read only, like a lambda function
    blackfire:
        image: blackfire/blackfire
        environment:
            BLACKFIRE_SERVER_ID: id
            BLACKFIRE_SERVER_TOKEN: token
```

This configuration gives us a Lambda (Bref.sh) envrionment locally with Docker using XDebug and Blackfire!
