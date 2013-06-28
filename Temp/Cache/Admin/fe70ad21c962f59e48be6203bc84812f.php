<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台展会管理-<?php echo (C("cms_name")); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel='stylesheet' type='text/css' href='__PUBLIC__/Admin/css/admin_style.css' />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/Admin/js/function.js"></script>
	<style>td{ height:22px; line-height:22px}</style>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript">
		checkedvalues=[];
		function getCheckedValues () {
			// body...
			checkedvaluess= []
			$(".check").each(function() { 						
						if($(this).attr("checked")){
							checkedvalues.push($(this).attr("value"))							
						}						
			}); 
		}
		$(function() { 
			alt=true;			
			$("#checkall").click(function() {						
					$(".check").each(function() { 
						$(this).attr("checked", alt); 						
					}); 					
				alt =! alt;	
			}); 
		
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
			$("#batchdel").click(function () {
				alert("hello")
				// body...
			});

	</script>
</head>
<body>
	<form action="<?php echo U('/Admin/Expo/search/');?>" method="post" name="form" enctype="multipart/form-data" id="myform">
	<table width="100%" border="0" cellpadding="10" cellspacing="1" class="table">
		<tr>
			<td colspan="10" class="table_title">
				
				<span class="fl">名称：<input name="name" type="text"/></span>	
				<span class="fl">时间: <input name="time" type="text" class="datepicker"/></span>
				<span class="fl"><button name="dosubmit" class="aui_state_highlight" type="submit">确定</button></span>
				<span class="fr">
					<a href="javascript:void(0)" onclick="getCheckedValues();return confirmurl('<?php echo U('/Admin/Expo/batchdel/',array('id'=>$vo['id'],'p'=>$nowPage));?>'+'/ids/'+checkedvalues,'确定删除选中的会展吗?')">批量删除</a>					
				</span>	
				<span class="fr">
					<a href="<?php echo U('/Admin/Expo/add');?>">+ 添加会展</a>
				</span>	
			</td>			
		</tr>	

		<tr class="list_head ct">
				<td width="30"><input type="checkbox" id="checkall"/></td>
				<td width="70">编号</td>
				<td >名称</td>
				<td width="150">地址</td>
				<td width="100">展馆</td>
				<td width="100">明年展馆</td>
				<td width="150">时间</td>
				<td width="150">明年时间</td>
				<td width="70">是否可以更新</td>			
				<td width="100">管理操作</td>
			</tr>
	    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class='<?php if(($mod) == "1"): ?>tr<?php else: ?>ji<?php endif; ?>'>
				<td align='center'><input class="check" type="checkbox" name='checkname[]' value='<?php echo ($vo["id"]); ?>'/></td>
				<td align='center'><?php echo ($vo["id"]); ?></td>
				<td ><a href="<?php echo U('/Admin/Company/index/',array('eid'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a>
				</td>
				<td ><?php echo ($vo["addr"]); ?></td>
				<td ><?php echo ($vo["hall"]); ?></td>
				<td align='center'><?php echo ($vo["next_hall"]); ?></td>
				<td align='center'>
					<?php echo ($vo["start"]); ?>-<?php echo ($vo["end"]); ?></td>
				<td align='center'><?php echo ($vo["next_start"]); ?>-<?php echo ($vo["next_end"]); ?></td>

				
				<td align='center'><?php if(($vo["allow_up"]) == "1"): ?><font color="green">√</font><?php else: ?><font color="red">×</font><?php endif; ?> 					
				</td>			
				<td align='center'>
					<a href="<?php echo U('/Admin/Company/index/',array('eid'=>$vo['id']));?>">添加展商</a>| 
					<a href="<?php echo U('/Admin/Expo/edit/',array('id'=>$vo['id']));?>">修改</a>
					| <?php if(($vo["username"]) == C("SPECIAL_USER")): ?><font color="#cccccc">删除</font><?php else: ?><a href="javascript:void(0)" onclick="return confirmurl('<?php echo U('/Admin/Expo/del/',array('id'=>$vo['id']));?>','确定删除该用户吗?')">删除</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr class="tr">
			<td colspan="1" class="pages"><input class="bginput" type="button" onclick="javascript:history.back(-1);" value="返 回" > 
			 </td>	
          <td colspan="9" class="pages">
            <?php echo ($page); ?>
          </td>
        </tr>
		</table>
		<script>var version='<?php echo (C("cms_var")); ?>';</script>
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
	</form>
</body>
	</html>