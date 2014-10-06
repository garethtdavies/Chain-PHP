<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Cbix\Chain;
use Cbix\ChainWebhookException;

$chain = Chain::webhook('key', 'secret', false);

/*
 * Create Webhook URL
 * Creates a Webhook URL that can receive POST requests from Webhook Events.
 */

try {
    $result = $chain->create_webhook('https://www.cbix.ca/webhook');
    // returns a Webhook URL Object (https://chain.com/docs#object-webhooks)
    var_dump($result);
} catch (ChainWebhookException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * List Webhook URL
 * List all of the Webhook URLs associated with a Chain API KEY.
 */

try {
    $result = $chain->list_webhooks();
    // returns an array of Webhook URL Objects (https://chain.com/docs#object-webhooks)
    var_dump($result);
} catch (ChainWebhookException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Update Webhook URL
 * Update a Webhook URL. This is useful if you need to change the URL that supports many associated Webhook Events.
 */

try {
    $result = $chain->update_webhook('e787d27b-f8ef-4e50-ba62-27d68736a561', 'https://www.cbix.ca/webhook/updated_url');
    // returns a Webhook URL Object (https://chain.com/docs#object-webhooks)
    var_dump($result);
} catch (ChainWebhookException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Delete Webhook URL
 * Deletes a Webhook URL and all associated Webhook Events
 */

try {
    $result = $chain->delete_webhook('e787d27b-f8ef-4e50-ba62-27d68736a561');
    // returns a Webhook URL Object (https://chain.com/docs#object-webhooks)
    var_dump($result);
} catch (ChainWebhookException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Create Webhook Event
 * Creates a Webhook Event that makes POST requests to the associated Webhook when triggered
 */

try {
    $options = [
        'event' => 'address-transaction',
        'block_chain' => 'bitcoin',
        'address' => '17x23dNjXJLzGMev6R63uyRhMWP1VHawKc',
        'confirmations' => 1
    ];

    $result = $chain->create_webhook_event('9b012d63-8e11-42d6-8fa5-9fafabe468c6', $options);
    // returns a Webhook Event Object (https://chain.com/docs#object-webhooks-event)
    var_dump($result);
} catch (ChainWebhookException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * List Webhook Events
 * Lists all Webhook Events associated with a Webhook
 */

try {
    $result = $chain->list_webhook_events('9b012d63-8e11-42d6-8fa5-9fafabe468c6');
    // returns an array of Webhook Event Objects (https://chain.com/docs#object-webhooks-event)
    var_dump($result);
} catch (ChainWebhookException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}

/*
 * Delete Webhook Event
 * Deletes a Webhook Event, which will stop all further POST requests for the event
 */

try {
    $result = $chain->delete_webhook_event('9b012d63-8e11-42d6-8fa5-9fafabe468c6', 'address-transaction', '17x23dNjXJLzGMev6R63uyRhMWP1VHawKc');
    // returns an array of Webhook Event Objects (https://chain.com/docs#object-webhooks-event)
    var_dump($result);
} catch (ChainWebhookException $e) {
    //There was an error more information in $e->getMessage();
    echo "Something went wrong!";
}