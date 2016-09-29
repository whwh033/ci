<?php

/**
 * 面单申请接口
 * @author auto create
 */
class TradeOrderInfoDto
{
	
	/** 
	 * 收货地
	 **/
	public $consignee_address;
	
	/** 
	 * 收件人手机
	 **/
	public $consignee_mobile;
	
	/** 
	 * 收件人姓名
	 **/
	public $consignee_name;
	
	/** 
	 * 收件人固定电话
	 **/
	public $consignee_phone;
	
	/** 
	 * 物流服务
	 **/
	public $logistics_services;
	
	/** 
	 * 面单请求id
	 **/
	public $object_id;
	
	/** 
	 * 订单渠道
	 **/
	public $order_channels_type;
	
	/** 
	 * 包裹号
	 **/
	public $package_id;
	
	/** 
	 * 商品
	 **/
	public $package_items;
	
	/** 
	 * 发件人手机
	 **/
	public $send_mobile;
	
	/** 
	 * 发件人姓名
	 **/
	public $send_name;
	
	/** 
	 * 发件人固定电话
	 **/
	public $send_phone;
	
	/** 
	 * 标准模板url
	 **/
	public $template_url;
	
	/** 
	 * 订单号列表
	 **/
	public $trade_order_list;
	
	/** 
	 * 使用者的淘宝订单号，非淘订单传申请者id
	 **/
	public $user_id;
	
	/** 
	 * 体积
	 **/
	public $volume;
	
	/** 
	 * 重量
	 **/
	public $weight;	
}
?>