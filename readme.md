## Requirements

* PHP 7
* Composer
* Vagrant

## Set up

1. Run `composer install`.
1. Copy `.env.example` into `.env`.
1. Copy `Homestead.yaml.example` into `Homestead.yaml` and tweak the path to
   the project.
1. Run `vagrant up`.
1. Run `vagrant ssh`.
1. Go to `cd code`.
1. `php artisan key:generate` in order to generate the secret key.
