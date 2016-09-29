<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function iphone_status($status){
		file_put_contents('status.txt', $status);
		echo json_encode(array('statusCode' => 0, 'msg' => '', 'data' => "修改成功"));exit;
	}

	public function iphone_data_get($status){
		$data = $this->db->where('status', $status)->get('iphone')->result();
		if($data){
			echo json_encode(array('statusCode' => 0, 'msg' => '', 'data' => $data));exit;
		}else{
			echo json_encode(array('statusCode' => -1, 'msg' => '分类没有数据', 'data' => ''));exit;
		}
	}

	function iphone_voer(){
		$arr = array( -1, 0, 2, 4, 6, 8, 10, 12);
		$groups = $this->db->select('count(id) counts, status')->group_by("status")->get('iphone')->result();
		foreach($groups as $key => $val){
			$status[] = $val->status;
			$vals[$val->status] = $val->counts;
		}
		foreach($arr as $k=>$v){
			if(in_array($v, $status)){
				$list[$v] = $vals[$v];
			}else{
				$list[$v] = 0;
			}
		}
		echo json_encode(array('statusCode' => 0, 'msg' => '', 'data' => $list));exit;
	}


	public function iphone_data_del(){
		$data = $this->db->where('status > ', 0)->truncate('iphone');
		if($data){
			echo json_encode(array('statusCode' => 0, 'msg' => '删除成功', 'data' => ''));exit;
		}else{
			echo json_encode(array('statusCode' => -1, 'msg' => '删除失败', 'data' => ''));exit;
		}
	}

	public function iphone_up_data(){
		$str = $_POST['str'];
		if(!$str){
			echo json_encode(array('statusCode' => -1, 'msg' => '请上传数据', 'data' => ''));exit;
		}
		foreach($str as $k=>$v){
			$data[]['str'] = $v;
		}
		$this->db->insert_batch('iphone', $data);
		echo json_encode(array('statusCode' => 0, 'msg' => '上传成功', 'data' => ''));exit;
	}
}
