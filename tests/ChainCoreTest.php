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

    public function test_get_address_returns_correct_number_of_results_for_multiple_addresses()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/addresses.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->get_address('17x23dNjXJLzGMev6R63uyRhMWP1VHawKc', '1EX1E9n3bPA1zGKDV5iHY2MnM7n5tDfnfH');

        $this->assertCount(2, $result);
    }

    public function test_get_address_transactions_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/address_transactions.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->get_address_transactions('1K4nPxBMy6sv7jssTvDLJWk1ADHBZEoUVb', ['limit' => 2]);

        $this->assertCount(2, $result);
        $this->assertEquals('0bf0de38c26195919179f42d475beb7a6b15258c38b57236afdd60a07eddd2cc', $result[0]->hash);
    }

    public function test_get_address_transactions_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $chain->get_address_transactions('1K4nPxBMy6sv7jssTvDLJWk1ADHBZEoUVb');
    }
}
