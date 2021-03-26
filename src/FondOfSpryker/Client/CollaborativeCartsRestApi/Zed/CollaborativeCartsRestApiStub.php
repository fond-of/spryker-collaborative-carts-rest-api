<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi\Zed;

use FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;

class CollaborativeCartsRestApiStub implements CollaborativeCartsRestApiStubInterface
{
    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CollaborativeCartsRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCart(
        RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
    ): ClaimCartResponseTransfer {
        /** @var \Generated\Shared\Transfer\ClaimCartResponseTransfer $claimCartResponseTransfer */
        $claimCartResponseTransfer = $this->zedRequestClient->call(
            '/collaborative-carts-rest-api/gateway/claim-cart',
            $restCollaborativeCartRequestAttributesTransfer
        );

        return $claimCartResponseTransfer;
    }
}
