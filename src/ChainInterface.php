<?php namespace Cbix;

interface ChainInterface
{
    public function get_address($address);

    public function get_address_transactions($address, $options = []);

    public function get_address_unspents($address);

    public function get_address_op_returns($address);

    public function get_transaction($hash);

    public function get_transaction_op_return($hash);

    public function send_transaction($hex);

    public function get_block($block);

    public function get_latest_block();

    public function get_block_op_returns($block);

    public function create_webhook($url, $webhook_id = '');

    public function list_webhooks();

    public function update_webhook($webhook_id, $url);

    public function delete_webhook($webhook_id);

    public function create_webhook_event($webhook_id, $options = []);

    public function list_webhook_events($webhook_id);

    public function delete_webhook_event($webhook_id, $event_type, $address);
}