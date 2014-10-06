<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Cbix\Chain;
use Cbix\ChainException;

$chain = Chain::make('key', 'secret', false);

/*
 * Get Bitcoin Address
 * Returns basic balance details for one or more Bitcoin addresses
 */

try {
    $result = $chain->get_address('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');
    // returns a Bitcoin Address Object (https://chain.com/docs#object-bitcoin-address)
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Get Multiple Bitcoin Address
 * maximum 200 per request limit by Chain API
 */

try {
    $result = $chain->get_address(
        [
            '17x23dNjXJLzGMev6R63uyRhMWP1VHawKc',
            '1EX1E9n3bPA1zGKDV5iHY2MnM7n5tDfnfH'
        ]
    );

    // returns an array of Bitcoin Address Objects (https://chain.com/docs#object-bitcoin-address)
    foreach ($result as $r) {
        var_dump($r);
    }
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Get Bitcoin Address Transactions
 * Returns a set of transactions for one or more Bitcoin addresses.
 * optional limit parameter, defaults to 50, max = 500
 */

try {
    $result = $chain->get_address_transactions('1K4nPxBMy6sv7jssTvDLJWk1ADHBZEoUVb', ['limit' => 10]);
    // returns an array of Transaction Objects (https://chain.com/docs#object-bitcoin-transaction)
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Bitcoin Address Unspent Outputs
 * Returns a collection of unspent outputs for a Bitcoin address. These outputs can be used as inputs for a new transaction
 */

try {
    $result = $chain->get_address_unspents('1K4nPxBMy6sv7jssTvDLJWk1ADHBZEoUVb');
    // returns an Output Object
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Bitcoin Address OP_RETURNs
 * Returns any OP_RETURN values sent and received by a Bitcoin Address.
 */

try {
    $result = $chain->get_address_op_returns('1K4nPxBMy6sv7jssTvDLJWk1ADHBZEoUVb');
    // returns an array of OP_RETURN Objects.
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}