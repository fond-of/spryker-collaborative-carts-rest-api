<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Controller;

use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface getClient()
 * @method \FondOfSpryker\Glue\CollaborativeCartsRestApi\CollaborativeCartsRestApiFactory getFactory()
 */
class CollaborativeCartsResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createCollaborativeCartCreator()
            ->create($restRequest, $restCollaborativeCartsAttributesTransfer);
    }
}
