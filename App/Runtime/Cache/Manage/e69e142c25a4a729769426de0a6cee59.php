<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel='stylesheet' type="text/css" href="__PUBLIC__/css/style.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
 <script language="JavaScript">
        <!--
        var URL = '__URL__';
        var APP	 = '__APP__';
        var SELF='__SELF__';
        var PUBLIC='__PUBLIC__';
        //-->
        </script>
</head>
<body>
<div class="main">
    <div class="pos"><?php echo ($type); ?>
    </div>
    <div class="operate">
        <div class="left">
            <input type="button" onclick="goUrl('<?php echo U(GROUP_NAME. '/Abc/index');?>')" class="btn_green" value="返回" /> 
            <input type="button" onclick="goUrl('<?php echo U(GROUP_NAME. '/Abc/addDetail', array('aid' => $cate['id']));?>')" class="btn_blue" value="添加广告" /> 
            <input type="button" onclick="doGoSubmit('<?php echo U(GROUP_NAME. '/Abc/sort');?>','form_do')" class="btn_blue" value="更新排序" />
              
        </div>
    </div>
    <div class="list">    
    <form action="<?php echo U(GROUP_NAME.'/Abc/delAll');?>" method="post" id="form_do" name="form_do">
        <table width="100%">
            <tr>
                <th>编号</th>
                <th>广告标题</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>排序</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
			<?php if(is_array($vlist)): foreach($vlist as $key=>$v): ?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["title"]); ?></td>
                <td><?php echo (date('Y-m-d H:i:s', $v["starttime"])); ?></td>   
                <td><?php echo (date('Y-m-d H:i:s', $v["endtime"])); ?></td>              
                <td><input type="text" name="sortlist[<?php echo ($v["id"]); ?>]" value="<?php echo ($v["sort"]); ?>" id="sortlist" size="5"></td>            
                <td><?php if(empty($v['status'])): ?>停用<?php else: ?>启用<?php endif; ?></td>
                <td>
                    <a href="<?php echo U(GROUP_NAME. '/Abc/editDetail',array('id' => $v['id']), '');?>">编辑</a>
                    <a href="javascript:;" onclick="toConfirm('<?php echo U(GROUP_NAME. '/Abc/delDetail',array('id' => $v['id'], 'aid' => $v['aid']), '');?>', '确实要删除吗？')">删除</a>
				</td>
            </tr><?php endforeach; endif; ?>
        </table>
        <div class="page" style="clear: both;"><?php echo ($page); ?></div>        
        <input type="hidden" name="aid" value="<?php echo ($cate["id"]); ?>" />
    </form>
    </div>
</div>
</body>
</html>