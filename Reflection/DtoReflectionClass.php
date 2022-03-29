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

namespace Esidor\DtoBundle\Reflection;

use Esidor\DtoBundle\Object\AbstractDto;
use ReflectionClass;
use ReflectionProperty;

/**
 * Helper logic for DTO class reflection
 *
 * Class DtoReflectionClass
 * @package Esidor\DtoBundle\Reflection
 */
class DtoReflectionClass
{

     /**
      * @var ReflectionClass
      */
     private $reflectionClass;

     /**
      * @param AbstractDto $dto
      */
     public function __construct(private AbstractDto $dto)
     {
          $this->reflectionClass = new ReflectionClass($this->dto);
     }

     /**
      * Return public properties from dto class
      *
      * @return DtoReflectionProperty[]
      */
     public function getProperties(): array
     {
          return array_map(
               function (ReflectionProperty $property) {
                    return new DtoReflectionProperty($this->dto, $property);
               },
               $this->reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC)
          );
     }

}
