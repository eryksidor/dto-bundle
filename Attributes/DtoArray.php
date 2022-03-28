<?php

/*
 * This file is part of the DTO Bundle.
 *
 * (c) Eryk Sidor <eryksidor1403@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeLab\DtoBundle\Attributes;

use Attribute;
use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;

/**
 * Define caster type for every array element of property
 *
 * @Annotation
 * @NamedArgumentConstructor()
 * @Target("CLASS")
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class DtoArray
{

     /**
      * @param string $type
      */
     public function __construct(private string $type)
     {
     }

     /**
      * @return string
      */
     public function getType(): string
     {
          return $this->type;
     }



}
