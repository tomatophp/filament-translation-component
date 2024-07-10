![Screenshot of Login](https://raw.githubusercontent.com/tomatophp/filament-translation-component/master/arts/3x1io-tomato-translation-component.jpg)

# Filament Translation Component

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-translation-component/version.svg)](https://packagist.org/packages/tomatophp/filament-translation-component)
[![PHP Version Require](http://poser.pugx.org/tomatophp/filament-translation-component/require/php)](https://packagist.org/packages/tomatophp/filament-translation-component)
[![License](https://poser.pugx.org/tomatophp/filament-translation-component/license.svg)](https://packagist.org/packages/tomatophp/filament-translation-component)
[![Downloads](https://poser.pugx.org/tomatophp/filament-translation-component/d/total.svg)](https://packagist.org/packages/tomatophp/filament-translation-component)

Translation Component as a key/value to use it with Spatie Translatable FilamentPHP Plugin

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
    ->languages(['en', 'ar'])
```

if you not set `->languages()` it will take the lang on the config file.

## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="filament-translation-component-config"
```

you can publish languages file by use this command

```bash
php artisan vendor:publish --tag="filament-translation-component-lang"
```

## Support

you can join our discord server to get support [TomatoPHP](https://discord.gg/Xqmt35Uh)

## Docs

you can check docs of this package on [Docs](https://docs.tomatophp.com/plugins/laravel-package-generator)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Tomatophp](mailto:info@3x1.io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
