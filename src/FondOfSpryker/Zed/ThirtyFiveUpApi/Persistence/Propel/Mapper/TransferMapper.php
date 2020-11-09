<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param  array  $data
     *
     * @return \Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer
     */
    public function toTransfer(array $data): FosThirtyFiveUpOrderEntityTransfer
    {
        $thirtyFiveUpOrderTransfer = new FosThirtyFiveUpOrderEntityTransfer();
        $thirtyFiveUpOrderTransfer->fromArray($data, true);

        return $thirtyFiveUpOrderTransfer;
    }

    /**
     * @param  array  $data
     *
     * @return \Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer[]
     */
    public function toTransferCollection(array $data): array
    {
        $transferList = [];
        foreach ($data as $itemData) {
            $transferList[] = $this->toTransfer($itemData);
        }

        return $transferList;
    }
}
