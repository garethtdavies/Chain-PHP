<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Cbix\Chain;
use Cbix\ChainException;

$chain = Chain::make('key', 'secret', false);

/*
 * Get Bitcoin Block
 * Returns details about a Bitcoin block, including all transaction hashes
 */

try {
    $result = $chain->get_block('00000000000000009cc33fe219537756a68ee5433d593034b6dc200b34aa35fa');
    // returns a Bitcoin Block Object (https://chain.com/docs#object-bitcoin-block)
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Get Latest Block
 */

try {
    $result = $chain->get_latest_block();
    // returns a Bitcoin Block Object (https://chain.com/docs#object-bitcoin-block)
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Get Bitcoin Block OP_RETURNs
 * Returns the OP_RETURN value and associated addresses for all transactions in the block which contain an OP_RETURN output script
 */

try {
    $result = $chain->get_block_op_returns('308920');
    // returns an array of OP_RETURN objects
    var_dump($result);
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

