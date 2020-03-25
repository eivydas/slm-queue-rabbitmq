<?php

namespace SlmQueueRabbitMq\Factory;

use SlmQueue\Queue\QueuePluginManager;
use SlmQueueRabbitMq\Controller\RabbitMqWorkerController;
use SlmQueueRabbitMq\Worker\RabbitMqWorker;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class RabbitMqWorkerControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return RabbitMqWorkerController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $worker = $container->get(RabbitMqWorker::class);
        $queuePluginManager = $container->get(QueuePluginManager::class);

        return new RabbitMqWorkerController($worker, $queuePluginManager);
    }

    /**
     * @inheritdoc
     * @return RabbitMqWorkerController
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $canonicalName = null, $requestedName = null)
    {
        /** @var \Laminas\Mvc\Controller\ControllerManager $serviceLocator*/

        return $this($serviceLocator->getServiceLocator(), RabbitMqWorkerController::class);
    }
}
