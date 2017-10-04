<?php

namespace Divante\Connector\Bus\ApiClient\Magento;

use Divante\Connector\Bus\ApiClient\BaseClient;
use Divante\Connector\Bus\ApiClientAware;
use GuzzleHttp\Command\Guzzle\Description;

/**
 * Class Order
 * @package Divante\Connector\Bus\ApiClient\Magento
 */
class Order extends BaseClient implements ApiClientAware
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create (array $data)
    {
        return $this->getApiClient()->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function update (array $data)
    {
        return $this->getApiClient()->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove ($id)
    {
        return $this->getApiClient()->remove(['id' => $id]);
    }

    /**
     * @return Description
     */
    public function getApiDescription()
    {
        $orderDefinition = $this->getOrderDescription();

        return new Description([
            'baseUri' => $this->apiUrl,
            'apiVersion' => $this->getVersion(),
            'operations' => [
                'create' => [
                    'httpMethod' => 'POST',
                    'uri' => '/api/magento/order/create',
                    'responseModel' => 'getResponse',
                    'parameters' =>
                        array_merge($orderDefinition, [
                            'id' => [
                                'type' => 'string',
                                'location' => 'json',
                                'required' => false
                            ]
                        ])
                ],
                'update' => [
                    'httpMethod' => 'PUT',
                    'uri' => '/api/magento/order/{id}/update',
                    'responseModel' => 'getResponse',
                    'parameters' =>
                        array_merge($orderDefinition, [
                            'id' => [
                                'type' => 'string',
                                'location' => 'uri',
                                'required' => true
                            ]
                        ])
                ],
                'remove' => [
                    'httpMethod' => 'DELETE',
                    'uri' => '/api/magento/order/{id}/remove',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'id' => [
                            'type' => 'string',
                            'location' => 'uri',
                            'required' => true
                        ]
                    ]
                ]
            ],

            'models' => [
                'getResponse' => [
                    'type' => 'object',
                    'additionalProperties' => [
                        'location' => 'json'
                    ]
                ]
            ]
        ]);
    }

    /**
     * @return array
     */
    protected function getOrderDescription()
    {
        $productDescription = [
            'name' => [
                'type' => 'string',
                'location' => 'json',
                'required' => true
            ],
            'price' => [
                'type' => 'number',
                'location' => 'json',
                'required' => true
            ],
            'status' => [
                'type' => 'string',
                'location' => 'json',
                'required' => false
            ]
        ];
        return $productDescription;
    }
}
