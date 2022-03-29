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

use Esidor\DtoBundle\Object\AbstractDto;

/**
 * Class DtoCaster
 * @package Esidor\DtoBundle\Caster
 */
class DtoCaster extends AbstractCaster implements CasterInterface
{
     /**
      * @param string $type
      * @return bool
      */
     public function supports(string $type): bool
     {
          return is_subclass_of($type, AbstractDto::class);
     }

     /**
      * @param mixed $args
      * @return mixed
      */
     public function cast(mixed $args): mixed
     {
          return new $this->targetType($args);
     }


}
