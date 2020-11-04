<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi;

use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiFactory getFactory()
 */
class CollaborativeCartsRestApiClient extends AbstractClient implements CollaborativeCartsRestApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     *
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function claimCart(
        RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
    ): ClaimCartResponseTransfer {
        return $this->getFactory()
            ->createCollaborativeCartsRestApiStub()
            ->claimCart($restCollaborativeCartRequestAttributesTransfer);
    }
}
