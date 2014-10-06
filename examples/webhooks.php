<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Cbix\Chain;
use Cbix\ChainException;

$chain = Chain::make('key', 'secret', false);