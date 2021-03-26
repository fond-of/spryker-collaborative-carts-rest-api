<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface CollaborativeCartRestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $action
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCollaborativeCartRestResponse(
        QuoteTransfer $quoteTransfer,
        string $action
    ): RestResponseInterface;

    /**
     * @param string $error
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCollaborativeCartRestErrorResponse(string $error): RestResponseInterface;

    /**
     * @param array $errors
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCollaborativeCartRestErrorResponseFromErrors(array $errors): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createMissingCartIdErrorResponse(): RestResponseInterface;
}
