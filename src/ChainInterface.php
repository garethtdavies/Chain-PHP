<?php namespace Cbix;

interface ChainInterface
{
    public function get_address($address);

    public function get_address_transactions($address, $options = []);

    public function get_address_unspents($address);

    public function get_address_op_returns($address);

    public function get_transaction($hash);

    public function get_transaction_op_return($hash);
    
    public function get_transaction_confidence($hash);

    public function send_transaction($hex);

    public function get_block($block);

    public function get_latest_block();

    public function get_block_op_returns($block);
}
