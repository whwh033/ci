<?php

/**
 * 收货地址
 * @author auto create
 */
class AddressDto
{
	
	/** 
	 * 详细地址
	 **/
	public $address_detail;
	
	/** 
	 * 区名称（三级地址）
	 **/
	public $area_name;
	
	/** 
	 * 市名称（二级地址）
	 **/
	public $city_name;
	
	/** 
	 * 一级地址（省、直辖市
	 **/
	public $province_name;
	
	/** 
	 * 街道\镇名称（四级地址）
	 **/
	public $town_name;	
}
?>