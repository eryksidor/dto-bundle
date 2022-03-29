<?php
declare(strict_types=1);

/*
 * This file is part of the DTO Bundle.
 *
 * (c) Eryk Sidor <eryksidor1403@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Esidor\DtoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class DtoExtension
 * @package Esidor\Dto\DependencyInjection
 */
class DtoExtension extends Extension
{
     /**
      * {@inheritdoc}
      */
     public function load(array $configs, ContainerBuilder $container)
     {
          $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
          $loader->load('services.yml');
     }
}
