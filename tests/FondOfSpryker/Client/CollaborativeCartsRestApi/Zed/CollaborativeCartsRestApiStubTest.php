<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi\Zed;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;

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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer
     */
    protected $restCollaborativeCartRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    protected $claimCartResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(CollaborativeCartsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCollaborativeCartRequestAttributesTransferMock = $this->getMockBuilder(RestCollaborativeCartRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->claimCartResponseTransferMock = $this->getMockBuilder(ClaimCartResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiStub = new CollaborativeCartsRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testClaimCart(): void
    {
        $this->zedRequestClientMock->expects(self::atLeastOnce())
            ->method('call')
            ->with(
                '/collaborative-carts-rest-api/gateway/claim-cart',
                $this->restCollaborativeCartRequestAttributesTransferMock
            )->willReturn($this->claimCartResponseTransferMock);

        $claimCartResponseTransfer = $this->collaborativeCartsRestApiStub
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
