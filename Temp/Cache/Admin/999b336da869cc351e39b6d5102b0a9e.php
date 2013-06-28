<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ($tpltitle); ?>后台用户</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='__PUBLIC__/Admin/css/admin_style.css' />
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/formValidator.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){
			window.top.art.dialog({content:msg,lock:true,width:250,height:100,ok:function(){$(obj).focus();}});
		}});
		$("#username").formValidator({onshow:"请输入用户名",onfocus:"用户名至少3个字符,最多50个字符",oncorrect:"输入正确"}).inputValidator({min:3,empty:{leftempty:false,rightempty:false,emptyerror:"两边不能有空符号"},onerror:"你输入的用户名非法,请确认"})
		    .ajaxValidator({
			datatype : "json",
			async : true,
			type: "GET",
			url : "<?php echo U('/Admin/User/check_username',array('userid'=>$info['id']));?>",
			success : function(data){
	            if( data == "0" ){
	            	return true;
	            }else{
	            	return false;
	            }
			},
			error: function(){
				window.top.art.dialog({content:"服务器没有返回数据，可能服务器忙，请重试",lock:true,width:250,height:100,ok:function(){}});
			},
			onerror : "该用户名已存在，请更换",
			onwait : "用户名校验中..."
		})<?php if(($info["id"]) > "0"): ?>.defaultPassed()<?php endif; ?>;


		$("#password").formValidator({<?php if(($info["id"]) > "0"): ?>empty:true,<?php endif; ?>onshow:"请输入密码",onfocus:"至少6个长度",oncorrect:"密码合法"}).inputValidator({min:6,empty:{leftempty:false,rightempty:false,emptyerror:"密码两边不能有空符号"},onerror:"密码不能为空,请确认"});
		$("#repassword").formValidator({<?php if(($info["id"]) > "0"): ?>empty:true,<?php endif; ?>onshow:"输再次输入密码",onfocus:"至少6个长度",oncorrect:"密码一致"}).inputValidator({min:6,empty:{leftempty:false,rightempty:false,emptyerror:"重复密码两边不能有空符号"},onerror:"重复密码不能为空,请确认"}).compareValidator({desid:"password",operateor:"=",onerror:"两次密码不一致,请确认"});
		$("#remark").formValidator({empty:true,onshow:"请输入你的描述"}).inputValidator({max:250,onerror:"描述不能超过250个字符,请确认"});
		
		
		$(".datepicker").datepicker({
			numberOfMonths:1,//显示几个月  
            showButtonPanel:true,//是否显示按钮面板  
            dateFormat: 'yy-mm-dd',//日期格式  
            clearText:"清除",//清除日期的按钮名称  
            closeText:"关闭",//关闭选择框的按钮名称  
            yearSuffix: '年', //年的后缀  
            currentText:"今天",
            showMonthAfterYear:true,//是否把月放在年的后面           
            monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],  
            dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],  
            dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],  
            dayNamesMin: ['日','一','二','三','四','五','六']             
         }); 
	});
</script>
</head>
<body>
		<?php if(($info["id"]) > "0"): ?><form action="<?php echo U('/Admin/Newexpo/edit');?>" method="post" name="form" enctype="multipart/form-data" id="myform">
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
		<?php else: ?>
			<form action="<?php echo U('/Admin/Newexpo/add');?>" method="post" name="form" enctype="multipart/form-data" id="myform"><?php endif; ?>
			<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">

				<tr class="table_title">
					<td colspan="4"><?php echo ($tpltitle); ?>展会</td>
				</tr>

				<tr class="tr rt">
					<td width="100">展会名称：</td>
					<td colspan="3" class="lt">
						<input type="text" name="name" id="name" style="width:400px" value="<?php echo ($info["name"]); ?>" <?php if(($info["name"]) == C("SPECIAL_USER")): ?>readonly="readonly"<?php endif; ?>>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">会展城市：</td>
					<td colspan="3" class="lt">
						<input type="addr" name="addr" id="text" style="width:200px" value="<?php echo ($info["addr"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">展会展馆：</td>
					<td colspan="3" class="lt">
						<input type="text" name="hall" id="hall" style="width:200px" value="<?php echo ($info["hall"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">下年展馆：</td>
					<td colspan="3" class="lt">
						<input type="text" name="next_hall" id="next_hall" style="width:200px" value="<?php echo ($info["next_hall"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">展会时间：</td>
					<td colspan="3" class="lt">
						<input type="text" name="start" id="start" class="datepicker" style="width:200px" value="<?php echo ($info["start"]); ?>" readonly="true">至
						<input type="text" name="end" id="end" class="datepicker" style="width:200px" value="<?php echo ($info["end"]); ?>" readonly="true">
					</td>
				</tr>			
	<tr class="tr lt">
		<td colspan="4">
			<?php if(($info["id"]) > "0"): ?><input class="bginput" type="submit" name="dosubmit" value="修 改" >
				<?php else: ?>
				<input class="bginput" type="submit" name="dosubmit" value="添 加"><?php endif; ?>
			&nbsp;
			<input class="bginput" type="button" onclick="javascript:history.back(-1);" value="返 回" ></td>
	</tr>
</table>
</form>
﻿<style>
#footer, #footer a:link, #footer a:visited {
	clear:both;
	color:#0072e3;
	font:12px/1.5 Arial;
	margin-top:10px;
	text-align:center;
	white-space:nowrap;
}
</style>
<div id="footer">程序版本：<?php echo (C("cms_var")); ?>&nbsp;&nbsp;&nbsp;&nbsp;Copyright © 2011-2012 All rights reserved</div>
</body>
</html>