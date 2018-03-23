# Sandbox [![Build Status](https://travis-ci.org/xkrupa12/sandbox.svg?branch=master)](https://travis-ci.org/xkrupa12/sandbox) [![StyleCI](https://styleci.io/repos/125975041/shield?branch=master)](https://styleci.io/repos/125975041)

## PHP

### Continuous Integration
To set up CI for project, it's possible to use Travis CI (free for OSS)

Signing up:
1. Go to travis-ci.org
2. Sign up via GH account
3. Enable CI for a repository

Configuration:
CI configuration is stored in `.travis.yml` file, that contains language settings as well as commands that needs to be run when changes are pushed to repository
For CI there is also .env.travis containing special ENV settings for CI build

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

### WebDesign steps
1. Choose basic tools - font & font-sizes, colors, icons
2. Components - buttons, inputs, navbars, etc
    - 3 basic steps:
        - Sketching - on a paper or in the painting tool
        - Prototyping - coding component in HTML
        - Applying styles & Finishing
3. Page composition - where to put what

## GIT

### Partial commits
It seems to be a good practice to commit changes grouped together by the logical parts rather than the whole bunch together - smaller commits in a particular order might "tell a story" of what happened

### Issue Resolution
When a commit resolves issue, commit message should contain information about what issue was resolved. Example: `Solved this serious problem - resolves #55`

### Licensing
choosealicense.com
