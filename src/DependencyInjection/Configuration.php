<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\DependencyInjection;

use Nextstore\SyliusDropshippingCorePlugin\Form\Type\ConfigType;
use Nextstore\SyliusDropshippingCorePlugin\Form\Type\OnlineStoreImageType;
use Nextstore\SyliusDropshippingCorePlugin\Form\Type\OnlineStoreType;
use Nextstore\SyliusDropshippingCorePlugin\Model\Config;
use Nextstore\SyliusDropshippingCorePlugin\Model\ConfigInterface;
use Nextstore\SyliusDropshippingCorePlugin\Model\ExchangeRateLog;
use Nextstore\SyliusDropshippingCorePlugin\Model\ExchangeRateLogInterface;
use Nextstore\SyliusDropshippingCorePlugin\Model\OnlineStore;
use Nextstore\SyliusDropshippingCorePlugin\Model\OnlineStoreImage;
use Nextstore\SyliusDropshippingCorePlugin\Model\OnlineStoreImageInterface;
use Nextstore\SyliusDropshippingCorePlugin\Model\OnlineStoreInterface;
use Nextstore\SyliusDropshippingCorePlugin\Factory\Currency\ExchangeRateLogFactory;
use Nextstore\SyliusDropshippingCorePlugin\Repository\Config\ConfigRepository;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\Factory\Factory;

final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('nextstore_sylius_dropshipping_core');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM)->end()
            ->end();

        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addResourcesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('config')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(Config::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ConfigInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(ConfigRepository::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                        ->scalarNode('form')->defaultValue(ConfigType::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('online_store')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(OnlineStore::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(OnlineStoreInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                        ->scalarNode('form')->defaultValue(OnlineStoreType::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('online_store_image')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(OnlineStoreImage::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(OnlineStoreImageInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                        ->scalarNode('form')->defaultValue(OnlineStoreImageType::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('exchange_rate_log')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(ExchangeRateLog::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ExchangeRateLogInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(ExchangeRateLogFactory::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
