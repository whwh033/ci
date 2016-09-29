<?php

/**
 * 发货单
 * @author auto create
 */
class DeliveryOrder
{
	
	/** 
	 * 出库单号
	 **/
	public $delivery_order_code;
	
	/** 
	 * 仓储系统出库单号
	 **/
	public $delivery_order_id;
	
	/** 
	 * 出库单类型，JYCK=一般交易出库，HHCK=换货出库，BFCK=补发出库，PTCK=普通出库单，DBCK=调拨出库，QTCK=其他出库，B2BCK=B2B出库
	 **/
	public $order_type;
	
	/** 
	 * 外部业务编码，消息ID， 用于去重，ISV对于同一请求分配一个唯一性的编码，用来保证因为网络等原因导致重复传输请求不会被重复处理条件必填条件为一单需要多次确认时
	 **/
	public $out_biz_code;
	
	/** 
	 * 货主编码
	 **/
	public $owner_code;
	
	/** 
	 * 仓库编码
	 **/
	public $warehouse_code;	
}
?>