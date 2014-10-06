<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Cbix\Chain;
use Cbix\ChainException;

$chain = Chain::make('key', 'secret', false);

/*
 * Get Bitcoin Transaction
 * Returns details about a Bitcoin transaction, including inputs and outputs
 */

try {
    $result = $chain->get_transaction('0f40015ddbb8a05e26bbacfb70b6074daa1990b813ba9bc70b7ac5b0b6ee2c45');
    // returns a Bitcoin Transaction Object (https://chain.com/docs#object-bitcoin-transaction)
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Get Bitcoin Transaction OP_Return
 * Returns the OP_RETURN value and associated addresses for any transaction containing an OP_RETURN script
 */

try {
    $result = $chain->get_transaction_op_return('4a7d62a4a5cc912605c46c6a6ef6c4af451255a453e6cbf2b1022766c331f803');
    // returns an OP_RETURN object
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Send Bitcoin Transaction
 * Accepts a signed transaction in hex format and sends it to the Bitcoin network
 * You will need to create the signed transaction before sending to Chain using the bitcoin-lib-php library (https://github.com/Bit-Wasp/bitcoin-lib-php)
 */

try {
    $result = $chain->send_transaction('f468a7..');
    // returns the newly created transaction hash
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}