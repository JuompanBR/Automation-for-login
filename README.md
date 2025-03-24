## Common commands in codeception
This document list a set of common commands used in codeception.

### Create a new suite
```shell
php vendor/bin/codecept generate:suite api
```
### Create a new test
```
php vendor/bin/codecept generate:cest Api Login
```
### Running your codeception test
```
php vendor/bin/codecept run [suite_name] [testfile name with php] --env [name of env];
```
### Installing a composer package globally
```
composer global require alice/yamldump=dev-master
```
### Running on a group defined by the @group [group_name]
```
php vendor/bin/codecept run --group [group_name] --env [env_name]
```



