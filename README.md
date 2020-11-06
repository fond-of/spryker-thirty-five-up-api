# Thirty Five Up API
[![Build Status](https://travis-ci.org/fond-of/spryker-thirty-five-up-api.svg?branch=master)](https://travis-ci.org/fond-of/spryker-thirty-five-up-api)
[![PHP from Travis config](https://img.shields.io/travis/php-v/fond-of/spryker-thirty-five-up-api.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/fond-of/spryker-thirty-five-up-api.svg)](https://packagist.org/packages/fond-of-spryker/thirty-five-up-api)

## What it does

Provides API endpoints for getting and patching ThirtyFiveUp orders

## Installation

```
composer require fond-of-spryker/thirty-five-up-api
```

Register plugins in `src/Pyz/Zed/Api/ApiDependencyProvider.php`

```
    protected function getApiResourcePluginCollection(): array
    {
        return [
            ...
            new ThirtyFiveUpApiResourcePlugin(),
        ];
    }
```

```
    protected function getApiValidatorPluginCollection(): array
    {
        return [
            ...
            new ThirtyFiveUpApiValidatorPlugin(),
        ];
    }
```
