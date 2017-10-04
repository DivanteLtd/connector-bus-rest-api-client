<?php

namespace Divante\Connector\Bus\ApiClient;

use Divante\Connector\Bus\ApiClient\Magento\Customer;
use Divante\Connector\Bus\ApiClient\Magento\Order;
use Divante\Connector\Bus\ApiClientAware;

/**
 * Class Pimcore
 * @package Divante\Connector\Bus\ApiClient
 */
class Magento extends BaseClient implements ApiClientAware
{
    /**
     * @var Order
     */
    protected $orderEndpoint;

    /**
     * @var Customer
     */
    protected $customerEndpoint;

    /**
     * @return Order
     */
    public function order ()
    {
        if (null == $this->orderEndpoint) {
            $this->orderEndpoint = new Order(
                $this->config,
                $this->client
            );
        }

        return $this->orderEndpoint;
    }

    /**
     * @return Customer
     */
    public function customer ()
    {
        if (null == $this->customerEndpoint) {
            $this->customerEndpoint = new Customer(
                $this->config,
                $this->client
            );
        }

        return $this->customerEndpoint;
    }

    /**
     * @throws \RuntimeException
     */
    public function getApiDescription()
    {
        throw new \RuntimeException('Select endpoint');
    }
}