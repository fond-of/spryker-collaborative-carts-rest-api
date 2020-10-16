<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client;

use FondOfSpryker\Client\CollaborativeCart\CollaborativeCartClientInterface;
use Generated\Shared\Transfer\ClaimCartRequestTransfer;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;

class CollaborativeCartsRestApiToCollaborativeCartClientBridge implements CollaborativeCartsRestApiToCollaborativeCartClientInterface
{
    /**
     * @var \FondOfSpryker\Client\CollaborativeCart\CollaborativeCartClientInterface
     */
    protected $collaborativeCartClient;

    /**
     * CollaborativeCartsRestApiToCollaborativeCartClientBridge constructor.
     *
     * @param \FondOfSpryker\Client\CollaborativeCart\CollaborativeCartClientInterface $collaborativeCartClient
     */
    public function __construct(CollaborativeCartClientInterface $collaborativeCartClient)
    {
        $this->collaborativeCartClient = $collaborativeCartClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ClaimCartRequestTransfer $claimCartRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCart(ClaimCartRequestTransfer $claimCartRequestTransfer): ClaimCartResponseTransfer
    {
        return $this->collaborativeCartClient->claimCart($claimCartRequestTransfer);
    }
}
