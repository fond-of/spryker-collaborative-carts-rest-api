<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade;

use FondOfSpryker\Zed\CollaborativeCart\Business\CollaborativeCartFacadeInterface;
use Generated\Shared\Transfer\ClaimCartRequestTransfer;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;

class CollaborativeCartsRestApiToCollaborativeCartFacadeBridge implements CollaborativeCartsRestApiToCollaborativeCartFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\CollaborativeCart\Business\CollaborativeCartFacadeInterface
     */
    protected $collaborativeCartFacade;

    /**
     * @param \FondOfSpryker\Zed\CollaborativeCart\Business\CollaborativeCartFacadeInterface $collaborativeCartFacade
     */
    public function __construct(CollaborativeCartFacadeInterface $collaborativeCartFacade)
    {
        $this->collaborativeCartFacade = $collaborativeCartFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ClaimCartRequestTransfer $claimCartRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCart(ClaimCartRequestTransfer $claimCartRequestTransfer): ClaimCartResponseTransfer
    {
        return $this->collaborativeCartFacade->claimCart($claimCartRequestTransfer);
    }
}
