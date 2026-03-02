<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductCustomerPermission;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ProductCustomerPermission\Dependency\Client\ProductCustomerPermissionToCustomerClientInterface;
use Spryker\Client\ProductCustomerPermission\Dependency\Client\ProductCustomerPermissionToLocaleClientInterface;
use Spryker\Client\ProductCustomerPermission\Dependency\Client\ProductCustomerPermissionToStorageClientInterface;
use Spryker\Client\ProductCustomerPermission\KeyBuilder\ProductCustomerPermissionResourceKeyBuilder;
use Spryker\Client\ProductCustomerPermission\Storage\ProductCustomerPermissionStorage;
use Spryker\Client\ProductCustomerPermission\Storage\ProductCustomerPermissionStorageInterface;
use Spryker\Shared\KeyBuilder\KeyBuilderInterface;

class ProductCustomerPermissionFactory extends AbstractFactory
{
    public function createStorage(): ProductCustomerPermissionStorageInterface
    {
        return new ProductCustomerPermissionStorage(
            $this->getStorageClient(),
            $this->createKeyBuilder(),
            $this->getLocaleClient(),
        );
    }

    protected function createKeyBuilder(): KeyBuilderInterface
    {
        return new ProductCustomerPermissionResourceKeyBuilder();
    }

    public function getCustomerClient(): ProductCustomerPermissionToCustomerClientInterface
    {
        return $this->getProvidedDependency(ProductCustomerPermissionDependencyProvider::CLIENT_CUSTOMER);
    }

    public function getStorageClient(): ProductCustomerPermissionToStorageClientInterface
    {
        return $this->getProvidedDependency(ProductCustomerPermissionDependencyProvider::CLIENT_STORAGE);
    }

    public function getLocaleClient(): ProductCustomerPermissionToLocaleClientInterface
    {
        return $this->getProvidedDependency(ProductCustomerPermissionDependencyProvider::CLIENT_LOCALE);
    }
}
