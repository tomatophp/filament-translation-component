![Cover](https://raw.githubusercontent.com/tomatophp/filament-translation-component/master/arts/3x1io-tomato-translation-component.jpg)

# Filament Translation Component

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-translation-component/version.svg)](https://packagist.org/packages/tomatophp/filament-translation-component)
[![PHP Version Require](http://poser.pugx.org/tomatophp/filament-translation-component/require/php)](https://packagist.org/packages/tomatophp/filament-translation-component)
[![License](https://poser.pugx.org/tomatophp/filament-translation-component/license.svg)](https://packagist.org/packages/tomatophp/filament-translation-component)
[![Downloads](https://poser.pugx.org/tomatophp/filament-translation-component/d/total.svg)](https://packagist.org/packages/tomatophp/filament-translation-component)

Translation Component as a key/value to use it with Spatie Translatable FilamentPHP Plugin

## Screenshots

![Light Textarea](https://raw.githubusercontent.com/tomatophp/filament-translation-component/master/arts/textarea-light.png)
![Dark Textarea](https://raw.githubusercontent.com/tomatophp/filament-translation-component/master/arts/textarea-dark.png)
![Light Input](https://raw.githubusercontent.com/tomatophp/filament-translation-component/master/arts/input-light.png)
![Dark Input](https://raw.githubusercontent.com/tomatophp/filament-translation-component/master/arts/input-dark.png)


## Installation

```bash
composer require tomatophp/filament-translation-component
```

## Using

you can use the component on your form like this

```php
use \TomatoPHP\FilamentTranslationComponent\Components\Translation;

Translation::make('title')
    ->label('Title')
```

you can change the language from the config file.

## Convert input to textarea

```php
use \TomatoPHP\FilamentTranslationComponent\Components\Translation;

Translation::make('title')
    ->label('Title')
    ->textarea()
```



## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="filament-translation-component-config"
```

you can publish languages file by use this command

```bash
php artisan vendor:publish --tag="filament-translation-component-lang"
```


## Testing

if you like to run `PEST` testing just use this command

```bash
composer test
```

## Code Style

if you like to fix the code style just use this command

```bash
composer format
```

## PHPStan

if you like to check the code by `PHPStan` just use this command

```bash
composer analyse
```

## Other Filament Packages

Checkout our [Awesome TomatoPHP](https://github.com/tomatophp/awesome)

