# Sandbox [![Build Status](https://travis-ci.org/xkrupa12/sandbox.svg?branch=master)](https://travis-ci.org/xkrupa12/sandbox) [![StyleCI](https://styleci.io/repos/125975041/shield?branch=master)](https://styleci.io/repos/125975041)

## Undecided
- just trying smthing

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

## [Vue.js](docs/vue.md)

## [Testing](docs/testing.md)

## Laravel
###
- model's `boot()` method allows to inject process of creating/updating/deleting and alter/deny/enhance it, ie. generate UUID for model rather then incremental ID or store auditing info in the process

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

### Forms
- when listening for event on the whole form (ie. keydown on every input), we can use `$event` to reach the component that triggered the event - ie. name attribute of component would be - `$event.target.name`
- server side validation can be easily handled on front - laravel generates 422 error automatically when the validation fails and returns all the necessary data (field and corresponding error message) - `.catch(error => error.response.data)`


## Tools

### RegExps
- when using parenthesis in regexp, results are stored in vars ($1 - $n) and are accessible through them
- capturing group - defined by parenthesis - matching patterns are stored to variables
    - `@\w+` - matches anything starting with `@`
    - `(@\w+)` - same match, but results are present in variable, ie. `$1`
- when we don't want to include pattern in parenthesis (capturing group) into a result, we can use `?:` - `(?:<<pattern>>)`
    - ie. `idiot(?:ic)?` will work for both `idiot` and `idiotic`, but `ic` won't be considered as another match
- regexp constitution 
    - `/` - delimiter, marks start and end of a pattern - `/<<pattern>>/`
    - flags - put after closing slash (`/`) - g = global, i = ignore case, m = multiline
    - character sets:
        - `[abc]` - set of characters we're looking, in this example we're looking for a, b or c
        - `[^abc]` - `^` means negation, so we're looking for anything but a, b and c
        - `[a-z]` - we can use range in character sets, ie. `a-zA-Z0-9` means any alphanumeric character 
        - `[abc]<<quantifier>>` - quantifier specifies how many occurrences we're looking for in pattern
            - `+` - at least one
            - `?` - max one
            - `*` - zero or more
            - `{5}` - exactly 5
            - `{3,5}` - 3 to 5
- special codes:
    - `\w` - alphanumeric (word) character
    - `\s` - whitespace character (space, tab, line break)
    - `\b` - interpunction?
    - `\t` - tabs
- Lookahead - check set of characters behind the pattern we're looking (`my-pattern(<<lookahead pattern>>)`)
    - Positive - match the pattern if following set of chars matches given pattern
        - `(?=<<pattern>>)`, ie. `<a href="google.com">google</a>` -> `google` can be filtered out as `/google(?=</a>)/`
    - Negative - opposite of positive lookahead, matches the pattern if condition is falsey
        - `(?!<<pattern>>)`, ie. `<a href="google.com">google</a>` -> `/google(?!</a>)` selects google from `href` attribute
- Lookbehind - checks characters before the pattern (`(<<lookbehind pattern>>)my-pattern`)
    - Positive - `(?<=<<pattern>>)my-pattern`, ie. `$var` -> `(?<=\$)var` finds `var`
    - Negative - `(?<!<<pattern>>)my-pattern`
- PHP functions:
    - `(int) preg_match($pattern, $string, [ $result ])` - find first matching pattern in string
    - `(int) preg_match_all($pattern, $string, [ $results ])` - find all the matches in string (and store into $results)
    - `preg_replace($pattern, $replacement, $string)` - replaces all the matches in the string by replacement   
    - `preg_split($pattern, $string)` - split string into array (like `explode()`)
    - `preg_grep($oattern, array $input, $flags = 0)` - return array entries matching the pattern
    