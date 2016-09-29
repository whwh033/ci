<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wx extends CI_Controller {

	public function index()
	{
		$this->load->library('wechat');
		$wx = $this->wechat;
		$data = $wx->getRev();
		$type = $data->getRevType();
		log_message('error', var_export($data,true));
		switch($type) {
			case Wechat::MSGTYPE_TEXT:
				$data->text("hello, I'm wechat123123123")->reply();
				exit;
				break;
			case Wechat::MSGTYPE_EVENT:
				break;
			case Wechat::MSGTYPE_IMAGE:
				break;
			default:
				$data->text("help info")->reply();
		}
	}

	public function getTemp(){
		$url = "https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=".$this->getAccessToken();
		$ret = file_get_contents($url);
//		$data = array(
//			'template_id_short' => 'b_hQIynOFbeLinsslrzcOwXGB3mYgZ3kImCspIoc4z4',
//		);
//		$ret = $this->vCurlPost($url,$data);
		print_r(json_decode($ret, true));

	}

	public function setTempList(){
		$this->load->library('redisdb',array('key' => 'quan'));
		$redis = $this->redisdb;
		$data = array(
			'touser' => 'oQL2jvzN9KjWnD1-tEHkbU0s7G0c',
			'template_id' => '6Cg5WBmUSAK3uP1UdBqsG3fPjDQiS7KRDffEuiCS_5w',
			'url' => 'http://baidu.com',
			'title' => '123123',
			'data' => array(
				'name' => array(
					'value' => '测试',
					'color' => '#173177',
				),
				"remark" => array(
					'value' => "测试111\n欢迎购买!",
					'color' => "#173177",
				),

			),
		);
		$redis->lPush("wx_temp_list",$data);
	}




	public function send(){
		$this->load->library('redisdb',array('key' => 'quan'));
		$redis = $this->redisdb;
		while(true){
			$data = $redis->rPop("wx_temp_list");
			if($data){
				$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$redis->get("token");
				$ret = $this->vCurlPost($url, json_encode($data,JSON_UNESCAPED_UNICODE));
				log_message('error', "wx_temp_list".$ret);
			}else{
				sleep(5);
			}
		}

	}


	public function getAccessToken(){
		$params = array('key' => 'quan');
		$this->load->library('redisdb',$params);
		$token = $this->redisdb->get("token");
		if($token){
			return $token;
		}
		return '';
	}
	
	function getToken(){
		$this->config->load('redis', TRUE);
		$params = array('key' => 'quan');
		$this->load->library('redisdb',$params);
		$wxConfig = $this->config->item('redis')['wx'];
		$accessTokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wxConfig['appid']}&secret=".$wxConfig['appsecret'];
		$accessToken = json_decode(file_get_contents($accessTokenUrl), true);
		if(isset($accessToken['errcode']) && $accessToken['errcode']){
			return $accessToken['errcode'];
		}
		$key = "token";
		$this->redisdb->set($key,$accessToken['access_token']);
		return $accessToken['access_token'];
	}

	function getTemplete(){
		$url = "https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=JSXcINSpKD-1Wf1BM96Xhjhiw_XScj9m381j5qVVX7YcdrKPRQnZQ3HBqbTObLJvBYX_uIZWIhzMJCBxIGli-EGaVS0Eis6sp3QsnjPxmLdylP2HamOIO7K-eYzzCr_TXRVcAGANHL";
		$ret = file_get_contents($url);
		var_dump($ret);
	}

	function setTemplete(){
		$url = "https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=JSXcINSpKD-1Wf1BM96Xhjhiw_XScj9m381j5qVVX7YcdrKPRQnZQ3HBqbTObLJvBYX_uIZWIhzMJCBxIGli-EGaVS0Eis6sp3QsnjPxmLdylP2HamOIO7K-eYzzCr_TXRVcAGANHL";
		$data = array(
			'industry_id1' => 1,
			'industry_id2' => 10,
		);
		$ret = $this->vCurlPost($url, $data);
		var_dump($ret);

	}

	function vCurlPost($url, $data){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

	public function sms($m){
		$params = array('key' => 'sms');
		$this->load->library('redisdb',$params);
		$redis = $this->redisdb;
		$key = "send_sms_list";
		$data = array(
			'title' => '注册验证',
			'code' => 111111,
			'mobile' => $m,
			'temp_id' => 'SMS_5445049',
		);
		$redis->lPush($key, $data);
	}

	public function send_sms(){
		require_once dirname(dirname(__FILE__)).'/libraries'.'/Taobao'.'/TopSdk.php';
		$c = new TopClient;
		$this->config->load('sms', TRUE);
		$params = array('key' => 'sms');
		$this->load->library('redisdb',$params);
		$redis = $this->redisdb;
		$config = $this->config->item('sms');
		$c->appkey = $config['appkey'];
		$c->secretKey = $config['secretKey'];
		$req = new AlibabaAliqinFcSmsNumSendRequest;
		$req->setSmsType("normal");

		while(true){
			$data = $redis->rPop("send_sms_list");
			if($data){
				$req->setSmsFreeSignName($data['title']);
				$req->setSmsParam("{\"code\":\"{$data['code']}\",\"product\":\"施意网\"}");
				$req->setRecNum($data['mobile']);
				$req->setSmsTemplateCode($data['temp_id']);
				$ret = $c->execute($req);
				log_message('error', "send_sms_list".json_encode($ret));
			}else{
				sleep(5);
			}
		}
	}
	
	
	public function sends(){
			$msg = '截止'.$date = date('d日H:i').',您尚有6个订单未处理。';
			//$access_token = getInstance('wxbase')->access_token()['access_token'];
			$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=6Zck6hoQfc36qRPNZ7u6j0lVUZVnUJmw4HJnn3SD0WlKc-WPNYlg94HIt0bpYFXgnoiTT6seSetG7u3tkBpFX5ypauTXxpDxSeQeN_-iprWbzgznUY3mWNEkFeHlGtb1PMCdADAJGW";
			$data = array(
				'touser' => "oQL2jvzN9KjWnD1-tEHkbU0s7G0c",
				'template_id' => 'z-6njlazZzVjkcAXfG8Qbz0_cm9Ke5eRe24Mu7wTOIo',
				'url' => 'http://baidu.com',
				'data' => array(
					'first' => array(
						'value' => '您收到了一条新的订单。',
						'color' => '#173177',
					),
					'tradeDateTime' => array(
						'value' => date('Y-m-d'),
						'color' => '#173177',
					),
					'orderType' => array(
						'value' => '消费者预定',
						'color' => '#173177',
					),
					'customerInfo' => array(
						'value' => "施意",
						'color' => '#173177',
					),
					'orderItemName' => array(
						'value' => '商品名称',
						'color' => '#173177',
					),
					'orderItemData' => array(
						'value' => "商品111",
						'color' => '#173177',
					),
					'remark' => array(
						'value' => $msg,
						'color' => '#173177',
					),
				),
			);
			$ret = $this->vCurlPost($url, json_encode($data,JSON_UNESCAPED_UNICODE));
			var_dump($ret);
	}
	
	public function sendTest(){
		$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=6Zck6hoQfc36qRPNZ7u6j0lVUZVnUJmw4HJnn3SD0WlKc-WPNYlg94HIt0bpYFXgnoiTT6seSetG7u3tkBpFX5ypauTXxpDxSeQeN_-iprWbzgznUY3mWNEkFeHlGtb1PMCdADAJGW";
		$data = array(
			  'touser' => 'oQL2jvzN9KjWnD1-tEHkbU0s7G0c',
			  'template_id' => '6Cg5WBmUSAK3uP1UdBqsG3fPjDQiS7KRDffEuiCS_5w',
			  'url' => 'http://baidu.com',
			  'title' => '123123',
			  'data' => array(
					  'name' => array(
							  'value' => '测试111',
							  'color' => '#173177',
					  ),
					  "remark" => array(
							  'value' => "测试111\n购买!",
							  'color' => "#173177",
					  ),

			  ),
		);
		$ret = $this->vCurlPost($url, json_encode($data,JSON_UNESCAPED_UNICODE));
		var_dump($ret);
	}


	public function baidu(){
		$this->load->view('baidu');
	}
	
	
	public function path(){
		ROOT_PATH;
	}

}
