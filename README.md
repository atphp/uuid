uuid [![Build Status](https://travis-ci.org/andytruong/uuid.svg?branch=v0.1)](https://travis-ci.org/andytruong/uuid) [![License](https://poser.pugx.org/andytruong/uuid/license.png)](https://packagist.org/packages/andytruong/uuid)
====

PHP UUID generator wrapper, copied from Drupal 8 code.

### Usage

```php
<?php

// Use inside your function
$uuid_maker = AndyTruong\Uuid\Uuid::getGenerator();
$uuid = $uid_maker->generate();

// Use inside your library
class MyClass {
  public function myMethod(\AndyTruong\Uuid\UuidInterface $uuid_maker) {
    $uuid = $uuid_maker->generate();
  }
}
```
