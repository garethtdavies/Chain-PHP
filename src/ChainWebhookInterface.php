<?php namespace Cbix;

interface ChainWebhookInterface
{
    public function create_webhook($url, $webhook_id = '');

    public function list_webhooks();

    public function update_webhook($webhook_id, $url);

    public function delete_webhook($webhook_id);

    public function create_webhook_event($webhook_id, $options = []);

    public function list_webhook_events($webhook_id);

    public function delete_webhook_event($webhook_id, $event_type, $address);
}