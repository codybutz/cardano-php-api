# cardano-php-api
An open-source project to allow users to connect to the Cardano API using PHP. There will be two APIs included in this Wrapper:
- Explorer Wrapper - Wrapper for the [Cardano Explorer API](https://cardanodocs.com/technical/explorer/api/).
- (Upcoming) Cardano-SL Wallet API Wrapper - Wrapper for the [Cardano SL Wallet Backend](https://cardanodocs.com/technical/wallet-backend/).

## Installation

Install with composer:

```bash
composer require codybutz/cardano-php-api
```

## Usage

This package contains two components: Explorer Wrapper and Cardano-SL Wallet API Wrapper.

### Using the Explorer API

```php
<?php
$explorer = new \Butz\Cardano\Explorer\ExplorerAPI();

$address = $explorer->getAddressSummary('DdzFF...'); // Returns an AddressSummary object.
```

### Using the Wrapper API

TODO

## Run tests

Invoke the test runner as follows:

    phpunit

## License

This code is licensed under the MIT License

## Submitting bugs and feature requests

If any problems are found please email me at codyjbutz@gmail.com or submit an issue to this repository.

## Donations

Any donations are very much appreciated :) 

ADA Address: `DdzFFzCqrhstC3R3qTJFzvcGYJqxiTGCY4WVZ2fU2Gw9kva2aUYrz83QcTmKDGfK4YceUiip1eP75NwUDyP17jofpHrNbo3WB84NcN5W`