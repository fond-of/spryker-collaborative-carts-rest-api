<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote\QuoteReaderInterface;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CollaborativeCartsRestApiFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiBusinessFactory
     */
    protected $collaborativeCartsRestApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote\QuoteReaderInterface
     */
    protected $quoteReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiFacade
     */
    protected $collaborativeCartsRestApiFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->collaborativeCartsRestApiBusinessFactoryMock = $this->getMockBuilder(CollaborativeCartsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteReaderMock = $this->getMockBuilder(QuoteReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiFacade = new CollaborativeCartsRestApiFacade();
        $this->collaborativeCartsRestApiFacade->setFactory($this->collaborativeCartsRestApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindQuoteByQuotetUuid(): void
    {
        $this->collaborativeCartsRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createQuoteReader')
            ->willReturn($this->quoteReaderMock);

        $this->quoteReaderMock->expects($this->atLeastOnce())
            ->method('findQuoteByQuoteUuid')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $quoteResponseTransfer = $this->collaborativeCartsRestApiFacade
            ->findQuoteByQuotetUuid($this->quoteTransferMock);

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
