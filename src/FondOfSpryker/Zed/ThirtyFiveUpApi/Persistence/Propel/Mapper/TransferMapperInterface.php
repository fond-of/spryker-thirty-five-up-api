<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

interface TransferMapperInterface
{
    /**
     * @param  array  $data
     *
     * @return \Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer
     */
    public function toTransfer(array $data): FosThirtyFiveUpOrderEntityTransfer;

    /**
     * @param  array  $data
     *
     * @return \Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer[]
     */
    public function toTransferCollection(array $data): array;
}
