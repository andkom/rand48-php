# rand48.js

A rand48 random number generator implementation in pure PHP.

It's a default random number generator in Java. Also it was used in old versions of Firefox and other browsers. 

Not cryptographically strong!

## Install

```bash
composer require andkom/rand48
```

## Use

```php
$rng = new \AndKom\Rand48\Rand48();
echo $rng->random();
```