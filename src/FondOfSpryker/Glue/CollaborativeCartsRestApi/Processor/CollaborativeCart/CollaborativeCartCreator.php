<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart;

use FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface;
use Generated\Shared\Transfer\ClaimCartRequestTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CollaborativeCartCreator implements CollaborativeCartCreatorInterface
{
    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface
     */
    protected $collaborativeCartClient;

    /**
     * CollaborativeCartCreator constructor.
     *
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface $collaborativeCartClient
     */
    public function __construct(
        CollaborativeCartsRestApiToCollaborativeCartClientInterface $collaborativeCartClient
    ) {
        $this->collaborativeCartClient = $collaborativeCartClient;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     *
     * @throws \Exception
     */
    public function create(
        RestRequestInterface $restRequest,
        RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
    ): RestResponseInterface{

        $restResponse = $this->restResourceBuilder->createRestResponse();

        $claimCartRequestTransfer = new ClaimCartRequestTransfer();
        $claimCartResponseTransfer = $this->collaborativeCartClient->claimCart($claimCartRequestTransfer);

        return $restResponse;
    }
}