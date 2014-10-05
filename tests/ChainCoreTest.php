<?php

class ChainCoreTest extends \Guzzle\Tests\GuzzleTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function test_get_address_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/address.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->get_address('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');

        $this->assertEquals('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc', $result->hash);
    }

    public function test_get_address_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $chain->get_address('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');
    }
}
