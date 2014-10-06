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
        $result = $chain->get_address_unspents(
            '1K4nPxBMy6sv7jssTvDLJWk1ADHBZEoUVb',
            '1EX1E9n3bPA1zGKDV5iHY2MnM7n5tDfnfH'
        );

        $this->assertCount(4, $result);
        $this->assertEquals(
            '80ec89837a388421e81d912b9e695b7920990dad85956ff5bc484ce82b19db6c',
            $result[0]->transaction_hash
        );
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
        $this->assertEquals(
            '7675ae05dc8b85c4218b5bd3ec0cee49766f915b863e91ab3eb26e9d3ebe8b47',
            $result[0]->transaction_hash
        );
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

    public function test_get_transaction_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/transaction.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->get_transaction('0f40015ddbb8a05e26bbacfb70b6074daa1990b813ba9bc70b7ac5b0b6ee2c45');

        $this->assertEquals('0f40015ddbb8a05e26bbacfb70b6074daa1990b813ba9bc70b7ac5b0b6ee2c45', $result->hash);
    }

    public function test_get_transaction_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $chain->get_transaction('0f40015ddbb8a05e26bbacfb70b6074daa1990b813ba9bc70b7ac5b0b6ee2c45');
    }

    public function test_get_transaction_op_return_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/transaction_op_returns.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->get_transaction_op_return('4a7d62a4a5cc912605c46c6a6ef6c4af451255a453e6cbf2b1022766c331f803');

        $this->assertEquals(
            '4a7d62a4a5cc912605c46c6a6ef6c4af451255a453e6cbf2b1022766c331f803',
            $result->transaction_hash
        );
    }

    public function test_get_transaction_op_return_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $chain->get_transaction_op_return('0f40015ddbb8a05e26bbacfb70b6074daa1990b813ba9bc70b7ac5b0b6ee2c45');
    }

    public function test_transaction_send_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/transaction_send.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->send_transaction('0100000001ec...');

        $this->assertEquals('f468a7...', $result->transaction_hash);
    }

    public function test_transaction_send_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $chain->send_transaction('0100000001ec...');
    }

    public function test_get_block_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/block.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->get_block('00000000000000009cc33fe219537756a68ee5433d593034b6dc200b34aa35fa');

        $this->assertEquals('00000000000000009cc33fe219537756a68ee5433d593034b6dc200b34aa35fa', $result->hash);
    }

    public function test_get_block_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $chain->get_block('00000000000000009cc33fe219537756a68ee5433d593034b6dc200b34aa35fa');
    }

    public function test_get_block_op_returns_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/block_op_returns.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $result = $chain->get_block_op_returns('308920');

        $this->assertCount(3, $result);
        $this->assertEquals(
            'ac886fb0e36ab06ff28200c439236c155e0689f9919a92d1db48f960e11b1cef',
            $result[0]->transaction_hash
        );
    }

    public function test_get_block_op_returns_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainCore($this->client);
        $chain->get_block_op_returns('308920');
    }
}
