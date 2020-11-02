<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CollaborativeCartCreatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    protected $claimCartResponseTransferMock;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart\CollaborativeCartCreator
     */
    protected $collaborativeCartCreator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface
     */
    protected $collaborativeCartsRestApiClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface
     */
    protected $collaborativeCartsRestApiToCollaborativeCartClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface
     */
    protected $collaborativeCartRestResponseBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer
     */
    protected $restCollaborativeCartsAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUserTransfer
     */
    protected $restUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

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

        $this->restCollaborativeCartsAttributesTransferMock = $this->getMockBuilder(RestCollaborativeCartsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->claimCartResponseTransferMock = $this->getMockBuilder(ClaimCartResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiClientMock = $this->getMockBuilder(CollaborativeCartsRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiToCollaborativeCartClientMock = $this->getMockBuilder(CollaborativeCartsRestApiToCollaborativeCartClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartRestResponseBuilderMock = $this->getMockBuilder(CollaborativeCartRestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartCreator = new CollaborativeCartCreator(
            $this->collaborativeCartsRestApiClientMock,
            $this->collaborativeCartsRestApiToCollaborativeCartClientMock,
            $this->collaborativeCartRestResponseBuilderMock
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $action = 'claim';
        $this->restCollaborativeCartsAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getCartId')
            ->willReturn(1);

        $this->collaborativeCartsRestApiClientMock->expects($this->atLeastOnce())
            ->method('findQuoteByQuoteUuid')
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->quoteResponseTransferMock->expects($this->atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getIdQuote')
            ->willReturn(1);

        $this->restRequestMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn(1);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn(1);

        $this->collaborativeCartsRestApiToCollaborativeCartClientMock->expects($this->atLeastOnce())
            ->method('claimCart')
            ->willReturn($this->claimCartResponseTransferMock);

        $this->claimCartResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->collaborativeCartRestResponseBuilderMock->expects($this->atLeastOnce())
            ->method('createCollaborativeCartRestResponse')
            ->willReturn($this->restResponseMock);

        $this->claimCartResponseTransferMock->expects($this->atLeastOnce())
            ->method('getQuote')
            ->willReturn($this->quoteTransferMock);

        $this->restCollaborativeCartsAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getAction')
            ->willReturn('claim');

        $restResponse = $this->collaborativeCartCreator->create(
            $this->restRequestMock,
            $this->restCollaborativeCartsAttributesTransferMock
        );

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $restResponse
        );
    }
}
