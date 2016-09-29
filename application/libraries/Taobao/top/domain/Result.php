<?php

/**
 * 接口返回model
 * @author auto create
 */
class Result
{
	
	/** 
	 * 返回失败时，是否需求重试，为true时，建议系统自动重试
	 **/
	public $is_retry;
	
	/** 
	 * 库存占用明细列表
	 **/
	public $item_inventory_list;
	
	/** 
	 * ERP订单编码
	 **/
	public $order_code;
	
	/** 
	 * 错误码
	 **/
	public $wl_error_code;
	
	/** 
	 * 错误信息
	 **/
	public $wl_error_msg;
	
	/** 
	 * 是否成功
	 **/
	public $wl_success;	
}
?>