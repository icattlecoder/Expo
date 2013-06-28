<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台展会管理-<?php echo (C("cms_name")); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel='stylesheet' type='text/css' href='__PUBLIC__/Admin/css/admin_style.css' />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/Admin/js/function.js"></script>
	<style>td{ height:22px; line-height:22px}</style>
	<script type="text/javascript">
		checkedvalues=[];
		function getCheckedValues () {
			// body...
			checkedvaluess = []
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
			
			}); 
			$("#batchdel").click(function () {
				alert("hello")
				// body...
			});

	</script>
</head>
<body>
	<table width="100%" border="0" cellpadding="10" cellspacing="1" class="table">
		<tr>
			<td colspan="10" class="table_title">
				<span class="fl">后台会展管理</span>
				<span class="fr">
					<a href="<?php echo U('/Admin/Newexpo/add');?>">+ 添加会展</a>
				</span>
				<span class="fr">
					<a href="javascript:void(0)" onclick="getCheckedValues();return confirmurl('<?php echo U('/Admin/Newexpo/batchdel/',array('id'=>$vo['id'],'p'=>$nowPage));?>'+'/ids/'+checkedvalues,'确定删除选中的会展吗?')">批量删除</a>					
				</span>
			</td>
			<tr class="list_head ct">
				<td width="30"><input type="checkbox" id="checkall"/></td>
				<td width="70">编号</td>
				<td >名称</td>
				<td width="150">地址</td>
				<td width="100">展馆</td>				
				<td width="150">时间</td>				
				<td width="70">是否可以更新</td>
				<td width="100">管理操作</td>
			</tr>
	    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class='<?php if(($mod) == "1"): ?>tr<?php else: ?>ji<?php endif; ?>'>
				<td align='center'><input class="check" type="checkbox" name='checkname[]' value='<?php echo ($vo["id"]); ?>'/></td>
				<td align='center'><?php echo ($vo["id"]); ?></td>
				<td ><?php echo ($vo["name"]); ?></td>
				<td ><?php echo ($vo["addr"]); ?></td>
				<td ><?php echo ($vo["hall"]); ?></td>
			
				<td align='center'>
					<?php echo ($vo["start"]); ?>-<?php echo ($vo["end"]); ?></td>
				<td align='center'><?php if(($vo["allow_up"]) == "1"): ?><font color="green">√</font><?php else: ?><font color="red">×</font><?php endif; ?> 					
				</td>			
				<td align='center'>					
					<a href="<?php echo U('/Admin/Newexpo/edit/',array('id'=>$vo['id']));?>">修改</a>
					| <?php if(($vo["username"]) == C("SPECIAL_USER")): ?><font color="#cccccc">删除</font><?php else: ?><a href="javascript:void(0)" onclick="return confirmurl('<?php echo U('/Admin/Newexpo/del/',array('id'=>$vo['id']));?>','确定删除该用户吗?')">删除</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr class="tr">
          <td colspan="10" class="pages">
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
</body>
	</html>