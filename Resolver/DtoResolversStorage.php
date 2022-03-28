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

namespace CodeLab\DtoBundle\Resolver;

use CodeLab\DtoBundle\Object\AbstractDto;

/**
 * Class DtoResolversStorage
 * @package CodeLab\DtoBundle\Resolver
 */
class DtoResolversStorage
{

     /**
      * @var AbstractDto|null
      */
     private ?AbstractDto $dto;

     /**
      * @return AbstractDto|null
      */
     public function getDto(): ?AbstractDto
     {
          return $this->dto;
     }

     /**
      * @param AbstractDto $dto
      */
     public function setDto(AbstractDto $dto): void
     {
          $this->dto = $dto;
     }



}
