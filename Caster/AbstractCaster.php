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


namespace Esidor\DtoBundle\Caster;

use Esidor\DtoBundle\Reflection\DtoReflectionProperty;

/**
 * Class AbstractCaster
 * @package Esidor\DtoBundle\Caster
 */
abstract class AbstractCaster
{

     /**
      * @param string                $targetType
      * @param DtoReflectionProperty $dtoReflectionProperty
      */
     public function __construct(protected string $targetType, protected DtoReflectionProperty $dtoReflectionProperty){

     }

}
