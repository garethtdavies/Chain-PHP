<?php namespace Cbix;

use GuzzleHttp\Client;

/**
 * Class Chain
 * @package Cbix
 */
class Chain
{
    /**
     * @param $key
     * @param $secret
     * @param bool $testnet
     * @return ChainCore
     */
    public static function make($key, $secret, $testnet = false)
    {
        $blockchain = $testnet === true ? 'testnet3' : 'bitcoin';

        $client = new Client([
            'base_url' => ["https://api.chain.com/{version}/{$blockchain}/", ['version' => 'v1']],
            'defaults' => [
                'auth' => [$key, $secret],
            ]
        ]);

        return new ChainCore($client);
    }

    /**
     * @param $key
     * @param $secret
     * @return ChainWebhook
     */
    public static function webhook($key, $secret)
    {
        $client = new Client([
            'base_url' => ["https://api.chain.com/{version}/", ['version' => 'v1']],
            'defaults' => [
                'auth' => [$key, $secret],
            ]
        ]);

        return new ChainWebhook($client);
    }
}