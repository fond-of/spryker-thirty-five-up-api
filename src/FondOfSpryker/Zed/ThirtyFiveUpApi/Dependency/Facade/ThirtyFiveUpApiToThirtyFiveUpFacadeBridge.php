<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade;

use FondOfSpryker\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpResponseTransfer;

class ThirtyFiveUpApiToThirtyFiveUpFacadeBridge implements ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfSpryker\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface $thirtyFiveUpFacade
     */
    public function __construct(ThirtyFiveUpFacadeInterface $thirtyFiveUpFacade)
    {
        $this->facade = $thirtyFiveUpFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpResponseTransfer
     */
    public function updateThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpResponseTransfer
    {
        return $this->facade->updateThirtyFiveUpOrder($thirtyFiveUpOrderTransfer);
    }

    /**
     * @param int $id
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderById(int $id): ?ThirtyFiveUpOrderTransfer
    {
        return $this->facade->findThirtyFiveUpOrderById($id);
    }
}
