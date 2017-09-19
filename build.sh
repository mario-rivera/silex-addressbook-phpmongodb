#!/bin/bash
PWD=$(pwd)
SCRIPT_WORKDIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
BASENAME_LOWER=$(basename $SCRIPT_WORKDIR | tr '[:upper:]' '[:lower:]')

NETNAME=addressbook
APP_IMAGE_NAME=administrate-test
APP_CONTAINER_NAME=addressbook
MONGO_DB_CONTAINER_NAME=addressbook-mongo

create_network_ifnotexists(){
    # -z is if output is empty
    if [ -z "$(docker network ls | grep $1)" ]; then
        docker network create $1
        echo "Network $1 created"
    fi
}

install(){
    build_image
    create_network_ifnotexists $NETNAME;

    composer

    mongodb_up
    web_up
}

build_image(){

    docker build -t $APP_IMAGE_NAME $SCRIPT_WORKDIR/docker/php
}

composer() {

    docker run -it --rm -v $SCRIPT_WORKDIR:/var/www $APP_IMAGE_NAME bash -c "composer install"
}

mongodb_up() {

    docker run -d --network=$NETNAME --name $MONGO_DB_CONTAINER_NAME mongo:3.5
}

web_up(){

    docker run -d --name $APP_CONTAINER_NAME -p 9999:80 --network=$NETNAME -v $SCRIPT_WORKDIR:/var/www $APP_IMAGE_NAME
}

destroy(){

    docker stop $APP_CONTAINER_NAME && docker rm $APP_CONTAINER_NAME
    docker stop $MONGO_DB_CONTAINER_NAME && docker rm $MONGO_DB_CONTAINER_NAME
    docker network rm $NETNAME
    docker rmi $APP_IMAGE_NAME
}

$1
