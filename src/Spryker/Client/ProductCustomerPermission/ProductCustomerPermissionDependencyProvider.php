<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductCustomerPermission;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\ProductCustomerPermission\Dependency\Client\ProductCustomerPermissionToCustomerClientBridge;
use Spryker\Client\ProductCustomerPermission\Dependency\Client\ProductCustomerPermissionToLocaleClientBridge;
use Spryker\Client\ProductCustomerPermission\Dependency\Client\ProductCustomerPermissionToStorageClientBridge;

class ProductCustomerPermissionDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_CUSTOMER = 'CLIENT_CUSTOMER';

    /**
     * @var string
     */
    public const CLIENT_LOCALE = 'CLIENT_LOCALE';

    /**
     * @var string
     */
    public const CLIENT_STORAGE = 'CLIENT_STORAGE';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addCustomerClient($container);
        $container = $this->addLocaleClient($container);
        $container = $this->addStorageClient($container);

        return $container;
    }

    protected function addCustomerClient(Container $container): Container
    {
        $container->set(static::CLIENT_CUSTOMER, function (Container $container) {
            return new ProductCustomerPermissionToCustomerClientBridge($container->getLocator()->customer()->client());
        });

        return $container;
    }

    protected function addLocaleClient(Container $container): Container
    {
        $container->set(static::CLIENT_LOCALE, function (Container $container) {
            return new ProductCustomerPermissionToLocaleClientBridge($container->getLocator()->locale()->client());
        });

        return $container;
    }

    protected function addStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_STORAGE, function (Container $container) {
            return new ProductCustomerPermissionToStorageClientBridge($container->getLocator()->storage()->client());
        });

        return $container;
    }
}
