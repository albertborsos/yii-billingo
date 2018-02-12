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

    public function getApi()
    {
        if (empty($this->_api)) {
            $this->_api = new Request(array(
                'publicKey' => $this->publicKey,
                'privateKey' => $this->privateKey,
            ));
        }
        return $this->_api;
    }
}
