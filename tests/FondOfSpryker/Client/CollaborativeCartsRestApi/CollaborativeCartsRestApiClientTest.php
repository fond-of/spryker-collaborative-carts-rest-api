<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStubInterface;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;

class CollaborativeCartsRestApiClientTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClient
     */
    protected $collaborativeCartsRestApiClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiFactory
     */
    protected $collaborativeCartsRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStubInterface
     */
    protected $collaborativeCartsRestApiStubMock;

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

        $this->collaborativeCartsRestApiFactoryMock = $this->getMockBuilder(CollaborativeCartsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiStubMock = $this->getMockBuilder(CollaborativeCartsRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCollaborativeCartRequestAttributesTransferMock = $this->getMockBuilder(RestCollaborativeCartRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->claimCartResponseTransferMock = $this->getMockBuilder(ClaimCartResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiClient = new CollaborativeCartsRestApiClient();
        $this->collaborativeCartsRestApiClient->setFactory($this->collaborativeCartsRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testClaimCart(): void
    {
        $this->collaborativeCartsRestApiFactoryMock->expects(self::atLeastOnce())
            ->method('createCollaborativeCartsRestApiStub')
            ->willReturn($this->collaborativeCartsRestApiStubMock);

        $this->collaborativeCartsRestApiStubMock->expects(self::atLeastOnce())
            ->method('claimCart')
            ->with($this->restCollaborativeCartRequestAttributesTransferMock)
            ->willReturn($this->claimCartResponseTransferMock);

        $claimCartResponseTransfer = $this->collaborativeCartsRestApiClient
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
