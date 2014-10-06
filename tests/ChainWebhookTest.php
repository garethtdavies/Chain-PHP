<?php

class ChainWebhookTest extends \Guzzle\Tests\GuzzleTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function test_create_webhook_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/webhook.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $result = $chain->create_webhook('https://username:password@your-server-url.com', 'your-webhook-id');

        $this->assertEquals('FFA21991-5669-4728-8C83-74DEC4C93A4A', $result->id);
    }

    public function test_create_webhook_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainWebhookException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $chain->create_webhook('https://username:password@your-server-url.com', 'your-webhook-id');
    }

    public function test_list_webhooks_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/webhooks.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $result = $chain->list_webhooks();

        $this->assertCount(2, $result);
        $this->assertEquals('FFA21991-5669-4728-8C83-74DEC4C93A4A', $result[0]->id);
    }

    public function test_list_webhooks_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainWebhookException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $chain->list_webhooks();
    }

    public function test_update_webhook_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/webhook_update.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $result = $chain->update_webhook('FFA21991-5669-4728-8C83-74DEC4C93A4A', 'https://your-updated-url.com');

        $this->assertEquals('FFA21991-5669-4728-8C83-74DEC4C93A4A', $result->id);
    }

    public function test_update_webhook_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainWebhookException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $chain->update_webhook('FFA21991-5669-4728-8C83-74DEC4C93A4A', 'https://your-updated-url.com');
    }

    public function test_delete_webhook_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/webhook_delete.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $result = $chain->delete_webhook('FFA21991-5669-4728-8C83-74DEC4C93A4A');

        $this->assertEquals('FFA21991-5669-4728-8C83-74DEC4C93A4A', $result->id);
    }

    public function test_delete_webhook_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainWebhookException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $chain->delete_webhook('FFA21991-5669-4728-8C83-74DEC4C93A4A');
    }

    public function test_create_webhook_event_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/webhook_event_create.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $result = $chain->create_webhook_event(
            '29CDE78E-7BFA-4401-BC0A-3071C88A86F0',
            ['event' => 'address-transaction', 'block_chain' => 'bitcoin', 'address' => '1...', 'confirmations' => 1]
        );

        $this->assertEquals('29CDE78E-7BFA-4401-BC0A-3071C88A86F0', $result->id);
    }

    public function test_create_webhook_event_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainWebhookException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $chain->create_webhook_event(
            'FFA21991-5669-4728-8C83-74DEC4C93A4A',
            ['event' => 'address-transaction', 'block_chain' => 'bitcoin', 'address' => '1...', 'confirmations' => 1]
        );
    }

    public function test_list_webhook_events_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/webhook_event_list.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $result = $chain->list_webhook_events('FFA21991-5669-4728-8C83-74DEC4C93A4A');

        $this->assertCount(2, $result);
        $this->assertEquals('29CDE78E-7BFA-4401-BC0A-3071C88A86F0', $result[0]->id);
    }

    public function test_list_webhook_events_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainWebhookException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $chain->list_webhook_events('FFA21991-5669-4728-8C83-74DEC4C93A4A');
    }

    public function test_delete_webhook_event_returns_correct_response()
    {
        $mock = new GuzzleHttp\Subscriber\Mock([
            __DIR__ . '/mock/webhook_event_delete.txt'
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $result = $chain->delete_webhook_event('FFA21991-5669-4728-8C83-74DEC4C93A4A', 'address-transaction', '1...');

        $this->assertEquals('29CDE78E-7BFA-4401-BC0A-3071C88A86F0', $result->id);
    }

    public function test_delete_webhook_event_throws_an_exception()
    {
        $this->setExpectedException('Cbix\ChainWebhookException');

        $mock = new GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(400),
        ]);

        $this->client->getEmitter()->attach($mock);

        $chain = new Cbix\ChainWebhook($this->client);
        $chain->delete_webhook_event('FFA21991-5669-4728-8C83-74DEC4C93A4A', 'address-transaction', '1...');
    }
}
