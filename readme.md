# timetracker

A web application of a time tracker. Project is written in PHP using a web
framework Laravel.

## Requirements on your local machine

* PHP 7
* Composer
* Vagrant

## Set up

1. Run `composer install` to install PHP dependencies. This is required to run
   the Homestead VM.
1. Copy `.env.example` into `.env`, those will be the environment variables
   used for development.
1. Copy `Homestead.yaml.example` into `Homestead.yaml` and tweak the path to
   the project, that will be used by the virtual machine project.
1. Run `vagrant up`.
1. Run `vagrant ssh`.
1. Go to `cd code`.
1. `php artisan key:generate` in order to generate the secret key.

Your project should be now accessible at http://localhost:8000/ on your local
machine.

## Compile static assets

1. `vagrant ssh` to connect to the virtual machine.
2. `cd code` to go to the project directory.
3. `yarn install` to install the NPM packages that this project requires.
4. `yarn dev` to start the compilation.
