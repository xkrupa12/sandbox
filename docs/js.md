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


#### [back](./../readme.md)