<?php
declare(strict_types = 1);

/*
 * This file is part of the DTO Bundle.
 *
 * (c) Eryk Sidor <eryksidor1403@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Esidor\DtoBundle;

use Esidor\DtoBundle\DependencyInjection\DtoExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class DtoBundle
 * @package Esidor\DtoBundle
 */
class DtoBundle extends Bundle
{
     /**
      * @param ContainerBuilder $container
      * @return void
      */
     public function build(ContainerBuilder $container)
     {
          parent::build($container);
     }

     /**
      * @return ExtensionInterface|null
      */
     public function getContainerExtension(): ?ExtensionInterface
     {
          return new DtoExtension();
     }

}
