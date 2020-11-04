<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiBusinessFactory getFactory()
 */
class CollaborativeCartsRestApiFacade extends AbstractFacade implements CollaborativeCartsRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCart(
        RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
    ): ClaimCartResponseTransfer {
        return $this->getFactory()
            ->createCollaborativeCartCreator()
            ->claimCart($restCollaborativeCartRequestAttributesTransfer);
    }
}
