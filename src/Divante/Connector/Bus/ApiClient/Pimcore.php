<?php

namespace Divante\Connector\Bus\ApiClient;

use Divante\Connector\Bus\ApiClient\Pimcore\Attribute;
use Divante\Connector\Bus\ApiClient\Pimcore\Product;
use Divante\Connector\Bus\ApiClient\Pimcore\Category;
use Divante\Connector\Bus\ApiClientAware;

/**
 * Class Pimcore
 * @package Divante\Connector\Bus\ApiClient
 */
class Pimcore extends BaseClient implements ApiClientAware
{
    /**
     * @var Product
     */
    protected $productEndpoint;

    /**
     * @var Category
     */
    protected $categoryEndpoint;

    /**
     * @var Attribute
     */
    protected $attributeEndpoint;

    /**
     * @return Product
     */
    public function product ()
    {
        if (null == $this->productEndpoint) {
            $this->productEndpoint = new Product(
                $this->config,
                $this->client
            );
        }

        return $this->productEndpoint;
    }

    /**
     * @return Category
     */
    public function category ()
    {
        if (null == $this->categoryEndpoint) {
            $this->categoryEndpoint = new Category(
                $this->config,
                $this->client
            );
        }

        return $this->categoryEndpoint;
    }

    /**
     * @return Attribute
     */
    public function attribute ()
    {
        if (null == $this->attributeEndpoint) {
            $this->attributeEndpoint = new Attribute(
                $this->config,
                $this->client
            );
        }

        return $this->attributeEndpoint;
    }

    /**
     * @throws \RuntimeException
     */
    public function getApiDescription()
    {
        throw new \RuntimeException('Select endpoint');
    }
}