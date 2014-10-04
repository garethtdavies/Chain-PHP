<?php namespace Cbix;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Chain Core
 * @package Cbix
 */
class ChainCore implements ChainInterface
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
     * @param $address
     * @return mixed
     * @throws ChainException
     */
    public function get_address($address)
    {
        $address = is_array($address) ? implode(',', $address) : $address;

        try {
            $response = $this->client->get("addressesss/{$address}");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $address
     * @param array $options
     * @return mixed
     * @throws ChainException
     */
    public function get_address_transactions($address, $options=[])
    {
        $address = is_array($address) ? implode(',', $address) : $address;
        $limit = isset($options['limit']) ? $options['limit'] : 50;

        try {
            $response = $this->client->get("addresses/{$address}/transactions?limit={$limit}");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $address
     * @return mixed
     * @throws ChainException
     */
    public function get_address_unspents($address)
    {
        $address = is_array($address) ? implode(',', $address) : $address;

        try {
            $response = $this->client->get("addresses/{$address}/unspents");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $address
     * @return mixed
     * @throws ChainException
     */
    public function get_address_op_returns($address)
    {
        $address = is_array($address) ? implode(',', $address) : $address;

        try {
            $response = $this->client->get("addresses/{$address}/op-returns");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $hash
     * @return mixed
     * @throws ChainException
     */
    public function get_transaction($hash)
    {
        try {
            $response = $this->client->get("transactions/{$hash}");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $hash
     * @return mixed
     * @throws ChainException
     */
    public function get_transaction_op_return($hash)
    {
        try {
            $response = $this->client->get("transactions/{$hash}/op-return");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $hex
     * @return mixed
     * @throws ChainException
     */
    public function send_transaction($hex)
    {
        try {
            $response = $this->client->post("transactions", [
                    'body' => [
                        'hex' => $hex
                    ]
                ]);
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $block
     * @return mixed
     * @throws ChainException
     */
    public function get_block($block)
    {
        try {
            $response = $this->client->get("blocks/{$block}");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @return mixed
     * @throws ChainException
     */
    public function get_latest_block()
    {
        try {
            $response = $this->client->get("blocks/latest");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $block
     * @return mixed
     * @throws ChainException
     */
    public function get_block_op_returns($block)
    {
        try {
            $response = $this->client->get("blocks/{$block}/op-returns");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $url
     * @param string $webhook_id
     * @return mixed
     * @throws ChainException
     */
    public function create_webhook($url, $webhook_id = '')
    {
        try {
            $response = $this->client->post("webhooks", [
                    'body' => [
                        'url' => $url,
                        'id' => $webhook_id
                    ]
                ]);
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @return mixed
     * @throws ChainException
     */
    public function list_webhooks()
    {
        try {
            $response = $this->client->get("webhooks");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @param $url
     * @return mixed
     * @throws ChainException
     */
    public function update_webhook($webhook_id, $url)
    {
        try {
            $response = $this->client->put("webhooks", [
                    'body' => [
                        'id' => $webhook_id,
                        'url' => $url,
                    ]
                ]);
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @return mixed
     * @throws ChainException
     */
    public function delete_webhook($webhook_id)
    {
        try {
            $response = $this->client->delete("webhooks/{$webhook_id}");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @param array $options
     * @return mixed
     * @throws ChainException
     */
    public function create_webhook_event($webhook_id, $options = [])
    {
        try {
            $response = $this->client->post("webhooks/{$webhook_id}/events", [
                    'body' => [
                        'event' => $options['event'],
                        'blockchain' => $options['blockchain'],
                        'address' => $options['address'],
                        'confirmations' => $options['confirmations'],
                    ]
                ]);
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @return mixed
     * @throws ChainException
     */
    public function list_webhook_events($webhook_id)
    {
        try {
            $response = $this->client->get("webhooks/{$webhook_id}/events");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $webhook_id
     * @param $event_type
     * @param $address
     * @return mixed
     * @throws ChainException
     */
    public function delete_webhook_event($webhook_id, $event_type, $address)
    {
        try {
            $response = $this->client->delete("webhooks/{$webhook_id}/events/{$event_type}/{$address}");
        } catch (RequestException $e) {
            throw new ChainException($e->getResponse()->getbody());
        }

        return json_decode($response->getBody());
    }
}