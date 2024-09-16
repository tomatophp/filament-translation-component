![Cover](https://raw.githubusercontent.com/tomatophp/filament-translation-component/master/arts/3x1io-tomato-translation-component.jpg)

# Filament Translation Component

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-translation-component/version.svg)](https://packagist.org/packages/tomatophp/filament-translation-component)
[![PHP Version Require](http://poser.pugx.org/tomatophp/filament-translation-component/require/php)](https://packagist.org/packages/tomatophp/filament-translation-component)
[![License](https://poser.pugx.org/tomatophp/filament-translation-component/license.svg)](https://packagist.org/packages/tomatophp/filament-translation-component)
[![Downloads](https://poser.pugx.org/tomatophp/filament-translation-component/d/total.svg)](https://packagist.org/packages/tomatophp/filament-translation-component)

Translation Component as a key/value to use it with Spatie Translatable FilamentPHP Plugin

## Screenshots

![Light](https://raw.githubusercontent.com/tomatophp/filament-translation-component/master/arts/light.png)
![Dark](https://raw.githubusercontent.com/tomatophp/filament-translation-component/master/arts/dark.png)


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

## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="filament-translation-component-config"
```

you can publish languages file by use this command

```bash
php artisan vendor:publish --tag="filament-translation-component-lang"
```

## Other Filament Packages

Checkout our [Awesome TomatoPHP](https://github.com/tomatophp/awesome)

