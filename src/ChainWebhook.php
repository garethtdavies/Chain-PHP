<?php namespace Cbix;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Chain Webhook
 * @package Cbix
 */
class ChainWebhook implements ChainWebhookInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $url
     * @param string $webhook_id
     * @return mixed
     * @throws ChainWebhookException
     */
    public function create_webhook($url, $webhook_id = '')
    {
        $body = empty($webhook_id) ? ['url' => $url] : ['url' => $url, 'id' => $webhook_id];

        try {
            $response = $this->client->post(
                "webhooks",
                [
                    'json' => $body
                ]
            );
        } catch (RequestException $e) {
            throw new ChainWebhookException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @return mixed
     * @throws ChainWebhookException
     */
    public function list_webhooks()
    {
        try {
            $response = $this->client->get("webhooks");
        } catch (RequestException $e) {
            throw new ChainWebhookException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @param $url
     * @return mixed
     * @throws ChainWebhookException
     */
    public function update_webhook($webhook_id, $url)
    {
        try {
            $response = $this->client->put(
                "webhooks/{$webhook_id}",
                [
                    'json' => [
                        'url' => $url
                    ]
                ]
            );
        } catch (RequestException $e) {
            throw new ChainWebhookException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @return mixed
     * @throws ChainWebhookException
     */
    public function delete_webhook($webhook_id)
    {
        try {
            $response = $this->client->delete("webhooks/{$webhook_id}");
        } catch (RequestException $e) {
            throw new ChainWebhookException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @param array $options
     * @return mixed
     * @throws ChainWebhookException
     */
    public function create_webhook_event($webhook_id, $options = [])
    {
        try {
            $response = $this->client->post(
                "webhooks/{$webhook_id}/events",
                [
                    'json' => [
                        'event' => $options['event'],
                        'block_chain' => $options['block_chain'],
                        'address' => $options['address'],
                        'confirmations' => $options['confirmations'],
                    ]
                ]
            );
        } catch (RequestException $e) {
            throw new ChainWebhookException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @return mixed
     * @throws ChainWebhookException
     */
    public function list_webhook_events($webhook_id)
    {
        try {
            $response = $this->client->get("webhooks/{$webhook_id}/events");
        } catch (RequestException $e) {
            throw new ChainWebhookException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @param $event_type
     * @param $address
     * @return mixed
     * @throws ChainWebhookException
     */
    public function delete_webhook_event($webhook_id, $event_type, $address)
    {
        try {
            $response = $this->client->delete("webhooks/{$webhook_id}/events/{$event_type}/{$address}");
        } catch (RequestException $e) {
            throw new ChainWebhookException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }
}