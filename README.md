# Shopify Webhooks

[![Latest Version on Packagist](https://img.shields.io/packagist/v/amsoell/shopify-webhooks.svg?style=flat-square)](https://packagist.org/packages/amsoell/shopify-webhooks)
[![Total Downloads](https://img.shields.io/packagist/dt/amsoell/shopify-webhooks.svg?style=flat-square)](https://packagist.org/packages/amsoell/shopify-webhooks)
![GitHub Actions](https://github.com/amsoell/shopify-webhooks/actions/workflows/main.yml/badge.svg)

Middleware to [validate incoming Shopify webhooks](https://shopify.dev/docs/apps/webhooks/configuration/https) and optionally log them.

## Installation

```bash
composer require amsoell/shopify-webhooks
```

## Usage

[Register the Amsoell\ShopifyWebhooks\Middleware\ValidateShopifyWebhooks middleware](https://laravel.com/docs/middleware#registering-middleware) to the routes that handle incoming Shopify Webhooks.

To log all validated webhooks, update the config file at `config/shopify-webhooks.php` to specify the logging driver and level.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ams@amsoell.com instead of using the issue tracker.

## Credits

-   [Andy Soell](https://github.com/amsoell)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
