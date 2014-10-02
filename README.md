ChainPHP
========

This library provides a simple PHP interface to the [Chain Bitcoin API](https://chain.com/)

All methods are available including creating webhooks and events. You will need to sign up to Chain for free to obtain your key and secret needed below. It is recommended you store these outside of the web root.

### Retrieving an address balance
    $chain = new Chain($key, $secret, false);
    $result = $chain->get_address('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');
    echo $result->balance;

### Get the latest block height
    $chain = new Chain($key, $secret);
    $result = $chain->get_latest_block();
    echo $result->block_height

##Methods


### Exceptions

If there are any issues during the API request a ChainException will be thrown which can be caught
and managed according to your application needs.

### Unit Tests

This library uses PHPUnit for unit testing. In order to run the unit tests, you'll first need
to install the dependencies of the project using Composer: `php composer.phar install --dev`.
You can then run the tests using `vendor/bin/phpunit`. The library comes with a set of mocked responses
from the Chain API