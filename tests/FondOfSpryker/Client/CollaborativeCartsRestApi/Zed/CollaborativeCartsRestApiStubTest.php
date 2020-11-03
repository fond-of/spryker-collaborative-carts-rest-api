<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi\Zed;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CollaborativeCartsRestApiStubTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStub
     */
    protected $collaborativeCartsRestApiStub;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(CollaborativeCartsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiStub = new CollaborativeCartsRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testFindQuoteByQuoteUuid(): void
    {
        $this->zedRequestClientMock->expects(self::atLeastOnce())
            ->method('call')
            ->with(
                '/collaborative-carts-rest-api/gateway/find-quote-by-quote-uuid',
                $this->quoteTransferMock
            )->willReturn($this->quoteResponseTransferMock);

        $quoteResponseTransfer = $this->collaborativeCartsRestApiStub->findQuoteByQuoteUuid(
            $this->quoteTransferMock
        );

        $this->assertInstanceOf(
            QuoteResponseTransfer::class,
            $quoteResponseTransfer
        );

        $this->assertEquals(
            $this->quoteResponseTransferMock,
            $quoteResponseTransfer
        );
    }
}
