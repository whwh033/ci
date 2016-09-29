<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$status = file_get_contents("status.txt");
		$arrs = array('2' => '已停止', '3' => '等待中');
		if($status != 1){
			echo json_encode(array('code' => -1, 'msg' => $arrs[$status], 'data' => '', 'status' => $status));exit;
		}
		$this->load->library('redisdb',array('key' => 'api'));
	}


	public function up($phone,$content){
		try{
			$this->redisdb->hSet("sms_content_list", $phone, urldecode($content));
			echo json_encode(array('code' => 0, 'msg' => '上传成功'));
		}catch (Exception $e){
			echo json_encode(array('code' => -1, 'msg' => '上传失败'));
		}

	}


	public function get($phone){
		$data = $this->redisdb->hGet("sms_content_list", $phone);
		if($data){
			$this->redisdb->hSet("sms_content_list", $phone, "");
			echo json_encode(array('code' => 0, 'msg' => $data));
		}else{
			echo json_encode(array('code' => -1, 'msg' => "暂无数据"));
		}
	}



	public function iphone_get(){
		$ret = $this->db->where('status', 0)->get('iphone')->row();
		if($ret){
			$this->db->set('status',-1)->where('id', $ret->id)->update('iphone');
			echo json_encode(array('statusCode' => 0, 'msg' => '', 'data' => $ret));exit;
		}else{
			echo json_encode(array('statusCode' => -1, 'msg' => '没有数据', 'data' => ''));exit;
		}
	}

	public function iphone_update($id, $status){
		$day = isset($_POST['day'])?$_POST['day']:0;
		$params = array(
			'status' =>  $status,
			'update_time' => time(),
			'day' => $day,
		);
		$ret = $this->db->set($params)->where('id', $id)->update('iphone');
		if($ret){
			echo json_encode(array('statusCode' => 0, 'msg' => '', 'data' => $ret));exit;
		}else{
			echo json_encode(array('statusCode' => -1, 'msg' => '更新失败', 'data' => ''));exit;
		}
	}




}
