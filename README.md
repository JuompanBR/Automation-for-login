## Common commands in codeception
This document list a set of common commands used in codeception.

### Create a new suite
```shell
php vendor/bin/codecept generate:suite api
```
### Create a new test
```
php vendor/bin/codecept generate:cest api CreateUser
```
### Running your codeception test
```
php vendor/bin/codecept run [suite_name];
```
### Installing a composer package globally
```
composer global require alice/yamldump=dev-master
```



