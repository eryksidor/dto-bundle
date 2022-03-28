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

use CodeLab\DtoBundle\Attributes\DtoArray;
use CodeLab\DtoBundle\Exception\DtoObjectResolvingException;

/**
 * Class DtoArrayCaster
 * @package CodeLab\DtoBundle\Caster
 */
class DtoArrayCaster extends AbstractCaster implements CasterInterface
{

     /**
      * @param string $type
      * @return bool
      */
     public function supports(string $type): bool
     {
          return $type === 'array';
     }

     /**
      * @param mixed $args
      * @return mixed
      * @throws DtoObjectResolvingException
      */
     public function cast(mixed $args): mixed
     {
          $result = [];

          if(empty($args) || !is_array($args)){
               return $result;
          }

          $key = 0;
          foreach ($args as $arg){
               $attribute = $this->dtoReflectionProperty->getAttribute(DtoArray::class);
               if(empty($attribute)){
                    throw new DtoObjectResolvingException();
               }

               /**
                * @var DtoArray $dtoArrayAttribute
                */
               $dtoArrayAttribute = $attribute->newInstance();

               $caster = $this->dtoReflectionProperty->resolveCasterByType($dtoArrayAttribute->getType());

               $result[$key] = $this->dtoReflectionProperty->resolveValue($caster, $arg);

               $key++;
          }

          return $result;
     }

}
