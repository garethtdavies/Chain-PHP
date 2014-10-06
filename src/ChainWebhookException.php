<?php namespace Cbix;

use Exception;

class ChainWebhookException extends Exception
{
    /**
     * @internal param $e
     * @return string
     */
    public function error()
    {
        return $this->getMessage();
    }
}