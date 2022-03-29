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

namespace Esidor\DtoBundle\Validator;

use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class DtoConstraintViolationList
 * @package Esidor\DtoBundle\Validator
 */
class DtoConstraintViolationList
{

     /**
      * @param ConstraintViolationList $constraintViolationList
      */
     public function __construct(private ConstraintViolationList $constraintViolationList)
     {
     }

     /**
      * Check if resolved DTO is valid
      *
      * @return bool
      */
     public function isValid(): bool
     {
          return $this->constraintViolationList->count() === 0;
     }

     /**
      * Normalize errors to array format
      *
      * @return array
      */
     public function toArray(): array
     {
          if ($this->isValid()) {
               return [];
          }

          $result = [];

          foreach ($this->constraintViolationList as $violation) {
               $path = $violation->getPropertyPath();
               preg_match_all("/\[[^]]*]/", $path, $brackets);

               foreach ($brackets as $oneLevelBrackets) {
                    foreach ($oneLevelBrackets as $element) {
                         $elementValue = str_replace(['[', ']'], '', $element);
                         $path = str_replace($element, ".{$elementValue}.", $path);
                    }
               }

               if ($path[strlen($path) - 1] === '.') {
                    $path = substr_replace($path, "", -1);
               }

               $this->setValue($result, $path, $violation->getMessage());
          }

          return $result;
     }

     /**
      * @param array  $arr
      * @param string $path
      * @param        $value
      * @return void
      */
     private function setValue(array &$arr, string $path, $value): void
     {
          $keys = explode('.', $path);

          foreach ($keys as $key) {
               $arr = &$arr['childs'][$key];
          }

          $arr['errors'][] = $value;
     }

}
