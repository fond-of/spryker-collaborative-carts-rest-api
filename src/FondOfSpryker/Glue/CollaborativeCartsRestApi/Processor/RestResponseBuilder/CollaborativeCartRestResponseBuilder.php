<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder;

use FondOfSpryker\Glue\CollaborativeCartsRestApi\CollaborativeCartsRestApiConfig;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\CollaborativeCartMapperInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class CollaborativeCartRestResponseBuilder implements CollaborativeCartRestResponseBuilderInterface
{
    protected const ERROR_MESSAGE_COLLABORATIVE_CART_NOT_FOUND = 'Could not find quote to claim.';

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\CollaborativeCartMapperInterface
     */
    protected $collaborativeCartMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     *
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\CollaborativeCartMapperInterface $collaborativeCartMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CollaborativeCartMapperInterface $collaborativeCartMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->collaborativeCartMapper = $collaborativeCartMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $action
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCollaborativeCartRestResponse(
        QuoteTransfer $quoteTransfer,
        string $action
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        if ($quoteTransfer === null) {
            return $restResponse;
        }

        return $restResponse->addResource(
            $this->createCollaborativeCartResource($quoteTransfer, $action)
        );
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $action
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    public function createCollaborativeCartResource(QuoteTransfer $quoteTransfer, string $action): RestResourceInterface
    {
        $restCollaborativeCartsAttributesTransfer = $this->collaborativeCartMapper
            ->mapQuoteTransferToResCollaborativeCartsAttributes($quoteTransfer);

        $restCollaborativeCartsAttributesTransfer->setAction($action);

        return $this->restResourceBuilder->createRestResource(
            CollaborativeCartsRestApiConfig::RESOURCE_COLLABORATIVE_CARTS,
            $quoteTransfer->getUuid(),
            $restCollaborativeCartsAttributesTransfer
        );
    }

    /**
     * @param string $error
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCollaborativeCartRestErrorResponse(string $error): RestResponseInterface
    {
        if ($error === static::ERROR_MESSAGE_COLLABORATIVE_CART_NOT_FOUND) {
            return $this->createQuoteNotFoundErrorResponse();
        }

        return $this->createUnknownErrorResponse();
    }

    /**
     * @param array $errors
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCollaborativeCartRestErrorResponseFromErrors(array $errors): RestResponseInterface
    {
        foreach ($errors as $error) {
            if ($error === static::ERROR_MESSAGE_COLLABORATIVE_CART_NOT_FOUND) {
                return $this->createQuoteNotFoundErrorResponse();
            }
        }

        return $this->createUnknownErrorResponse();
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createQuoteNotFoundErrorResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CollaborativeCartsRestApiConfig::RESPONSE_CODE_COLLABORATIVE_CARTS_NOT_FOUND)
            ->setDetail(CollaborativeCartsRestApiConfig::RESPONSE_DETAIL_COLLABORATIVE_CARTS_NOT_FOUND)
            ->setStatus(Response::HTTP_NOT_FOUND);

        return $this->restResourceBuilder->createRestResponse()->addError($restErrorMessageTransfer);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createMissingCartIdErrorResponse(): RestResponseInterface
    {
        $errorMessage = (new RestErrorMessageTransfer())
            ->setDetail(CollaborativeCartsRestApiConfig::RESPONSE_DETAIL_COLLABORATIVE_CARTS_MISSING_CART_ID)
            ->setCode(CollaborativeCartsRestApiConfig::RESPONSE_CODE_COLLABORATIVE_CARTS_MISSING_CART_ID)
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        return $this->restResourceBuilder->createRestResponse()->addError($errorMessage);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createUnknownErrorResponse(): RestResponseInterface
    {
        $errorMessage = (new RestErrorMessageTransfer())
            ->setDetail(CollaborativeCartsRestApiConfig::RESPONSE_DETAIL_COLLABORATIVE_CARTS_UNKNOWN_ERROR)
            ->setCode(CollaborativeCartsRestApiConfig::RESPONSE_CODE_COLLABORATIVE_CARTS_UNKNOWN_ERROR)
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        return $this->restResourceBuilder->createRestResponse()->addError($errorMessage);
    }
}
