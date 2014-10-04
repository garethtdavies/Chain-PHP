ChainPHP
========

This library provides a simple PHP interface to the [Chain Bitcoin API](https://chain.com/).

All methods are supported including creating webhooks and events. You will need to [sign up to Chain](https://chain.com/) for a free API Key and Secret as they are needed to authenticate requests.

### Installing via Composer

The recommended way to install the library is through [Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Add Chain-PHP as a dependency
php composer.phar require cbix/chain-php:dev-master
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

### Setup

You will need to provide your API Key ID and API Key Secret as provided by Chain to authenticate your requests. There is an optional third parameter, which if set to true will use the Bitcoin Testnet3 block chain.
It defaults to using the Bitcoin Mainnet if not specified or set to false.

    $chain = new Chain($key, $secret, false);

### Address

Address methods return a [Bitcoin Address Object](https://chain.com/docs#bitcoin-address-transactions). Where the API accepts multiple addresses you should provide an array of addresses.

    $single_address = $chain->get_address('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');
    $multiple_addresses = $chain->get_address(['17x23dNjXJLzGMev6R63uyRhMWP1VHawKc', '1EX1E9n3bPA1zGKDV5iHY2MnM7n5tDfnfH']);
    $transactions = $chain->get_transactions('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');
    $unspents = $chain->get_address_unspents('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');
    $op_returns = $chain->get_address_op_returns('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');

### Transaction

Transactions methods return a [Bitcoin Transaction Object](https://chain.com/docs#bitcoin-address-transactions).
You can send a transaction to the blockchain but you will need to determine the appropriate hex representation of the signed transaction.
In order to achieve this please consider using the [bitcoin-lib-php library](https://github.com/Bit-Wasp/bitcoin-lib-php).

    $transaction = $chain->get_transaction('0f40015ddbb8a05e26bbacfb70b6074daa1990b813ba9bc70b7ac5b0b6ee2c45');
    $op_return = $chain->get_transaction_op_return('0f40015ddbb8a05e26bbacfb70b6074daa1990b813ba9bc70b7ac5b0b6ee2c45');
    $send = $chain->send_transaction('0100000001ec...');

### Block

Block methods return a [Bitcoin Block Object](https://github.com/Bit-Wasp/bitcoin-lib-php). The get_block and get_block_op_returns will
accept either a block hash or block height as an input.

    $block = $chain->get_block('00000000000000009cc33fe219537756a68ee5433d593034b6dc200b34aa35fa');
    $latest_block = $chain->get_latest_block();
    $block_op_returns = $chain->get_block_op_returns('00000000000000009cc33fe219537756a68ee5433d593034b6dc200b34aa35fa');

### Webhooks

Webhook methods will return a [Webhook URL Object](https://chain.com/docs#object-webhooks). When creating webhooks the id attribute may be specified or if not provided
will be generated by the Chain API.

    $create_webhook = $chain->create_webhook('https://username:password@your-server-url.com', 'FFA21991-5669-4728-8C83-74DEC4C93A4A');
    $list_webhooks = $chain->list_webhooks();
    $update_webhook = $chain->update_webhook('FFA21991-5669-4728-8C83-74DEC4C93A4A');
    $delete_webhook = $chain->delete_webhook('FFA21991-5669-4728-8C83-74DEC4C93A4A');

    $options = [
        'event' => 'address-transaction',
        'block_chain' => 'bitcoin',
        'address' => '1...',
        'confirmations' => 1
    ];
    $create_webhook_event = $chain->create_webhook_event('FFA21991-5669-4728-8C83-74DEC4C93A4A', $options);

    $list_webhook_events = $chain->list_webhook_events('FFA21991-5669-4728-8C83-74DEC4C93A4A');
    $delete_webhook_event = $chain->delete_webhook_event('FFA21991-5669-4728-8C83-74DEC4C93A4A');

### Exceptions

If there are any issues during the API request a ChainException will be thrown which can be caught
and managed according to your application needs.

    try {
        $latest_block = $chain->get_latest_block();
        echo $latest_block->block_id;
    } catch (ChainException $e) {
        //There was an error more information in $e->getMessage();
        var_dump($e->getMessage);
    }

### Unit Tests

This library uses PHPUnit for unit testing. In order to run the unit tests, you'll first need
to install the dependencies of the project using Composer: `php composer.phar install --dev`.
You can then run the tests using `vendor/bin/phpunit`.