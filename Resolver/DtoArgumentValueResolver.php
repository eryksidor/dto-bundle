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

use CodeLab\DtoBundle\Object\AbstractDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * Class DtoArgumentValueResolver
 * @package CodeLab\DtoBundle\Resolver
 */
class DtoArgumentValueResolver implements ArgumentValueResolverInterface
{
     /**
      * @param DtoResolversStorage $dtoResolversStorage
      */
     public function __construct(private DtoResolversStorage $dtoResolversStorage)
     {
     }


     /**
      * @param Request          $request
      * @param ArgumentMetadata $argument
      * @return bool
      */
     public function supports(Request $request, ArgumentMetadata $argument): bool
     {
          return class_exists($argument->getType()) && is_subclass_of($argument->getType(), AbstractDto::class);
     }

     /**
      * @param Request          $request
      * @param ArgumentMetadata $argument
      * @return iterable
      */
     public function resolve(Request $request, ArgumentMetadata $argument): iterable
     {
          $className = $argument->getType();

          $dto = new $className($request->toArray());

          $this->dtoResolversStorage->setDto($dto);

          yield $dto;
     }

}
