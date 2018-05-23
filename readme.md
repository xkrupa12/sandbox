# Sandbox [![Build Status](https://travis-ci.org/xkrupa12/sandbox.svg?branch=master)](https://travis-ci.org/xkrupa12/sandbox) [![StyleCI](https://styleci.io/repos/125975041/shield?branch=master)](https://styleci.io/repos/125975041)

## [PHP](docs/php.md)
- Continuous Integration
- Helper files in Laravel

## [JS](docs/js.md)
- Custom classes & Laravel-mix
- Vue - $nextTick

## [CSS](docs/css.md)
- Browser sync
- Versioning
- WebDesign steps

## [GIT](docs/git.md)
- Partial commits
- Issue Resolution
- Licensing

## [Testing](docs/testing.md)

## HTTP
### POST vs PATCH vs PUT

## Architecture
### DDD
- Domain - sets up context, it's a whole world where all it's parts are related to it (ie. `account` has completely different meaning in banking and IS domains - one is for bank account, the other for user authentication)
- Entity - has it's identity that won't change when we change/alter entity - ie. person has identity whether it changes it's look (like getting a haircut, tattoo or whatever)
- Value Object 
    - object without identity - 5$ bill - we don't care whether the bill is this concrete bill of a certain serial number, we care about it's value instead
    - should be immutable, thus side-effect free
- Aggregate 
    - group of objects that live and die together; they make sense only together
    - accessing inner objects is done via main object -> `Aggregate is an encapsulated single unit`
    - ie. e-shop cart - Cart (aggregate root) + Items (can't live outside cart) + Price (item must have a price) + Product identifier (item is representation of product in a cart, so it has to contain it's identifier)
        - Item doesn't need whole product, it just needs to know what product it represents, but not all the details of product!

## Testing

### Authenticated user
Laravel has method to fake authenticated user:
```php
$this->be($user)

// or it's alias 
$this->actingAs($user)
```

For the simplicity, mocking of authenticated user can be extracted into separate class just for simplicity, check `tests/TestCase::signIn()` 

### Model Factories

```php
factory(Model::class)->create() // creates and persists model in DB
factory(Model::class)->make() // creates model without persisting it
factory(Model::class)->raw() // returns array of attributes of model (not actual instance)
```

### Seeding
Instead of writing complicated foreaches and stuff, Factory can be utilized quite easily - when model factory is set up properly (with creating of related models as well), seeding can be done with one easy command, ie. `factory(MyClass::class, 50)->create()` to create 50 records & all the related models with it

### Exception handling
In previous versions of Laravel (5.4 and older), there was a problem with exception handling when running tests. I'm not sure if it was resolved in newer versions of FW, so there's a workaround by @AdamWathan to enable/disable exception handling when necessary 

## Vue

### Tips & tricks & best practices
- import & register components in a parents that uses them, not all in bootstrap `app.js`
- use computed properties instead of methods where possible - computed property is cached and recalculated only when it's dependency is changed
- to inject values in blade templates - use `@json($var)` directive & wrap in single quotes to avoid collisions with quotes used in JSON string (`<component :attribute='@json($attr_value)' >`)
- there's convention for component names to consist of 2+ words 
- utilize/leverage ES6 methods (`map()`, `slice()`, etc.)
- make components as atomic as possible (similarly to OOP)
- when a library is used all over the place, register it globally - in bootstraping script, call `window.identifier = require('library)`, ie. Moment, Axios