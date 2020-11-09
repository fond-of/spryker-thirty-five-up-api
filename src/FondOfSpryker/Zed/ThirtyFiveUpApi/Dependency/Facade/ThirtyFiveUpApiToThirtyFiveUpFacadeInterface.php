<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade;

use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpResponseTransfer;

interface ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
{
    /**
     * @param  \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer  $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function updateThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer;

    /**
     * @param int $id
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderById(int $id): ?ThirtyFiveUpOrderTransfer;
}
