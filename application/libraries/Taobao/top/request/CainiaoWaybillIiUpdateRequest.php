<?php
/**
 * TOP API: cainiao.waybill.ii.update request
 * 
 * @author auto create
 * @since 1.0, 2016.05.20
 */
class CainiaoWaybillIiUpdateRequest
{
	/** 
	 * 更新面单信息请求
	 **/
	private $paramWaybillApplyFullUpdateRequest;
	
	private $apiParas = array();
	
	public function setParamWaybillApplyFullUpdateRequest($paramWaybillApplyFullUpdateRequest)
	{
		$this->paramWaybillApplyFullUpdateRequest = $paramWaybillApplyFullUpdateRequest;
		$this->apiParas["param_waybill_apply_full_update_request"] = $paramWaybillApplyFullUpdateRequest;
	}

	public function getParamWaybillApplyFullUpdateRequest()
	{
		return $this->paramWaybillApplyFullUpdateRequest;
	}

	public function getApiMethodName()
	{
		return "cainiao.waybill.ii.update";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
