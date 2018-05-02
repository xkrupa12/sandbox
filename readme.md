# Sandbox [![Build Status](https://travis-ci.org/xkrupa12/sandbox.svg?branch=master)](https://travis-ci.org/xkrupa12/sandbox) [![StyleCI](https://styleci.io/repos/125975041/shield?branch=master)](https://styleci.io/repos/125975041)

## [PHP](docs/php.md)
- Continuous Integration

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
