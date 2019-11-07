<?php


namespace app\exceptions\handler;


use app\exceptions\BaseException;
use think\exception\Handle;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    // 还需要返回客户端当前请求的url路径
    public function render(Exception $e)
    {
        echo '不知道是什么异常发生了......';
        if ($e instanceof BaseException) {
            // 自定义的异常
            $this->code = $e->getCode();
            $this->msg = $e->getMessage();
            $this->errorCode = $e->getErrorCode();
        } else {
            //其他异常
            if( config('app_debug') ){//开启调试，开发环境
                return parent::render($e);
            } else {//不开启调试，生产环境
                $this->code = 500;
                $this->msg = "服务器内部错误";
                $this->errorCode = 999;
                $this->recordErrorlog($e);
            }
            /**
             *  //其他异常
            if( config('app_debug') ){
            return parent::render($e);
            } else {
             * header("location:".url('home/error/index'));
             * }
             * $log = "[{$data['code']}]{$data['message']}[{$data['file']}:{$data['line']}]";
             * Log::record($log, 'error');
             */
        }
        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request->url()
        ];
        return json($result, $this->code);
    }

    private function recordErrorlog(Exception $e)
    {
        Log::init([
            'type' => 'File',
            'path' => LOG_PATH,
            'level' => ['error']
        ]);
        Log::record($e->getMessage(), 'error');
    }
}