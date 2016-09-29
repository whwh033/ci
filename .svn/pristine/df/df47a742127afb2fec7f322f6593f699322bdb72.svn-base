<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6eMV7AUWDmEkC2bo66nkGvgI"></script>
	<title>浏览器定位</title>
</head>
<body>
	<div id="allmap"></div>
</body>
</html>
<script type="text/javascript">
	// 添加标注
	function addMarker(point, index) {
		var myIcon = new BMap.Icon("http://api.map.baidu.com/img/markers.png",
			new BMap.Size(23, 25), {
				offset: new BMap.Size(10, 25),
				imageOffset: new BMap.Size(0, 0 - index * 25)
			});
		var marker = new BMap.Marker(point, { icon: myIcon });
		map.addOverlay(marker);
		return marker;
	}

	// 添加信息窗口
	function addInfoWindow(marker, poi) {
		//pop弹窗标题
		var title = '<div style="font-weight:bold;color:#CE5521;font-size:14px">' + poi.title + '</div>';
		//pop弹窗信息
		var html = [];
		html.push('<table cellspacing="0" style="table-layout:fixed;width:100%;font:12px arial,simsun,sans-serif"><tbody>');
		html.push('<tr>');
		html.push('<td style="vertical-align:top;line-height:16px;width:38px;white-space:nowrap;word-break:keep-all">地址:</td>');
		html.push('<td style="vertical-align:top;line-height:16px">' + poi.address + ' </td>');
		html.push('</tr>');
		html.push('<td style="vertical-align:top;line-height:16px;width:38px;white-space:nowrap;word-break:keep-all">电话:</td>');
		html.push('<td style="vertical-align:top;line-height:16px">' + poi.tel + ' </td>');
		html.push('</tr>');
		html.push('</tbody></table>');
		var infoWindow = new BMap.InfoWindow(html.join(""), { title: title, width: 200 });

		var openInfoWinFun = function () {
			marker.openInfoWindow(infoWindow);
		};
		marker.addEventListener("click", openInfoWinFun);
		return openInfoWinFun;
	}

	// 百度地图API功能
	var map = new BMap.Map("allmap");
	var point = new BMap.Point(121.427043,31.198268);
	map.centerAndZoom(point,13);
	//第3步：启用滚轮放大缩小
	map.enableScrollWheelZoom(true);
	//第4步：向地图中添加缩放控件
	var ctrlNav = new window.BMap.NavigationControl({
		anchor: BMAP_ANCHOR_TOP_LEFT,
		type: BMAP_NAVIGATION_CONTROL_LARGE
	});
	map.addControl(ctrlNav);
	//第5步：向地图中添加缩略图控件
	var ctrlOve = new window.BMap.OverviewMapControl({
		anchor: BMAP_ANCHOR_BOTTOM_RIGHT,
		isOpen: 1
	});
	map.addControl(ctrlOve);

	//第6步：向地图中添加比例尺控件
	var ctrlSca = new window.BMap.ScaleControl({
		anchor: BMAP_ANCHOR_BOTTOM_LEFT
	});
	map.addControl(ctrlSca);

	var geolocation = new BMap.Geolocation();
	geolocation.getCurrentPosition(function(r){
		if(this.getStatus() == BMAP_STATUS_SUCCESS){
			var mk = new BMap.Marker(r.point);
			map.addOverlay(mk);
			map.setCenter(r.point);
			map.panTo(r.point);
			
			alert('您的位置：'+r.point.lng+','+r.point.lat);
			//第7步：绘制点
			var markerArr = [
				{ title: "广州火车站", point: "121.49201,31.38007", address: "广东省广州市广州火车站", tel: "12306" },
				{ title: "广州塔（赤岗塔）", point: "121.34196,31.16321", address: "广东省广州市广州塔（赤岗塔） ", tel: "18500000000" },
			];
			for (var i = 0; i < markerArr.length; i++) {
				var p0 = markerArr[i].point.split(",")[0];
				var p1 = markerArr[i].point.split(",")[1];
				var maker = addMarker(new window.BMap.Point(p0, p1), i);
				addInfoWindow(maker, markerArr[i], i);
			}
			
		}
		else {
			alert('failed'+this.getStatus());
		}        
	},{enableHighAccuracy: true})
</script>