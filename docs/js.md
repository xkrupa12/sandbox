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

### Vue - $nextTick
If there is a property that's being watched, `$nextTick` ensures applying any changes correctly (probably some race condition problem, should find some more info on a topic and see, what it's about).  

#### [back](./../readme.md)