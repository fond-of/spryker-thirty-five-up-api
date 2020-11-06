<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade;

use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpResponseTransfer;

interface ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpResponseTransfer
     */
    public function updateThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpResponseTransfer
     */
    public function findThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpResponseTransfer;
}
