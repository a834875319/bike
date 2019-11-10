<?php


namespace app\exceptions;


class ParamException extends BaseException
{
    protected  $code = 400;
    protected  $message = "参数错误";
    protected  $errorCode = 10000 ;
    public function __construct( $message = "",  $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    /**
     * @param int $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

}