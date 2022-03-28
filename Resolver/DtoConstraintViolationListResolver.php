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

namespace CodeLab\DtoBundle\Resolver;

use CodeLab\DtoBundle\Validator\DtoConstraintViolationList;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class DtoConstraintViolationListResolver
 * @package CodeLab\DtoBundle\Resolver
 */
class DtoConstraintViolationListResolver implements ArgumentValueResolverInterface
{

     /**
      * @param DtoResolversStorage $dtoResolversStorage
      * @param ValidatorInterface  $validator
      */
     public function __construct(private DtoResolversStorage $dtoResolversStorage, private ValidatorInterface $validator)
     {
     }


     /**
      * @param Request          $request
      * @param ArgumentMetadata $argument
      * @return bool
      */
     public function supports(Request $request, ArgumentMetadata $argument): bool
     {
          return $argument->getType() === DtoConstraintViolationList::class
               && null !== $this->dtoResolversStorage->getDto();
     }

     /**
      * @param Request          $request
      * @param ArgumentMetadata $argument
      * @return iterable
      */
     public function resolve(Request $request, ArgumentMetadata $argument): iterable
     {
          yield new DtoConstraintViolationList(
               $this->validator->validate($this->dtoResolversStorage->getDto())
          );
     }

}
