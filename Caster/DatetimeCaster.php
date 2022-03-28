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

use DateTime;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Class DatetimeCaster
 * @package CodeLab\DtoBundle\Caster
 */
class DatetimeCaster extends AbstractCaster implements CasterInterface
{

     /**
      * @param string $type
      * @return bool
      */
     public function supports(string $type): bool
     {
          return $type === DateTime::class;
     }

     /**
      * @param mixed $args
      * @return DateTime|null
      * @throws \Exception
      */
     public function cast(mixed $args): ?DateTime
     {
          if(empty($args)){
               return null;
          }

          return new DateTime($args);
     }


}
