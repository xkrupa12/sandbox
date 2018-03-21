# Sandbox

## JS

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


## CSS

### Browser sync
After change detected by NPM browser is automatically refreshed as well
1. in `webpack.mix.js` define `mix.browserSync('app.address')`
2. `npm run watch`


### Versioning
Versioning enables caching of assets in browser for as long as possible. Compiling assets creates also `public/mix-manifest.json` that contains name of the asset file with it's hash. Every change made in asset file will cause new hash to be generated, thus browser will know to get the latest version from server.
To enable versioning, just set `mix.version()` in `webpack.mix.js`
Then, to include asset in view, use `{{ mix('path/to/asset') }}` to generate correct link to asset