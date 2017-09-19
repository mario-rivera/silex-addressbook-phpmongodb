## Prerequsites
- Uses [Docker](https://www.docker.com/products/docker) to deploy the application.
- Install [Docker](https://docs.docker.com/engine/installation)


## Installation from Windows
- Run powershell on the project directory
- With powershell open run this command "poweshell -ExecutionPolicy ByPass"
- After setting the execution policy run "./build-powershell.ps1 install"
- This will build the docker image and run the containers

## Installation Linux or MacOS
- Run the installation script "bash ./build.sh install"
- This will build the docker image and run the containers

## After Installation
- Go to localhost:9999 to view the application.

## Additional Notes
- Project built with Silex and MongoDB.
- The delete methods have been oversimplified and without confirmation just as an example.
- Validates input data with respect/validation library.

## Uninstall
- Windows: run "./build-powershell.ps1 destroy"
- UNIX based: run "./build.sh destroy"
