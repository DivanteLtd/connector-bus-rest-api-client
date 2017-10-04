<?php

namespace Divante\Connector\Bus\ApiClient\Magento;

use Divante\Connector\Bus\ApiClient\BaseClient;
use Divante\Connector\Bus\ApiClientAware;
use GuzzleHttp\Command\Guzzle\Description;

/**
 * Class Customer
 * @package Divante\Connector\Bus\ApiClient\Magento
 */
class Customer extends BaseClient implements ApiClientAware
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
        $customerDefinition = $this->getCustomerDescription();

        return new Description([
            'baseUri' => $this->apiUrl,
            'apiVersion' => $this->getVersion(),
            'operations' => [
                'create' => [
                    'httpMethod' => 'POST',
                    'uri' => '/api/magento/customer/create',
                    'responseModel' => 'getResponse',
                    'parameters' =>
                        array_merge($customerDefinition, [
                            'id' => [
                                'type' => 'string',
                                'location' => 'json',
                                'required' => false
                            ]
                        ])
                ],
                'update' => [
                    'httpMethod' => 'PUT',
                    'uri' => '/api/magento/customer/{id}/update',
                    'responseModel' => 'getResponse',
                    'parameters' =>
                        array_merge($customerDefinition, [
                            'id' => [
                                'type' => 'string',
                                'location' => 'uri',
                                'required' => true
                            ]
                        ])
                ],
                'remove' => [
                    'httpMethod' => 'DELETE',
                    'uri' => '/api/magento/customer/{id}/remove',
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
    protected function getCustomerDescription()
    {
        $productDescription = [
            'name' => [
                'type' => 'string',
                'location' => 'json',
                'required' => true
            ],
            'email' => [
                'type' => 'string',
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
