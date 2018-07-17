# Vue

## Vuex
`yarn vuex`
- instantiated via `Vuex.Store({ << config object >>})`
Config object contains state, getters, actions, mutations, 

### State
Alternative to `data` property of Vue class or component. Contains global data.

### Getters
Basically a globally accessible computed properties accessible as `store.getters.resources`. Defined similarly as mutations, first argument is state, second is object of all available getters:

```js
getters: {
    resourcesCount(state, getters, rootState, rootGetters) {
        return state.resources.length
    }
}
```

### Actions
Actions are methods accessible globally, usefull ie. for AJAX calls that might be used on multiple places. Actions should never alter state.
Actions are called as `store.dispatch('actionName', payload)` and have signature as:

```js
actions: {
    fetchResources(context, payload) {
        let data = {}; // ie. do some AJAX call
        context.commit('setResources', data);
    }
}
```

### Mutations
Mutations are similar to events on a global level. They should be as small as possible and used only to update/alter global state.
To call the mutation, use `store.commit('mutationName', payload)`. In store definition, mutation takes as a first argument state and second is payload:

```js
mutations: {
    setResources(state, resources) { 
        state.resources  = resources; 
    }
}
```
- mutations -> similar to events - change the global state

### Accessing store
Instead of importing store in every component using it, we can inject it in root Vue instance and it's automatically accessible by all child components.
We just need to import file containing store setup and register it in Vue instance:

```js
import store from '@/path/to/vuex/configuration'

new Vue({
    store: store,
    // other settings
})
```
After this, store is available under `this.$store`

### Modules
Since Vuex store would become too big in a time, it's possible to decouple getters, actions, mutations and state into separate modules. To do so, we just need to create new JS file exporting class, that contains the actions, mutations, ... objects. After that, in main file we need to import this module file and register it in Vuex.Store as follows:

```js
import myModule from './modules/myModule'

export default new Vuex.Store({
    modules: {
        myModule
    }
    // other stuff
})
```
Modules can (and should) be namespaced to avoid any naming collisions. To do so, just set  namespaced: true in module class. This will automatically add prefix with module name on all the objects in the module class. When calling ie. action from different namespace, you should call it using brackets rather than dot notation (['module/action']() instead of .module/action())