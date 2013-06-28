<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ($tpltitle); ?>后台用户</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='__PUBLIC__/Admin/css/admin_style.css' />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/formValidator.js"></script>
<script type="text/javascript">
	
</script>
</head>
<body>
		<?php if(($info["id"]) > "0"): ?><form action="<?php echo U('/Admin/Company/edit');?>" method="post" name="form" enctype="multipart/form-data" id="myform">
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
		<?php else: ?>
			<form action="<?php echo U('/Admin/Company/add');?>" method="post" name="form" enctype="multipart/form-data" id="myform"><?php endif; ?>
			<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">

				<tr class="table_title">
					<td colspan="4"><?php echo ($tpltitle); ?>展商</td>
				</tr>

				<tr class="tr rt">
					<td width="100">公司名称：</td>
					<td colspan="3" class="lt">
						<input type="text" name="name" id="name" style="width:400px" value="<?php echo ($info["name"]); ?>" <?php if(($info["name"]) == C("SPECIAL_USER")): ?>readonly="readonly"<?php endif; ?>>
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">展位：</td>
					<td colspan="3" class="lt">
						<input type="text" name="exposition" id="exposition" style="width:400px" value="<?php echo ($info["exposition"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">展会：</td>
					<td colspan="3" class="lt">
						<input type="text" name="expoName" id="expoName" style="width:400px" value="<?php echo ($expoName); ?>">
						
						<input type="text" name="eid" id="eid" style="width:10px" hidden="true" value="<?php echo ($eid); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">电话：</td>
					<td colspan="3" class="lt">
						<input type="text" name="phone" id="phone" style="width:400px" value="<?php echo ($info["phone"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">类型：</td>
					<td colspan="3" class="lt">
						<input type="text" name="type" id="type" class="datepicker" style="width:400px" value="<?php echo ($info["start"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">传真：</td>
					<td colspan="3" class="lt">
						<input type="text" name="fax" id="fax" style="width:400px" value="<?php echo ($info["fax"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">联系人：</td>
					<td colspan="3" class="lt">
						<input type="text" name="person" id="person" style="width:400px" value="<?php echo ($info["person"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">地址：</td>
					<td colspan="3" class="lt">
						<input type="text" name="address" id="address" style="width:400px" value="<?php echo ($info["address"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">邮编：</td>
					<td colspan="3" class="lt">
						<input type="text" name="zipcode" id="zipcode" style="width:400px" value="<?php echo ($info["zipcode"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">E-mail：</td>
					<td colspan="3" class="lt">
						<input type="text" name="email" id="email" style="width:400px" value="<?php echo ($info["email"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">网站：</td>
					<td colspan="3" class="lt">
						<input type="text" name="website" id="website" style="width:400px" value="<?php echo ($info["website"]); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">图片：</td>
					<td colspan="3" class="lt">
						<input type="text" name="pic" id="pic" class="datepicker" style="width:400px" value="<?php echo ($info["pic"]); ?>" readonly="true">
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