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

namespace CodeLab\DtoBundle\Exception;

use Exception;
use Throwable;

/**
 * Class DtoObjectResolvingException
 * @package CodeLab\DtoBundle\Exception
 */
class DtoObjectResolvingException extends Exception
{

     /**
      * @param string         $message
      * @param int            $code
      * @param Throwable|null $previous
      */
     public function __construct(string $message = "Error during resolving DTO object", int $code = 0, ?Throwable $previous = null)
     {
          parent::__construct($message, $code, $previous);
     }


}
