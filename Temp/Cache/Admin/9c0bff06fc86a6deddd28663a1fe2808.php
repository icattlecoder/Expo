<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台角色管理-<?php echo (C("cms_name")); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel='stylesheet' type='text/css' href='__PUBLIC__/Admin/css/admin_style.css' />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/Admin/js/function.js"></script>
	<style>td{ height:22px; line-height:22px}</style>
</head>
<body>
	<form action="/index.php?s=/Admin/User/role_sort" method="post" name="form">
	<table width="98%" border="0" cellpadding="5" cellspacing="1" class="table">
		<tr>
			<td colspan="6" class="table_title">
				<span class="fl">后台角色管理</span>
				<span class="fr">
					<a href="<?php echo U('/Admin/User/role_add');?>">添加角色</a>
				</span>
			</td>
			<tr class="list_head ct">
				<td width="70">排序权重</td>
				<td width="70">ID</td>
				<td width="350">角色名称</td>
				<td >角色描述</td>
				<td width="70">状态</td>
				<td width="200">管理操作</td>
			</tr>
	    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class='<?php if(($mod) == "1"): ?>tr<?php else: ?>ji<?php endif; ?>'>
				<td align='center'>
					<input type='text' value='<?php echo ($vo["sort"]); ?>' size='3' name='sort[<?php echo ($vo["id"]); ?>]'></td>
				<td align='center'><?php echo ($vo["id"]); ?></td>
				<td ><?php echo ($vo["name"]); ?></td>
				<td ><?php echo ($vo["remark"]); ?></td>
				<td align='center'><?php if(($vo["status"]) == "1"): ?><font color="red">√</font><?php else: ?><font color="blue">×</font><?php endif; ?> 
				</td>
				<td align='center'>
					<a href="javascript:setting_access(<?php echo ($vo["id"]); ?>, '<?php echo ($vo["name"]); ?>')">权限设置</a>
					| <a href="<?php echo U('/Admin/User/role_edit/',array('id'=>$vo['id']));?>">修改</a>
					| <a href="javascript:void(0)" onclick="return confirmurl('<?php echo U('/Admin/User/role_del/',array('id'=>$vo['id']));?>','确定删除该角色吗?')">删除</a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr class="tr">
          <td colspan="6" valign="middle">
            <input type="submit" value="排序" class="bginput" />
          </td>
        </tr>
		</table>
	</form>
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
<script type="text/javascript">
//权限设置
function setting_access(id, name) {
	window.top.art.dialog.open('<?php echo U('/Admin/User/access/');?>'+'&roleid='+id,{title: name+'权限设置', width: 600, height: 500});
}
</script>
</html>