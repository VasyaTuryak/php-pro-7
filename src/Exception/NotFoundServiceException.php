<?php

use Psr\Container\NotFoundExceptionInterface;

class NotFoundServiceException extends \Exception implements NotFoundExceptionInterface
{
}
//
//class NotFoundService extends Exception implements NotFoundExceptionInterface{
//
//    public function getMessage(): string
//    {
//        // TODO: Implement getMessage() method.
//    }
//
//    public function getCode()
//    {
//        // TODO: Implement getCode() method.
//    }
//
//    public function getFile(): string
//    {
//        // TODO: Implement getFile() method.
//    }
//
//    public function getLine(): int
//    {
//        // TODO: Implement getLine() method.
//    }
//
//    public function getTrace(): array
//    {
//        // TODO: Implement getTrace() method.
//    }
//
//    public function getTraceAsString(): string
//    {
//        // TODO: Implement getTraceAsString() method.
//    }
//
//    public function getPrevious(): ?Throwable
//    {
//        // TODO: Implement getPrevious() method.
//    }
//
//    public function __toString():string
//    {
//        // TODO: Implement __toString() method.
//    }
//}