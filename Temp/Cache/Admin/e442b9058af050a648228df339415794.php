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
			//$("table").resizableColumns({});
			//alert("dkl")

		}); 
			


	</script>
</head>
<body>
	<table width="100%" border="0" cellpadding="9" cellspacing="1" class="table" data-resizable-columns-id="demo-table">
		<tr>
			<td colspan="15" class="table_title">
				<span class="fl">后台会展展商管理</span>	
				<span class="fl" style="margin-left:100px;">
					<a href="javascript:void(0)" onclick="getCheckedValues(); if(checkedvalues==0){return;} return confirmurl('<?php echo U('/Admin/Company/batchdel/',array('eid'=>$eid,'p'=>$nowPage));?>'+'/ids/'+checkedvalues,'确定删除选中的展商吗?')">批量删除</a> | 
				</span>			
				
				<span class="fl">
					<a href="<?php echo U('/Admin/Company/batchadd/',array('eid'=>$eid));?>">+ 批量导入</a>
 				| 
				</span>
				<span class="fl">
					<a href="<?php echo U('/Admin/Company/add/',array('eid'=>$eid));?>">+ 添加展商</a>
				 | 	
				</span>
			</td>
			<tr class="list_head ct">
				<td width="30"><input type="checkbox" id="checkall"/></td>
				<td width="70">编号</td>
				<td >公司名称</td>
				<td width="150">展位</td>
				<td width="100">展会</td>
				<td width="100">电话</td>
				<td width="100">类型</td>
				<td width="100">传真</td>
				<td width="70">联系人</td>
				<td width="70">地址</td>
				<td width="70">邮编</td>
				<td width="70">E-mail</td>
				<td width="70">网站</td>
				<td width="70">图片</td>
				<td width="100">操作</td>
			</tr>
	    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class='<?php if(($mod) == "1"): ?>tr<?php else: ?>ji<?php endif; ?>'>
				<td align='center'><input class="check" type="checkbox" name='checkname[]' value='<?php echo ($vo["id"]); ?>'/></td>
				<td align='center'><?php echo ($vo["id"]); ?></td>
				<td ><a href="javascript:setting_access(<?php echo ($vo["id"]); ?>, '<?php echo ($vo["name"]); ?>')"><?php echo ($vo["name"]); ?></a></td>
				<td ><?php echo ($vo["exposition"]); ?></td>
				<td ><?php echo ($expoName); ?></td>
				<td align='center'><?php echo ($vo["phone"]); ?></td>			
				<td ><?php echo ($vo["type"]); ?></td>
				<td ><?php echo ($vo["fax"]); ?></td>
				<td ><?php echo ($vo["person"]); ?></td>
				<td ><?php echo ($vo["address"]); ?></td>
				<td ><?php echo ($vo["zipcode"]); ?></td>
				<td ><?php echo ($vo["email"]); ?></td>
				<td ><?php echo ($vo["website"]); ?></td>
				<td ><?php echo ($vo["pic"]); ?></td>				
				<td align='center'>				
					<a href="<?php echo U('/Admin/Company/edit/',array('id'=>$vo['id']));?>">修改</a>
					| <?php if(($vo["username"]) == C("SPECIAL_USER")): ?><font color="#cccccc">删除</font><?php else: ?><a href="javascript:void(0)" onclick="return confirmurl('<?php echo U('/Admin/Company/del/',array('id'=>$vo['id'],'eid'=>$eid,'p'=>$nowPage));?>','确定删除该展商吗?')">删除</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr class="tr">
			<td colspan="1" class="pages"><input class="bginput" type="button" onclick="javascript:history.back(-1);" value="返 回" > 
			 </td>	
          <td colspan="14" class="pages">
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
		<script type="text/javascript">
		//权限设置
			function setting_access(id, name) {
				window.top.art.dialog.open('<?php echo U('/Admin/Company/view/');?>'+'/id/'+id,{title: name+'详细信息', width: 400, height: 300});
			}
		</script>
</body>
	</html>