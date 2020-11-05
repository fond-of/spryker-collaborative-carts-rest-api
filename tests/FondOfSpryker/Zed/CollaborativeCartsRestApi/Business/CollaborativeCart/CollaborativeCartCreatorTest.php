<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCart;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface;
use Generated\Shared\Transfer\ClaimCartRequestTransfer;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;

class CollaborativeCartCreatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeInterface
     */
    protected $collaborativeCartFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    protected $claimCartResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ClaimCartRequestTransfer
     */
    protected $claimCartRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCart\CollaborativeCartCreator
     */
    protected $collaborativeCartCreator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer
     */
    protected $restCollaborativeCartRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteFacadeMock = $this
            ->getMockBuilder(CollaborativeCartsRestApiToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartFacadeMock = $this
            ->getMockBuilder(CollaborativeCartsRestApiToCollaborativeCartFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->claimCartRequestTransferMock = $this->getMockBuilder(ClaimCartRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->claimCartResponseTransferMock = $this->getMockBuilder(ClaimCartResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCollaborativeCartRequestAttributesTransferMock = $this->getMockBuilder(RestCollaborativeCartRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartCreator = new CollaborativeCartCreator(
            $this->collaborativeCartFacadeMock,
            $this->quoteFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testClaimCart(): void
    {
        $this->restCollaborativeCartRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getQuote')
            ->willReturn($this->quoteTransferMock);

        $this->quoteFacadeMock->expects($this->atLeastOnce())
            ->method('findQuoteByUuid')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getIdQuote')
            ->willReturn(1);

        $this->quoteResponseTransferMock->expects($this->atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->collaborativeCartFacadeMock->expects($this->atLeastOnce())
            ->method('claimCart')
            ->willReturn($this->claimCartResponseTransferMock);

        $claimCartResponseTransfer = $this->collaborativeCartCreator
            ->claimCart($this->restCollaborativeCartRequestAttributesTransferMock);

        $this->assertInstanceOf(
            ClaimCartResponseTransfer::class,
            $claimCartResponseTransfer
        );

        $this->assertEquals(
            $this->claimCartResponseTransferMock,
            $claimCartResponseTransfer
        );
    }
}
