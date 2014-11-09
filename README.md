uuid [![Build Status](https://travis-ci.org/atphp/uuid.svg?branch=v0.1)](https://travis-ci.org/atphp/uuid) [![License](https://poser.pugx.org/atphp/uuid/license.png)](https://packagist.org/packages/atphp/uuid)
====

PHP UUID generator wrapper, requires PHP >= 5.4, copied from Drupal 8 code.

### Usage

```php
<?php

// Use inside your function
$uuid = AndyTruong\Uuid\Uuid::getGenerator()->generate();

// Use inside your library
class MyClass {
  public function myMethod(\AndyTruong\Uuid\UuidInterface $uuid_maker) {
    $uuid = $uuid_maker->generate();
  }
}
```
