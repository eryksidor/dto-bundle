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

namespace Esidor\DtoBundle\Object;


use Esidor\DtoBundle\Reflection\DtoReflectionClass;

/**
 * Base DTO class
 *
 * Class AbstractDto
 * @package Esidor\DtoBundle\Object
 */
abstract class AbstractDto
{

     /**
      * @param array $args
      */
     public function __construct(mixed $args)
     {
          $reflectionClassHelper = new DtoReflectionClass($this);

          foreach ($reflectionClassHelper->getProperties() as $property){
               $value = $args[$property->getPropertyName()] ?? $this->{$property->getPropertyName()} ?? null;

               $property->setValue($value);
          }
     }


}
