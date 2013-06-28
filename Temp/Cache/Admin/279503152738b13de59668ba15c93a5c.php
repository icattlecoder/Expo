<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站信息设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='__PUBLIC__/Admin/css/admin_style.css' />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/formValidator.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/formValidatorRegex.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){
      window.top.art.dialog({content:msg,lock:true,width:250,height:100,ok:function(){$(obj).focus();}});
    }});

   $("#web_name").formValidator({onshow:"请输入网站名称",onfocus:"请输入网站名称"}).regexValidator({regexp:"ps_username",datatype: "enum",onerror:"应为 中文、字母、数字 或 _ 组成"});
   $("#web_url").formValidator({onshow:"请输入网站地址，如：http://www.xxx.com/",onfocus:"请输入网站地址，如：http://www.xxx.com/"}).regexValidator({regexp:"^http[s]?://(.+)/$",onerror:"格式应该为 http://www.xxx.com/，请以‘/’结束"});
   $("#web_path").formValidator({onshow:"安装在根目录请使用：/",onfocus:"安装在根目录请使用：/"}).inputValidator({regexp:"^/\w*",onerror:"格式应该为 /[xxx]"});
   $("#web_icp").formValidator({empty:true,onshow:"请输入你的ICP备案信息",onfocus:"请输入你的ICP备案信息"}).inputValidator({max:20,onerror:"不能超过20个字符,请确认"});
   $("#web_admin_pagenum").formValidator({onshow:"后台数据管理的每页默认显示条数",onfocus:"后台数据管理的每页默认显示条数"}).regexValidator({regexp:"num1",datatype: "enum",onerror:"应为正数"});
   $("#web_home_pagenum").formValidator({onshow:"前台网站翻页信息左右显示的最大条数",onfocus:"前台网站翻页信息左右显示的最大条数"}).regexValidator({regexp:"num1",datatype: "enum",onerror:"应为正数"});
   $("#web_adsensepath").formValidator({onshow:"广告JS文件保存路径(区分大小写,相对于安装目录)",onfocus:"广告JS文件保存路径(区分大小写,相对于安装目录)"}).regexValidator({regexp:'^[^/][0-9a-zA-Z/]+$',onerror:"目录路径格式错误，必须是子目录，不能以 / 开头"});

  });
</script>
</head>
<body>
<form action="?s=Admin/Config/updateweb"  method="post" id="myform">
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<tr class="table_title"><td colspan="2">网站信息设置</td></tr>
<tr class="ji">
  <td class="left">网站名称</td>
  <td><input type="text" name="con[web_name]" id="web_name" size="35" maxlength="50" value="<?php echo ($con["web_name"]); ?>">
  </td>
</tr>
<tr class="tr">
  <td class="left">网站地址</td>
  <td ><input type="text" name="con[web_url]" id="web_url" size="35" maxlength="50" value="<?php echo ($con["web_url"]); ?>" >
  </td>
</tr>
<tr class="ji">
  <td class="left">安装路径</td>
  <td><input type="text" name="con[web_path]" id="web_path" size="35" maxlength="50" value="<?php echo ($con["web_path"]); ?>" >
  </td>
</tr> 
 <tr class="tr">
  <td class="left">ICP备案信息</td>
  <td><input type="text" name="con[web_icp]" id="web_icp" size="35" value="<?php echo ($con["web_icp"]); ?>">
  </td>
</tr>        
<tr class="ji">
  <td class="left">版权信息</td>
  <td title="设置本网站相关版权信息">
    <textarea name="con[web_copyright]" id="web_copyright" style="width:500px;height:50px"><?php echo ($con["web_copyright"]); ?></textarea> <br>
  </td>
</tr> 
 <tr class="tr">
  <td class="left">第三方统计代码</td>
  <td>
    <textarea name="con[web_tongji]" id="web_tongji" style="width:500px; height:50px"><?php echo ($con["web_tongji"]); ?></textarea> <br>
  </td>
</tr> 
<tr class="ji">
  <td class="left">模板主题方案</td>
  <td><select name="con_home[default_theme]"><?php if(is_array($temp)): $i = 0; $__LIST__ = $temp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["filename"]); ?>" <?php if(($vo["filename"]) == $con_home['default_theme']): ?>selected<?php endif; ?>><?php echo ($vo["filename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select> 
  </td>
</tr>
<tr class="table_title"><td colspan="2">个性参数设置</td></tr>
<tr class="tr">
  <td class="left">后台分页显示条数</td>
  <td><input type="text" name="con[web_admin_pagenum]" id="web_admin_pagenum" size="5" maxlength="5" value="<?php echo ($con["web_admin_pagenum"]); ?>" style="text-align:center">
  </td>
</tr>
<tr class="ji">
  <td class="left">前台翻页信息最大值</td>
  <td><input type="text" name="con[web_home_pagenum]" id="web_home_pagenum" size="5" maxlength="5" value="<?php echo ($con["web_home_pagenum"]); ?>" style="text-align:center">
  </td>
</tr>
<tr class="tr">
<td class="left">广告保存目录</td>
<td>
<input type="text" style="text-align:center" name="con[web_adsensepath]" id="web_adsensepath" value="<?php echo ($con["web_adsensepath"]); ?>" maxlength="30" size="20" >
</td>
</tr>    
<tr class="ji">
  <td colspan="2">
    <input class="bginput" type="submit" name="dosubmit" value="提交">
    <input class="bginput" type="reset" name="Input" value="重置" >
  </td>
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