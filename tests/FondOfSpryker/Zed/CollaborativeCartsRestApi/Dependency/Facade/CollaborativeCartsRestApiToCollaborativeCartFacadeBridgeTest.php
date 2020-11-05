<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CollaborativeCart\Business\CollaborativeCartFacadeInterface;
use Generated\Shared\Transfer\ClaimCartRequestTransfer;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;

class CollaborativeCartsRestApiToCollaborativeCartFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeBridge
     */
    protected $collaborativeCartsRestApiToCollaborativeCartFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacade
     */
    protected $collaborativeCartFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ClaimCartRequestTransfer
     */
    protected $claimCartRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    protected $claimCartResponseTransfer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->collaborativeCartFacadeMock = $this->getMockBuilder(CollaborativeCartFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->claimCartRequestTransferMock = $this->getMockBuilder(ClaimCartRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->claimCartResponseTransfer = $this->getMockBuilder(ClaimCartResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiToCollaborativeCartFacadeBridge =
            new CollaborativeCartsRestApiToCollaborativeCartFacadeBridge($this->collaborativeCartFacadeMock);
    }

    /**
     * @return void
     */
    public function testClaimCart(): void
    {
        $this->collaborativeCartFacadeMock->expects(self::atLeastOnce())
            ->method('claimCart')
            ->with($this->claimCartRequestTransferMock)
            ->willReturn($this->claimCartResponseTransfer);

        $claimCartResponseTransfer = $this->collaborativeCartsRestApiToCollaborativeCartFacadeBridge
            ->claimCart($this->claimCartRequestTransferMock);

        $this->assertInstanceOf(
            ClaimCartResponseTransfer::class,
            $claimCartResponseTransfer
        );

        $this->assertEquals(
            $this->claimCartResponseTransfer,
            $claimCartResponseTransfer
        );
    }
}
