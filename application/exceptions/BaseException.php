<?php


namespace app\exceptions;


class BaseException extends \Exception
{
    protected  $errorCode;
    public function __construct(string $message , int $code , Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

}