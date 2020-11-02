<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\CollaborativeCartMapperInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class CollaborativeCartsRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\CollaborativeCartMapperInterface
     */
    protected $collaborativeCartMapperMock;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilder
     */
    protected $collaborativeCartRestResponseBuilder;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer
     */
    protected $restCollaborativeCartsAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCollaborativeCartsAttributesTransferMock = $this->getMockBuilder(RestCollaborativeCartsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartMapperMock = $this->getMockBuilder(CollaborativeCartMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartRestResponseBuilder = new CollaborativeCartRestResponseBuilder(
            $this->restResourceBuilderMock,
            $this->collaborativeCartMapperMock
        );
    }

    /**
     * @return void
     */
    public function testCreateCollaborativeCartRestResponse(): void
    {
        $action = 'claim';
        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->willReturn($this->restResponseMock);

        $restResponse = $this->collaborativeCartRestResponseBuilder->createCollaborativeCartRestResponse(
            $this->quoteTransferMock,
            $action
        );

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $restResponse
        );
    }

    /**
     * @return void
     */
    public function testCreateCollaborativeCartResource(): void
    {
        $action = 'claim';
        $this->collaborativeCartMapperMock->expects($this->atLeastOnce())
            ->method('mapQuoteTransferToResCollaborativeCartsAttributes')
            ->willReturn($this->restCollaborativeCartsAttributesTransferMock);

        $this->restCollaborativeCartsAttributesTransferMock->expects($this->atLeastOnce())
            ->method('setAction')
            ->willReturn($this->restCollaborativeCartsAttributesTransferMock);

        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->willReturn($this->restResourceMock);

        $restResource = $this->collaborativeCartRestResponseBuilder->createCollaborativeCartResource(
            $this->quoteTransferMock,
            $action
        );

        $this->assertInstanceOf(
            RestResourceInterface::class,
            $restResource
        );
    }

    /**
     * @return void
     */
    public function testCreateCollaborativeCartRestErrorResponse(): void
    {
        $error = 'Could not find quote to claim.';
        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseMock);

        $restResponse = $this->collaborativeCartRestResponseBuilder
            ->createCollaborativeCartRestErrorResponse($error);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $restResponse
        );
    }

    /**
     * @return void
     */
    public function testCreateCollaborativeCartRestErrorResponseFromErrors(): void
    {
        $errors = ['Could not find quote to claim.'];
        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseMock);

        $restResponse = $this->collaborativeCartRestResponseBuilder
            ->createCollaborativeCartRestErrorResponseFromErrors($errors);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $restResponse
        );
    }

    /**
     * @return void
     */
    public function testCreateQuoteNotFoundErrorResponse(): void
    {
        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseMock);

        $restResponse = $this->collaborativeCartRestResponseBuilder
            ->createQuoteNotFoundErrorResponse();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $restResponse
        );
    }

    /**
     * @return void
     */
    public function testCreateMissingCartIdErrorResponse(): void
    {
        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseMock);

        $restResponse = $this->collaborativeCartRestResponseBuilder
            ->createMissingCartIdErrorResponse();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $restResponse
        );
    }

    /**
     * @return void
     */
    public function testCreateUnknownErrorResponse(): void
    {
        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('addError')
            ->willReturn($this->restResponseMock);

        $restResponse = $this->collaborativeCartRestResponseBuilder
            ->createUnknownErrorResponse();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $restResponse
        );
    }
}
