<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;

class CollaborativeCartMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\CollaborativeCartMapper
     */
    protected $collaborativeCartMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

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

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartMapper = new CollaborativeCartMapper();
    }

    /**
     * @return void
     */
    public function testMapQuoteTransferToResCollaborativeCartsAttributes(): void
    {
        $action = 'claim';
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getIdQuote')
            ->willReturn(1);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn('customer-reference-1');

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getOriginalCustomerReference')
            ->willReturn('original-customer-reference-1');

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn('company-user-reference-1');

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getOriginalCompanyUserReference')
            ->willReturn('original-company-user-reference-1');

        $restCollaborativeCartsAttributesTransfer = $this->collaborativeCartMapper
            ->mapQuoteTransferToResCollaborativeCartsAttributes($this->quoteTransferMock);

        $this->assertInstanceOf(
            RestCollaborativeCartsAttributesTransfer::class,
            $restCollaborativeCartsAttributesTransfer
        );
    }
}
