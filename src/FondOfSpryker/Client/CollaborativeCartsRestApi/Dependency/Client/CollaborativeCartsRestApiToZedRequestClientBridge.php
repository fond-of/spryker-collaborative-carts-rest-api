<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client;

use Spryker\Shared\Kernel\Transfer\TransferInterface;

class CollaborativeCartsRestApiToZedRequestClientBridge implements CollaborativeCartsRestApiToZedRequestClientInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClientInterface $zedRequestClient
     */
    public function __construct($zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param string $url
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $object
     * @param array|int|null $requestOptions
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function call(string $url, TransferInterface $object, array $requestOptions = null)
    {
        return $this->zedRequestClient->call($url, $object, $requestOptions);
    }
}