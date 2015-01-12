# fuel-requester
Request wrapper as FuelPHP Package.
This package doesn't throw `\RequestStatusException`, return `\Response`.

## Usage

```php
$res = (new \Requester\Requester)->get('/');
```

You must create config file at app/config/requester.php if you want to omit `endpoint`.

```php
$res = (new \Requester\Requester('http://example.com/wp-json'))->get('/posts/1');
```