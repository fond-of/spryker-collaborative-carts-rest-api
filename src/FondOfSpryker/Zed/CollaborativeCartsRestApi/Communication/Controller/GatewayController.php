<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Communication\Controller;

use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiFacade getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCartAction(
        RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
    ): ClaimCartResponseTransfer {
        return $this->getFacade()->claimCart($restCollaborativeCartRequestAttributesTransfer);
    }
}
