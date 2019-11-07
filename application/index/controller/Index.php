<?php
namespace app\index\controller;



use app\exceptions\ParamException;
use think\Exception;

class Index
{
    private $client_id = 'YXA6_ZcfsJtBEemw8oHuFF6puw';
    private $client_secret = 'YXA6ha-TF635wlOUQuvA7NNrlSK0LlA';
    private $org_name;
    private $app_name;
    private $url;

    public function __construct()
    {
        $options = [];
        $this->client_id = isset ($options ['client_id']) ? $options ['client_id'] : 'YXA6Irz_oI-GEead-FFvbfaMbQ';
        $this->client_secret = isset ($options ['client_secret']) ? $options ['client_secret'] : 'YXA6VsR5JypETS3iPFvNNxYklmho0Vw';
        $this->org_name = isset ($options ['org_name']) ? $options ['org_name'] : '1122161011178276';
        $this->app_name = isset ($options ['app_name']) ? $options ['app_name'] : 'testapp';
        if (!empty ($this->org_name) && !empty ($this->app_name)) {
            $this->url = 'https://a1.easemob.com/' . $this->org_name . '/' . $this->app_name . '/';
        }
    }

    function getToken()
    {
        //YXA6_ZcfsJtBEemw8oHuFF6puw
        //YXA6ha-TF635wlOUQuvA7NNrlSK0LlA
//        $options = array(
//            "grant_type" => "client_credentials",
//            "client_id" => $this->client_id,
//            "client_secret" => $this->client_secret
//        );
        $options = array(
            "grant_type" => "client_credentials",
            "client_id" => "YXA6_ZcfsJtBEemw8oHuFF6puw",
            "client_secret" => "YXA6ha-TF635wlOUQuvA7NNrlSK0LlA"
        );
        //json_encode()函数，可将PHP数组或对象转成json字符串，使用json_decode()函数，可以将json字符串转换为PHP数组或对象
        $body = json_encode($options);
        //使用 $GLOBALS 替代 global
        $url = $this->url . 'token';
        //$url=$base_url.'token';
        $tokenResult = $this->postCurl($url, $body, $header = array());
        //var_dump($tokenResult['expires_in']);
        //return $tokenResult;
        return "Authorization:Bearer " . $tokenResult['access_token'];

    }
    public function sendTxt(){
        /**
         * receiveId    接收人如果是群组的话就传群组环信id
         * msg  内容
         * type 内容类型 1-文本 2-图片 3-语音 4-视频 5-命令
         * chatType 0单聊 1群聊
         * fromType 发起方角色类型 1客服 2客户 3经销商
         * fromId
         * toType   接收方角色类型 1客服 2客户 3经销商 4群组
         */
        $body = array();
        $url = 'http://127.0.0.1:8087/conversation/sendMessage';
        $body['fromId'] = "breast_operator_192";
        $body['receiveId'] = "breast_operator_182";
        $body['fromType'] = 1;
        $body['chatType'] = 0;
        $body['type'] = 1;
        $body['toType'] = 2;
        $body['msg'] = "sdfhsdfgs345r34";
        $header = array('Content-Type: application/x-www-form-urlencoded');
        $result = $this->postCurl($url,http_build_query($body),$header);
        return $result;
    }
    public function hello( )
    {
        /*$path = $_FILES['upfile']['name'];//string(9) "asdfa.mp4" 户端上传文件的原名称，不包含路径
        $path2 = $_FILES['upfile']['type'];//string(9) "video/mp4" 上传文件的MIME类型  
        $path3 = $_FILES['upfile']['tmp_name'];//string(31) "D:\php\wamp\php\tmp\php59AD.tmp"
        $path4 = $_FILES['upfile']['error'];//int(0) 上传文件出现的错误号，为一个整数
        $path5 = $_FILES['upfile']['size'];//int(5978048) 已上传文件的大小，单位为字节*/
        try{
            $tmp = $_FILES['upfile']['tmp_name'];
            if($tmp)
                $res = $this->uploadFile($tmp);
            dump($res);
        }catch(Exception $e){
            echo '发生异常了';
        }


//        $res = file_get_contents('D:/servers/wamp/Apache24/htdocs/bike/public/upload/timg.jpg');
        /*if($file){

        }*/
        die();
        dump($res);
        /*$filepath = 'photo/';
        if(move_uploaded_file($tmp,$filepath.$imgname.".png")){
            echo "上传成功";
        }else{
            echo "上传失败";
        }*/
    }
    public function index()
    {
//        if(true)    $a = 1/0;
//            throw  new ParamException("参数不存在",400);
        //$filePath
//      $token = $this->getToken();
//      echo $token;
        echo 'hello22';
        $res = $this->sendTxt();
        dump($res);
//        echo $res;
        return view('index@index\index');
    }

    /**
     * @param $url  请求的URL
     * @param $body     请求参数，如果是传JSON要先转JSON，如果传form-data先http_build_query再传
     * @param $header   需要什么头自己传值进来，例如array('Content-Type: application/x-www-form-urlencoded')
     * @param string $type  请求类型 :POST PUT GET DELETE
     * @return bool|mixed|string
     */
    function postCurl($url, $body, $header, $type = "POST")
    {

        $ch = curl_init(); //1.创建一个curl资源
        curl_setopt($ch, CURLOPT_URL, $url);//2.设置URL和相应的选项
        //1)设置请求头,是否需要携带请求头
//        array_push($header, 'http:multipart/form-data');
//        array_push($header, 'Content-Type: multipart/form-data');
//        array_push($header,'Content-Type:application/json');
//        array_push($header,'Content-Type: application/x-www-form-urlencoded');
        //设置为false,只会获得响应的正文(true的话会连响应头一并获取到)
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);//设置发起连接前的等待时间，如果设置为0，则无限等待。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
        //2)设备请求体
        if (count($body) > 0)
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);//全部数据使用HTTP协议中的"POST"操作来发送。
        //设置请求头
        if (count($header) > 0)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //上传文件相关设置
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);// 从证书中检查SSL加密算
        //3)设置提交方式
        switch ($type) {
            case "GET":
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case "POST":
                curl_setopt($ch, CURLOPT_POST, true);
                break;
            case "PUT"://使用一个自定义的请求信息来代替"GET"或"HEAD"作为HTTP请求。这对于执行"DELETE" 或者其他更隐蔽的HTT
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case "DELETE":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
        }
        //4)在HTTP请求中包含一个"User-Agent: "头的字符串。-----必设
//        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)'); // 模拟用户使用的浏览器
        curl_setopt($ch, CURLOPT_USERAGENT, 'SSTS Browser/1.0');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        $res = curl_exec($ch);
        /*if (curl_errno($ch)) {
            echo 'Errno'.curl_error($ch);
        }*/
       /* if (false == $result2['data']['state']) {
            $error = curl_error($ch);
            dump($error);
            die('11111');
//            throw new Exception(curl_error($ch),curl_errno($ch));
        }*/
        $result = json_decode($res, true);
        curl_close($ch);//4.关闭curl资源，并且释放系统资源
        if (empty($result))
            return $res;
        else
            return $result;
        /**
        //获取错误编码
        //关闭URL请求
        curl_close($curl);
        $result = json_decode($output, true);
        $result['curl_status'] = 1;
        $result['curl_message'] = '';
        } catch (\Exception $e) {
        $result['curl_status'] = 0;
        $result['curl_message'] = $e->getMessage();
        }
        return $result;
         */
    }
    //POST提交 $url, $body, $header, $type = "POST"
/*    public function postReq($url,$data){
        $headers = array('Content-Type: application/x-www-form-urlencoded');
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data)); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话
        return $result;
    }*/

    //上传图片或文件
    function uploadFile($filePath)
    {
        $url = $this->url . 'chatfiles';
        $file = file_get_contents($filePath);
        $body['file'] = $file;
        $token = $this->getToken();
        echo $token;
        $header = array('enctype:multipart/form-data', $token, "restrict-access:true");
        $result = $this->postCurl($url, $body, $header, 'XXX');
        return $result;

    }
     //下载文件或图片
    function downloadFile($uuid, $shareSecret)
    {
        $url = $this->url . 'chatfiles/' . $uuid;
        $header = array("share-secret:" . $shareSecret, "Accept:application/octet-stream", $this->getToken());
        $result = $this->postCurl($url, '', $header, 'GET');
        $filename = md5(time() . mt_rand(10, 99)) . ".png"; //新图片名称
        if (!file_exists("resource/down")) {
            //mkdir("../image/down");
            mkdirs("resource/down/");
        }
        $file = @fopen("resource/down/" . $filename, "w+");//打开文件准备写入
        @fwrite($file, $result);//写入
        fclose($file);//关闭
        return $filename;

    }
     //下载图片缩略图
    function downloadThumbnail($uuid, $shareSecret)
    {
        $url = $this->url . 'chatfiles/' . $uuid;
        $header = array("share-secret:" . $shareSecret, "Accept:application/octet-stream", $this->getToken(), "thumbnail:true");
        $result = $this->postCurl($url, '', $header, 'GET');
        $filename = md5(time() . mt_rand(10, 99)) . "th.png"; //新图片名称
        if (!file_exists("resource/down")) {
            //mkdir("../image/down");
            mkdirs("resource/down/");
        }
        $file = @fopen("resource/down/" . $filename, "w+");//打开文件准备写入
        @fwrite($file, $result);//写入
        fclose($file);//关闭
        return $filename;
    }

    //--------------------------------------------------------发送消息
    /*
        发送文本消息
    */
    function sendText($from = "admin", $target_type, $target, $content, $ext)
    {
        $url = $this->url . 'messages';
        $body['target_type'] = $target_type;
        $body['target'] = $target;
        $options['type'] = "txt";
        $options['msg'] = $content;
        $body['msg'] = $options;
        $body['from'] = $from;
        $body['ext'] = $ext;
        $b = json_encode($body);
        $header = array($this->getToken());
        $result = $this->postCurl($url, $b, $header);
        return $result;
    }

    /*
        发送透传消息
    */
    function sendCmd($from = "admin", $target_type, $target, $action, $ext)
    {
        $url = $this->url . 'messages';
        $body['target_type'] = $target_type;
        $body['target'] = $target;
        $options['type'] = "cmd";
        $options['action'] = $action;
        $body['msg'] = $options;
        $body['from'] = $from;
        $body['ext'] = $ext;
        $b = json_encode($body);
        $header = array($this->getToken());
        //$b=json_encode($body,true);
        $result = $this->postCurl($url, $b, $header);
        return $result;
    }

    /*
        发图片消息
    */
    function sendImage($filePath, $from = "admin", $target_type, $target, $filename, $ext)
    {
        $result = $this->uploadFile($filePath);
        $uri = $result['uri'];
        $uuid = $result['entities'][0]['uuid'];
        $shareSecret = $result['entities'][0]['share-secret'];
        $url = $this->url . 'messages';
        $body['target_type'] = $target_type;
        $body['target'] = $target;
        $options['type'] = "img";
        $options['url'] = $uri . '/' . $uuid;
        $options['filename'] = $filename;
        $options['secret'] = $shareSecret;
        $options['size'] = array(
            "width" => 480,
            "height" => 720
        );
        $body['msg'] = $options;
        $body['from'] = $from;
        $body['ext'] = $ext;
        $b = json_encode($body);
        $header = array($this->getToken());
        //$b=json_encode($body,true);
        $result = $this->postCurl($url, $b, $header);
        return $result;
    }

    /*
        发语音消息
    */
    function sendAudio($filePath, $from = "admin", $target_type, $target, $filename, $length, $ext)
    {
        $result = $this->uploadFile($filePath);
        $uri = $result['uri'];
        $uuid = $result['entities'][0]['uuid'];
        $shareSecret = $result['entities'][0]['share-secret'];
        $url = $this->url . 'messages';
        $body['target_type'] = $target_type;
        $body['target'] = $target;
        $options['type'] = "audio";
        $options['url'] = $uri . '/' . $uuid;
        $options['filename'] = $filename;
        $options['length'] = $length;
        $options['secret'] = $shareSecret;
        $body['msg'] = $options;
        $body['from'] = $from;
        $body['ext'] = $ext;
        $b = json_encode($body);
        $header = array($this->getToken());
        //$b=json_encode($body,true);
        $result = $this->postCurl($url, $b, $header);
        return $result;
    }

    /*
        发视频消息
    */
    function sendVedio($filePath, $from = "admin", $target_type, $target, $filename, $length, $thumb, $thumb_secret, $ext)
    {
        $result = $this->uploadFile($filePath);
        $uri = $result['uri'];
        $uuid = $result['entities'][0]['uuid'];
        $shareSecret = $result['entities'][0]['share-secret'];
        $url = $this->url . 'messages';
        $body['target_type'] = $target_type;
        $body['target'] = $target;
        $options['type'] = "video";
        $options['url'] = $uri . '/' . $uuid;
        $options['filename'] = $filename;
        $options['thumb'] = $thumb;
        $options['length'] = $length;
        $options['secret'] = $shareSecret;
        $options['thumb_secret'] = $thumb_secret;
        $body['msg'] = $options;
        $body['from'] = $from;
        $body['ext'] = $ext;
        $b = json_encode($body);
        $header = array($this->getToken());
        //$b=json_encode($body,true);
        $result = $this->postCurl($url, $b, $header);
        return $result;
    }

    /*
    发文件消息
    */
    function sendFile($filePath, $from = "admin", $target_type, $target, $filename, $length, $ext)
    {
        $result = $this->uploadFile($filePath);
        $uri = $result['uri'];
        $uuid = $result['entities'][0]['uuid'];
        $shareSecret = $result['entities'][0]['share-secret'];
        $url = $GLOBALS['base_url'] . 'messages';
        $body['target_type'] = $target_type;
        $body['target'] = $target;
        $options['type'] = "file";
        $options['url'] = $uri . '/' . $uuid;
        $options['filename'] = $filename;
        $options['length'] = $length;
        $options['secret'] = $shareSecret;
        $body['msg'] = $options;
        $body['from'] = $from;
        $body['ext'] = $ext;
        $b = json_encode($body);
        $header = array(getToken());
        //$b=json_encode($body,true);
        $result = postCurl($url, $b, $header);
        return $result;
    }
}
