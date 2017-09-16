$PWD=$pwd.Path
$NETNAME='addressbook'

$APP_IMAGE_NAME='administrate-test'
$APP_CONTAINER_NAME="addressbook"
$MONGO_DB_CONTAINER_NAME="addressbook-mongo"

function create_network_ifnotexists($network){

    if(-Not (docker network ls | findstr $network)){
        docker network create $network
        echo "Created network $network"
    }
}

function install(){

    build_app_image
    create_network_ifnotexists $NETNAME

    composer

    mongodb_up
    web_up
}

function build_app_image(){

    docker build -t $APP_IMAGE_NAME $PWD\docker\php
}

function composer() {

    docker run -it --rm -v $PWD\:/var/www $APP_IMAGE_NAME bash -c "composer install"
}

function mongodb_up() {

    docker run -d --network=$NETNAME --name $MONGO_DB_CONTAINER_NAME mongo:3.5
}

function web_up(){

    docker run -d --name $APP_CONTAINER_NAME -p 9999:80 --network=$NETNAME -v $PWD\:/var/www $APP_IMAGE_NAME
}

function destroy(){

    (docker stop $APP_CONTAINER_NAME) -and (docker rm $APP_CONTAINER_NAME)
    (docker stop $MONGO_DB_CONTAINER_NAME) -and (docker rm $MONGO_DB_CONTAINER_NAME)
}

$fn=$args[0]
&"$fn"
