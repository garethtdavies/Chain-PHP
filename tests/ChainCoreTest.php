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

    public function test_get_address_unspents_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/address_unspents.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->get_address_unspents('1K4nPxBMy6sv7jssTvDLJWk1ADHBZEoUVb', '1EX1E9n3bPA1zGKDV5iHY2MnM7n5tDfnfH');

        $this->assertCount(4, $result);
        $this->assertEquals('80ec89837a388421e81d912b9e695b7920990dad85956ff5bc484ce82b19db6c', $result[0]->transaction_hash);
    }

    public function test_get_address_unspents_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $chain->get_address_unspents('1K4nPxBMy6sv7jssTvDLJWk1ADHBZEoUVb');
    }

    public function test_get_address_op_returns_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/address_op_returns.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->get_address_op_returns('1Bj5UVzWQ84iBCUiy5eQ1NEfWfJ4a3yKG1');

        $this->assertCount(76, $result);
        $this->assertEquals('7675ae05dc8b85c4218b5bd3ec0cee49766f915b863e91ab3eb26e9d3ebe8b47', $result[0]->transaction_hash);
    }

    public function test_get_address_op_returns_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $chain->get_address_op_returns('1K4nPxBMy6sv7jssTvDLJWk1ADHBZEoUVb');
    }
}
