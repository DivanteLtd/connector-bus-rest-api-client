<?php

namespace Divante\Connector\Bus;

use Divante\Connector\Bus\ApiClient\BaseClient;
use Divante\Connector\Bus\ApiClient\Magento;
use Divante\Connector\Bus\ApiClient\Pimcore;

/**
 * Class ApiClient
 * @package Divante\Connector\Bus
 */
class ApiClient extends BaseClient implements ApiClientAware
{
    /**
     * @var Pimcore
     */
    protected $pimcoreEndpoint;

    /**
     * @var Magento
     */
    protected $magentoEndpoint;

    /**
     * @throws \RuntimeException
     */
    public function getApiDescription()
    {
        throw new \RuntimeException('Select endpoint');
    }

    /**
     * @return Pimcore
     */
    public function pimcore ()
    {
        if (null == $this->pimcoreEndpoint) {
            $this->pimcoreEndpoint = new Pimcore(
                $this->config,
                $this->client
            );
        }

        return $this->pimcoreEndpoint;
    }

    /**
     * @return Magento
     */
    public function magento ()
    {
        if (null == $this->magentoEndpoint) {
            $this->magentoEndpoint = new Magento(
                $this->config,
                $this->client
            );
        }

        return $this->magentoEndpoint;
    }
}