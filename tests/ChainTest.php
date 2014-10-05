<?php

class ChainTest extends PHPUnit_Framework_TestCase
{
    public function test_make_returns_an_instance_of_chain_core()
    {
        $client = \Cbix\Chain::make('key', 'secret', false);

        $this->assertInstanceOf('Cbix\ChainCore', $client);
    }
}