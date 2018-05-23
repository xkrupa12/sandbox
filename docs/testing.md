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