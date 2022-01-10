# Task

## Notes

Due to limited time I had (work and other projects):
* Task has no in-depth validation, such as, limiting tracking start to be outside of any existing tracked time intervals.
* Views are primitive
* Notifications are non-existent: deleting someone else's tracking won't say "you can't do that", it just won't delete
* No DDD
* No TDD
* Optional tasks not done

## Setup

### Start containers and APP SERVER on a separate terminal

```./vendor/bin/sail up```

### IN a new TERMINAL, Enter php container

```docker-compose exec laravel.test bash -l```

### Inside, Switch to limited user

```su sail```


### Inside install Deps, do Migrations, Npm-dev

```
composer install;
./artisan migrate;
npm i;
npm run dev;
```

ACCESS AT `http://localhost`
