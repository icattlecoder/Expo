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
		<form action="<?php echo U('/Admin/Company/batchadd/',array('eid'=>$eid));?>" method="post" name="form" enctype="multipart/form-data" id="myform">
			<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table">

				<tr class="table_title">
					<td colspan="4"><?php echo ($tpltitle); ?>展商</td>
				</tr>
				<tr class="tr rt">
					<td width="100">展会：</td>
					<td colspan="3" class="lt">
						<input type="text" name="expoName" id="expoName" readonly="readonly" style="width:400px" value="<?php echo ($expoName); ?>">
						
						<input type="text" name="eid" id="eid" hidden="true" style="width:400px" value="<?php echo ($eid); ?>">
					</td>
				</tr>
				<tr class="tr rt">
					<td width="100">上传Excel：</td>
					<td colspan="3" class="lt">
						<input type="file" name="name" id="name" style="width:400px" value="<?php echo ($info["name"]); ?>" <?php if(($info["name"]) == C("SPECIAL_USER")): ?>readonly="readonly"<?php endif; ?>>
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