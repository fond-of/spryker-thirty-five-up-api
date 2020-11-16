<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Business;

use FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpApi;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpApiInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidator;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidatorInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\ThirtyFiveUpApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface getRepository()()
 */
class ThirtyFiveUpApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpApiInterface
     */
    public function createThirtyFiveUpApi(): ThirtyFiveUpApiInterface
    {
        return new ThirtyFiveUpApi(
            $this->getApiQueryContainer(),
            $this->getThirtyFiveUpFacade(),
            $this->getRepository()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidatorInterface
     */
    public function createThirtyFiveUpApiValidator(): ThirtyFiveUpApiValidatorInterface
    {
        return new ThirtyFiveUpApiValidator();
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): ThirtyFiveUpApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
     */
    protected function getThirtyFiveUpFacade(): ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::FACADE_THIRTY_FIVE_UP);
    }
}
