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

use Esidor\DtoBundle\Caster\CasterInterface;
use Esidor\DtoBundle\Caster\DatetimeCaster;
use Esidor\DtoBundle\Caster\DtoArrayCaster;
use Esidor\DtoBundle\Caster\DtoCaster;
use Esidor\DtoBundle\Object\AbstractDto;
use Error;
use Exception;
use Generator;
use ReflectionAttribute;
use ReflectionNamedType;
use ReflectionProperty;

/**
 * Class DtoReflectionProperty
 * @package Esidor\DtoBundle\Reflection
 */
class DtoReflectionProperty
{
     /**
      * Base caster classes
      *
      * @var string[]
      */
     private static $internalCasters = [
          DatetimeCaster::class,
          DtoCaster::class,
          DtoArrayCaster::class,
     ];

     /**
      * @param AbstractDto        $dto
      * @param ReflectionProperty $reflectionProperty
      */
     public function __construct(private AbstractDto $dto, private ReflectionProperty $reflectionProperty)
     {
     }

     /**
      * Set property value
      *
      * @param mixed $args
      * @return void
      */
     public function setValue(mixed $args)
     {
          $caster = $this->resolveCaster();
          $value = $this->resolveValue($caster, $args);

          try {
               $this->reflectionProperty->setValue(
                    $this->dto,
                    $value
               );
          } catch (Error|Exception $error) {
          }
     }

     /**
      * Resolve value by specified caster and arguments
      *
      * @param CasterInterface|null $caster
      * @param mixed                $args
      * @return mixed
      */
     public function resolveValue(?CasterInterface $caster, mixed $args): mixed
     {
          return $caster ? $caster->cast($args) : $args;
     }

     /**
      * Get reflected property name
      *
      * @return string
      */
     public function getPropertyName(): string
     {
          return $this->reflectionProperty->getName();
     }

     /**
      * Resolve caster class for current property
      *
      * @return CasterInterface|null
      */
     protected function resolveCaster(): ?CasterInterface
     {
          $types = $this->getTypes();

          foreach ($types as $oneType) {
               if ($caster = $this->resolveCasterByType($oneType)) {
                    return $caster;
               }
          }

          return null;
     }

     /**
      * Resolve caster class by property type
      *
      * @param string $type
      * @return CasterInterface|null
      */
     public function resolveCasterByType(string $type): ?CasterInterface
     {
          foreach ($this->getCasterClasses() as $casterClass) {

               /**
                * @var CasterInterface $caster
                */
               $caster = new $casterClass($type, $this);

               if ($caster->supports($type)) {
                    return $caster;
               }
          }

          return null;
     }

     /**
      * Get caster classes
      * @return Generator
      */
     protected function getCasterClasses(): Generator
     {
          foreach (static::$internalCasters as $casterClass) {
               yield $casterClass;
          }
     }

     /**
      * Get attribute from property
      *
      * @param string $name
      * @return ReflectionAttribute
      */
     public function getAttribute(string $name): ReflectionAttribute
     {
          return current($this->reflectionProperty->getAttributes($name));
     }

     /**
      * Get allowed types for current property
      *
      * @return array
      */
     private function getTypes(): array
     {
          return match (get_class($this->reflectionProperty->getType())) {
               ReflectionNamedType::class => [$this->reflectionProperty->getType()->getName()]
          };
     }
}
