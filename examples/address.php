<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Cbix\Chain;
use Cbix\ChainException;

$chain = Chain::link('key', 'secret', false);
try {
    $result = $chain->get_address('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');
    $balance = $result->balance;
} catch (ChainException $e) {
    //There was an error more information in $e->getMessage();
    echo(json_decode($e->getMessage())->message);
}

//Single address

//returns a Bitcoin Address Object (https://chain.com/docs#object-bitcoin-address)


//Multiple address
