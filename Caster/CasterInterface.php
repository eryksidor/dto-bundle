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


namespace CodeLab\DtoBundle\Caster;

use CodeLab\DtoBundle\Reflection\DtoReflectionProperty;

/**
 * Interface CasterInterface
 * @package CodeLab\DtoBundle\Caster
 */
interface CasterInterface
{

     /**
      * @param string                $targetType
      * @param DtoReflectionProperty $dtoReflectionProperty
      */
     public function __construct(string $targetType, DtoReflectionProperty $dtoReflectionProperty);

     /**
      * Check if class should be used
      *
      * @param string $type
      * @return bool
      */
     public function supports(string $type): bool;

     /**
      * Cast params to final result
      *
      * @param mixed $args
      * @return mixed
      */
     public function cast(mixed $args): mixed;

}
