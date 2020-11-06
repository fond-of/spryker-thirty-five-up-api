<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * Class ThirtyFiveUpApiFacade
 *
 * @package FondOfSpryker\Zed\ThirtyFiveUpApi\Business
 *
 * @method \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory getFactory()
 */
class ThirtyFiveUpApiFacade extends AbstractFacade implements ThirtyFiveUpApiFacadeInterface
{
    /**
     * @param int $idThirtyFiveUpOrder
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateThirtyFiveUpOrder(int $idThirtyFiveUpOrder, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()->createThirtyFiveUpApi()->update($idThirtyFiveUpOrder, $apiDataTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findThirtyFiveUpOrder(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()->createThirtyFiveUpApi()->find($apiRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFactory()->createThirtyFiveUpApiValidator()->validate($apiDataTransfer);
    }
}
