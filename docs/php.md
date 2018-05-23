### Continuous Integration
To set up CI for project, it's possible to use Travis CI (free for OSS)

Signing up:
1. Go to [travis-ci.org](https://travis-ci.org)
2. Sign up via GH account
3. Enable CI for a repository

Configuration:
CI configuration is stored in `.travis.yml` file, that contains language settings as well as commands that needs to be run when changes are pushed to repository
For CI there is also .env.travis containing special ENV settings for CI build

### Helper files in Laravel
1. `composer.json` - register file for autoloading 
```json
"autoload": {
    "files": [
        "path/to/file.php"
    ]
}
```
2. create the file
3. implement helper functions
4. run `composer dump-autoload` 

### Slugs in routes
To enable slugs in routing, you need to override `getRouteKeName()` method on a model to set column that holds slug and by which the model will be autoloaded when resolving routing method dependencies.

### Form input helper

- `old('input')` - contains previously submitted value so the form can be repopulated 

### Views composition
- done in `AppServiceProvider::boot()` (or any custom service provider)
- enables to pass extra data to the view every time it's rendered or to share it with multiple (* - all) views
```
View::composer(['view.name', ...], function ($view) {
    $view->with('extra', $data);
})

// when sharing data in all views, then is equal to
View::share('extra', $data);
```

### Query Objects
Class containing query, especially if it's rather complicated one

### Getting values from Request object
- `all()` - returns all inputs in request
- `only($array)` - for each item in `$array` returns it's value or null if not present 
- `intersect($array)` - returns values for items in `$array` but omits those not present

#### [back](./../readme.md)