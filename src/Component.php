<?php

namespace albertborsos\billingo;

use Billingo\API\Connector\HTTP\Request;

class Component extends \CComponent
{
    const MAX_PER_PAGE = 50;

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

    public function getInvoices($filters = [])
    {
        $page = 1;
        $invoices = [];
        do {
            $response = $this->getApi()->get('invoices', [
                'page' => $page,
                'max_per_page' => self::MAX_PER_PAGE,
            ]);

            if (is_array($response)) {
                $invoices = \CMap::mergeArray($invoices, $response);
            }

            $page++;
        } while ($response !== null);

        return array_filter($invoices, function ($item) use ($filters) {
            foreach ($filters as $attribute => $value) {
                if ($value == \ArrayHelper::getValue($item, 'attributes.' . $attribute)) {
                    return true;
                }
            }
            return false;
        });
    }
}
