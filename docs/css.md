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

#### [back](./../readme.md)