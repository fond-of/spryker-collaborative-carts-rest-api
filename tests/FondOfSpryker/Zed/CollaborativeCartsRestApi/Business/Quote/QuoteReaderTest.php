<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface
     */
    protected $collaborativeCartsRestApiToQuoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote\QuoteReader
     */
    protected $quoteReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->collaborativeCartsRestApiToQuoteFacadeMock = $this
            ->getMockBuilder(CollaborativeCartsRestApiToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteReader = new QuoteReader($this->collaborativeCartsRestApiToQuoteFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindQuoteByQuoteUuid(): void
    {
        $this->collaborativeCartsRestApiToQuoteFacadeMock->expects(self::atLeastOnce())
            ->method('findQuoteByUuid')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $quoteResponseTransfer = $this->quoteReader->findQuoteByQuoteUuid($this->quoteTransferMock);

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
