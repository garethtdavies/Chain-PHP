<?php namespace Cbix;

use Exception;

class ChainException extends Exception
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