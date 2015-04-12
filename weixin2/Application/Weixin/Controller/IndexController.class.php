<?php
namespace Weixin\Controller;
use Think\Controller;
use Common\ORG\Wechat;

class IndexController extends Controller {
	private $weixin;
	private $data;

	function __construct(){
		$config = array(
			'token' 		=>	'stonejin',
			'appid'			=>	'wxfab9ea830e2b78ef',
			'secret' 		=>	'baa942d26bc8dd44f0f8c31db2e5ee3c',
			'access_token'	=>	'',
			'debug'			=>	false,
			'encode'		=>	true,
			'aeskey' 		=>  'V4UGvsbddOXx8KwyLnVXoYUZr6RFOJpcBIqH4Slq0Oc'
		);
		$this->weixin = new Wechat($config);
	}

    public function index(){
		$errCode = $this->weixin->init();
		if($errCode != true)
		{
			trace(__FILE__."  [".__LINE__."]  ".'初始化失败');
			exit();
		}

		$errCode = $this->weixin->valid();
        if($errCode != true)
        {
        	trace(__FILE__."  [".__LINE__."]  ".'不合理');
        	exit();
        }

		$this->data = $this->weixin->request();
		if($errCode == null)
		{
			trace(__FILE__."  [".__LINE__."]  ".'获得数据失败');
			exit();
		}

		trace($this->data);
		$msgType = $this->data['msgtype'];
		if(empty($msgType))
		{
			trace(__FILE__."  [".__LINE__."]  ".'获得数据失败');
			exit();
		}

		switch ($msgType) {
			case 'event':
				break;
			default:
				$this->text();
				break;
		}
    }

    private function text(){
    	$this->response($this->data['content']);
    }

    /**
	 * 重写的消息回复方法
	 */
	private function response($content) {
		//$this->weixin->response($content);
		$this->weixin->response("<a href='http://121.40.224.245/weixin2/2/'>".$content."</a>");
	} 
}