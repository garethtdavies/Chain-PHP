<?php

use Cbix\Chain;
use Cbix\ChainException;

$chain = new Chain('key', 'secret');
$result = $chain->get_address('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');

//Single address

//returns a Bitcoin Address Object (https://chain.com/docs#object-bitcoin-address)
$balance = $result->balance;

//Multiple address
