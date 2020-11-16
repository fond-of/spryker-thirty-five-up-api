<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Communication\Plugin\Api;

use FondOfSpryker\Shared\ThirtyFiveUpApi\ThirtyFiveUpApiConstants;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory getFactory()
 */
class ThirtyFiveUpApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ThirtyFiveUpApiConstants::RESOURCE_THIRTY_FIVE_UP_API;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiValidationErrorTransfer[]
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}
