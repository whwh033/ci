<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adidas extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library('redisdb',array('key' => 'api'));
	}

	public function up(){
		$key = "adidas_card_list";
		$ret = $this->db->get('adidas')->result();
		foreach($ret as $k=>$v){
			$data[] = array(
				'card' => $v->card,
				'name' => $v->card,
			);
		}
		if($data){
			$redis = $this->redisdb;
			array_unshift($data,$key);
			call_user_func_array(array($redis, "lPushMulti"), $data);
			$ret = $this->db->truncate('adidas');
			if($ret){
				echo 0;exit;
			}
		}
		echo -1;exit;
	}


	public function get(){
		$data = $this->redisdb->rPop("adidas_card_list");
		if($data){
			echo json_encode(array('statusCode' => 0, 'data' => $data,'msg' => ''));exit;
		}else{
			echo json_encode(array('statusCode' => -1, 'data' => '','msg' => '没有查到数据'));exit;
		}
	}

	public function submit($name, $card, $phone, $address){
		$data = array(
			'name' => $name,
			'card' => $card,
			'phone' => $phone,
			'address' => $address,
		);
		$ret = $this->db->insert('adidas',$data);
		if($ret){
			echo json_encode(array('statusCode' => 0, 'data' => '','msg' => '提交成功'));exit;
		}else{
			echo json_encode(array('statusCode' => -1, 'data' => '','msg' => '提交失败'));exit;
		}
	}


}

