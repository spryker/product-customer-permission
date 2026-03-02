<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductCustomerPermission\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\ProductCustomerPermission\Business\Model\ProductCustomerPermissionCartValidator;
use Spryker\Zed\ProductCustomerPermission\Business\Model\ProductCustomerPermissionCartValidatorInterface;
use Spryker\Zed\ProductCustomerPermission\Business\Model\ProductCustomerPermissionCheckoutPreCondition;
use Spryker\Zed\ProductCustomerPermission\Business\Model\ProductCustomerPermissionCheckoutPreConditionInterface;
use Spryker\Zed\ProductCustomerPermission\Business\Model\ProductCustomerPermissionSaver;
use Spryker\Zed\ProductCustomerPermission\Business\Model\ProductCustomerPermissionSaverInterface;
use Spryker\Zed\ProductCustomerPermission\Dependency\Facade\ProductCustomerPermissionToGlossaryFacadeInterface;
use Spryker\Zed\ProductCustomerPermission\Dependency\Facade\ProductCustomerPermissionToProductFacadeInterface;
use Spryker\Zed\ProductCustomerPermission\Dependency\Facade\ProductCustomerPermissionToTouchFacadeInterface;
use Spryker\Zed\ProductCustomerPermission\ProductCustomerPermissionDependencyProvider;

/**
 * @method \Spryker\Zed\ProductCustomerPermission\ProductCustomerPermissionConfig getConfig()
 * @method \Spryker\Zed\ProductCustomerPermission\Persistence\ProductCustomerPermissionQueryContainerInterface getQueryContainer()
 */
class ProductCustomerPermissionBusinessFactory extends AbstractBusinessFactory
{
    public function createProductCustomerPermissionSaver(): ProductCustomerPermissionSaverInterface
    {
        return new ProductCustomerPermissionSaver($this->getQueryContainer(), $this->getTouchFacade());
    }

    public function createCartValidator(): ProductCustomerPermissionCartValidatorInterface
    {
        return new ProductCustomerPermissionCartValidator($this->getQueryContainer(), $this->getProductFacade());
    }

    public function createCheckoutPreConditionChecker(): ProductCustomerPermissionCheckoutPreConditionInterface
    {
        return new ProductCustomerPermissionCheckoutPreCondition($this->getQueryContainer(), $this->getGlossaryFacade());
    }

    protected function getTouchFacade(): ProductCustomerPermissionToTouchFacadeInterface
    {
        return $this->getProvidedDependency(ProductCustomerPermissionDependencyProvider::FACADE_TOUCH);
    }

    protected function getProductFacade(): ProductCustomerPermissionToProductFacadeInterface
    {
        return $this->getProvidedDependency(ProductCustomerPermissionDependencyProvider::FACADE_PRODUCT);
    }

    protected function getGlossaryFacade(): ProductCustomerPermissionToGlossaryFacadeInterface
    {
        return $this->getProvidedDependency(ProductCustomerPermissionDependencyProvider::FACADE_GLOSSARY);
    }
}
