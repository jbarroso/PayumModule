<?php
namespace Payum\PayumModule\Registry;

use Payum\PayumModule\Options\PayumOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RegistryFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var PayumOptions $options */
        $options = $serviceLocator->get('payum.options');

        $registry = new ServiceLocatorAwareRegistry(
            $options->getPayments(),
            $options->getStorages(),
            null
        );
        
        //TODO: quick fix. we should avoid early init of services. has to be reworked to be lazy
        $registry->setServiceLocator($serviceLocator);

        return $registry;
    }
}
