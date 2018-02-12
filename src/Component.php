<?php

namespace albertborsos\billingo;

use Billingo\API\Connector\HTTP\Request;

class Component extends \CComponent
{
    /**
     * @var string
     */
    public $publicKey;

    /**
     * @var string
     */
    public $privateKey;

    /**
     * @var Request
     */
    private $_api;

    public function init()
    {
        $this->setApi(new Request(array(
            'public_key' => $this->publicKey,
            'private_key' => $this->privateKey,
        )));
    }

    public function getApi()
    {
        return $this->_api;
    }

    private function setApi(Request $api)
    {
        $this->_api = $api;
    }
}
