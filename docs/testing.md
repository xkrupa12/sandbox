### SPECS
PHPSpec is used in a more behavior way when we're describing on how the tested class should behave
- `phpspec describe <<class>>` - creates a spec file for class
- `phpspec run [spec]` - runs tests

In a spec file all methods beginning with `it`/`its` are considered tests
- `it_is_initializable` - we're stating the class itself - `$this->shouldHaveType(My::class)`
- all method arguments are automatically resolved as prophecy mocks (and acts as so, don't even need to call `reveal()` on them)
- `$this` in a test method refers to tested class
- method calls on a tested class are resolved dynamically, ie. calling `$this->shouldHaveCount()` automatically assumes there's a method `MyClass::hasCount()` (WTF???) 
- exceptions:
    - `$this->shouldThrow(ExpectedException::class)->duringMyMethodName($arg)` or
    - `$this->shouldThrow(ExpectedException::class)->during('myMethodName', $arg)`
- tested class initialization (phpunit's `setUp()`)
    - `setUp()` ~ `let` && `tearDown` ~ `letgo`
    - in `let` call `$this->beConstructedWith($args)` & `$this->shouldBeInstanceOf(My::class)` (equals to `shouldHaveType()`)
    
### Advanced mail testing
-> Check https://laracasts.com/series/phpunit-testing-in-laravel/episodes/12
When Swift email is being sent, before the sending itself there is invoked method `beforeSendPerformed`. This method can be leveraged to intercept the message and perform asserts on it.
To do so, we need to create custom testing plugin (see `Tests\SwiftMailTracking` - anonymous class defined there) that implements this method. In there we register this plugin to `Mailer` (via `Mail::getSwiftMailer()->registerPlugin($plugin)`), so we'll enable our event listener.
After this is set up, we can send email via Swift mailer, intercept the message and process any assertions on top of it. 
Since this mail interception is wrapped in trait and we need to set up this stuff before each test case, we can use `@before` annotation in `setUpMailTracking()` method to ensure it is properly set up.

Caveats: 
- `addEmail()` method is not part of `TestCase` class but in the trait itself - phpstorm will report a warning in there 

### Exception Handling
Laravel handles some exceptions himself, ie. if route is missing it throws 404, etc. If it is not desirable in testing, you can use helpers like `$this->withExceptionHandling()` or `$this->handleValidationExceptions()`, etc.
@TODO - learn more!

### Vue Testing
- vue-test-utils - vue testing framework
- mocha + mocha-webpack - testing library
- expect - assertion library 
- jsdom, jsdom-global

### Vue Testing using Mocha + Webpack + vue-test-utils
- wrapper - object wrapping tested object on which we're trying to do some stuff

```js
let configuration object = {
    propsData: { << object properties >> },
    // ...
}

let wrapper = mount(TestedObject [, configuration object ]);
wrapper.setProps({ propsObject }); // alternative props setting

wrapper.vm.$nextTick(() => {
    // assertions depending on vue processing change after clock ticks (refresh in time)
});
// this can be bypassed by using async callback
it ('tests something definitely useful', async () => {
    // do something
    await wrapper.vm.$nextTick();
    // assertions depending on refresh of a object
})

wrapper.emitted().<<event identifier>> // test that event was emitted
wrapper.find(<<selector>>) // selects DOM object by given selector
wrapper.html()  // gets HTML of wrapped object -> might be concatenated with find
wrapper.element // HTML of whole wrapper?
wrapper.contains(<<selector>>) // returns true/false
wrapper.find('.some-element').hasStyle('display', 'none') // checks style, returns bool
```

- expect - library for assertions

expect(wrapper.<<do something>>).<<assertion>>
expect(wrapper.contains('.some-object')).toBe(true);

- moxios - library for testing axios calls -> requires setup in 
beforeEach() and afterEach()
- sinon js - library for testing JS - underlying library agnostic - for various use-cases, whether testing AJAX calls or clock or something else