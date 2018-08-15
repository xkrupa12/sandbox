### Custom classes & Laravel-mix
1. define new class in `resources/assets/js/`
```javascript
export default class {
    constructor(args) {
        this.args = args
    }
    
    myMethod() {
        // do something
    }
}
```
2. import class into app.js or other entrypoint 
```javascript
import MyClass from './path/to/class/definition';
``` 
3. set up compilation of file in `webpack.mix.js`
```javascript
mix.js('resource/assets/js/entrypoint-file', 'public/js')
```
4. run `npm run << dev/watch/prod >>` to compile the actual JS
5. include file in view
```html
<script src="public/js/my-compiled-js"></script>
```

### Class extending
- in vue or js file, we can call `export default ParentClass.extend({ // put your stuff here })`

### Global import of class
If class is used widely across multiple files, we can set it global as `window.MyClass = MyClass` and use it everywhere else (`myClass = new MyClass`)

### Event object
- when event is triggered (ie. typing into text input), data are accessible via `$event` object - ie. `$event.target.value` 

### Vue - $nextTick
If there is a property that's being watched, `$nextTick` ensures applying any changes correctly (probably some race condition problem, should find some more info on a topic and see, what it's about).  

### Tips & tricks
- `v-model="property"` is equal to `:value="property" @input="property = $event.target.value`
    -> `v-model` is syntactic sugar, we can leverage it's equivalent for custom inputs where we use custom method for validation and updating root vue instance (can't override property locally! use event instead!)   
- ES15 parameter destructuring:
    - instead of `axios.get().then(response => this.data = response.data)` you can use `.then(({ data }) => this.data = data)` 
- `$hidden` model property contains list of properties that should not be contained in JSON serialization of model (handy when getting data through AJAX for frontend) -> this works globally tho!
    - for limiting on a particular use cases, define specific relationship in model and limit loaded stuff via `select()` -> list has to contain `id` for relationships to work
- moment - diff for humans -> `moment.create(someTimeStamp).fromNow()`;
- AJAX calls can be wrapped into separate JS classes in case they are used on multiple places:
```js
class Status {
    static all(then) {
        return axios.get('/statuses').then(({data}) => then(data));
    }
}

export default Status;
```
- you can import CSS in vue templates as well - those will be automatically included in compiled files
- wrap usage of external libs in  custom component to unify & simplify usage
- when using `data-` attributes in element, those are accessible via `dataset` property in vue, ie. `data-tooltip` can be taken by `$this.dataset.tooltip`


### Testing
- Ava
    - requires babel preset so it can import & process stuff
    - requires setting in `package.json`: `"ava": { "require": ["babel-register"] }`


# ES6

## Blocks
If you want to restrict access to variable, you can define block using `{}` without need of stuffing it into function. Defining variable in such a block will enable access to variable only inside of that block, no upper levels.

## Strings
### Interpolation
Using template literals "\`" (backtick) -> `console.log(\`(${x}, ${y})\`)`

### Multi-line strings
Template literals are usable to also define multi-line strings 

### New methods
- `str.startsWith('x')` replaces `str.indexOf('x') === 0`
- `str.endsWith('x')`
- `str.includes('x')`
- `'str'.repeat(3)` => 'strstrstr'

## Arrow functions
Simplified functions definition, handy especially for short functions (ie. anonymous), like: `arr.map(x => x * x)`

## Loops
### for vs forEach
`forEach` is ES5 construct, whereas `for-of` is ES6 and allows breaking from loop. `for (const [index, elem] of arr)`  

## Named parameters
ES6 allows easier default arg values definition similar to PHP: `function myFunc(arg = 'defaultValue')`
If argument is supposed to be object, we can define it's default property values as well: `function myFunc({ prop1: 'default' })`
If argument is object, but is optional entirely, we can define it as `function muFunc({ prop1 = 'default' } = {})` 

## Rest arguments
ES6 allows arbitrary number of arguments using `...` notation: `function myFunc(...args) {}` or `function myFunc(firstArg, ...theRest) {}`

## Spread operator (...)
Enables turning array into parameters, ie: `Math.max(...[1, 2, 3, 4])`
This can be used to push array items into another array: `arr1.push(...arr2)`
Or concatenating arrays into new one: `let arr3 = [...arr1, ...arr2]`

## Method definitions
Introduced shortened method definition of object: `let obj = { method() { /* do something */ }, }` instead of `method: function () { /* do something */ } ` 

## Classes
No need to use class prototypes to extend them anymore, class definition contains all the methods it implements right away.
It's also possible to extend one class from another: `class Employee extends Person {}`. To access parent methods use `super` keyword (`super.parentMethod()`)
It's also possible to extend `Error` class and implement sublclasses of `Error`

## Map
New built-in data structure

## Array methods
- `arr.findIndex(closure)` 
- `arr = Array.from(arguments)` - create array from array-like objects
- `arr = new Array(2).fill(undefined)` - create array of arbitrary length (2 in this example) filled with arbitrary value (`undefined`s here)

## ES6 modules
If you want to export some stuff from the script, simply put `export` before it, ie. `export const myConst = 5` or `export function myFunction () {}`. These are *named exports* and can be imported as `import { myConst, myFunction } from './file'`. Alternatively, we can import everything with `import * as file from './file'` and access it as `file.myConst`
In case we're exporting single value from module, we can use `export default` (! exported values are not named, ie. `export default function () {}` !) prefix and import it as `import WhateverNameIWant from './file'`
 
#### [back](./../readme.md)