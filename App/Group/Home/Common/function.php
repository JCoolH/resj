<?php

if (C('cfg_website_close') == 1) {
	exitMsg(C('cfg_website_close_info'));
}

// 取出所有导航分类
function get_nav_cate($update = 0) {//
    $cate_sname = 'fCategery_nav';
    $cate_arr = F($cate_sname);
    if ($update  || !$cate_arr) {
        $cate_arr = D('CategoryView')->nofield('content')->where(array('category.status' => 1,'category.isnav'=>1))->order('category.sort,category.id')->select();
        if (!isset($cate_arr)) {
            $cate_arr = array();
        }
        F($cate_sname, $cate_arr);
    }
    return $cate_arr;   
}

// 获取原图
function big_img($img){
    if ($pos = strpos($img,'!')) {
        return substr($img, 0,$pos);
    }
    return $img;
}

// 获取指定栏目id的顶级栏目
function category_top($id){
    import('Class.Category', APP_PATH);
    return array_shift(Category::getParents(getCategory(), $id));
}

// 获取指定栏目
function xl_get_cat($id){
    $cate_sname = 'fCategery_id';
    $cate_arr = F($cate_sname);
    if (!$cate_arr) {
        $cate_arr = D('CategoryView')->where(array('category.status' => 1))->select();
        if (!isset($cate_arr)) {
            $cate_arr = array();
        }
        $tmp = array();
        foreach ($cate_arr as $key => $value) {
            $value['url'] = getUrl($value);
            $tmp[$value['id']] = $value;
        }
        F($cate_sname, $tmp);
        return $tmp[$id];
    }
    return $cate_arr[$id];
}

// 获取指定内容 包括文章 产品 软件 图集
function xl_get_content($id,$table='article'){
    $data = M($table) -> find($id);
    $_jumpflag = ($data['flag'] & B_JUMP) == B_JUMP? true : false;
    $cate = xl_get_cat($data['id']);
    $data['url'] = getContentUrl($data['id'], $data['cid'], $cate['ename'], $_jumpflag, $data['jumpurl']);
    if ($data['ext']) {
        $data['ext'] = render_ext($data['ext']);
    }
    if ($data['picturedesc']) {
        $data['picturedesc'] = json_decode($data['picturedesc'],true);
    }
    if ($data['pictureurls']) {
        $pictureurls_arr = empty($data['pictureurls']) ? array() : explode('|||', $data['pictureurls']);
        $pictureurls  = array();
        foreach ($pictureurls_arr as $v) {
            $temp_arr = explode('$$$', $v);
            if (!empty($temp_arr[0])) {
                $pictureurls[] = array(
                    'url' => $temp_arr[0],
                    'alt' => $temp_arr[1]
                );
            }               
        }
        $data['pictureurls'] = $pictureurls;
    }
    if ($data['downlink']) {
        $downlink_arr = empty($data['downlink']) ? array() : explode('|||', $data['downlink']);       
        $downlink  = array();
        foreach ($downlink_arr as $v) {
            $temp_arr = explode('$$$', $v);
            if (!empty($temp_arr[1])) {
                $downlink[] = array(
                    'url' => $temp_arr[1],
                    'title' => $temp_arr[0]
                );
            }               
        }
        $data['downlink'] = $downlink;   
    }
    return $data;
}

// 解析扩展字段
function render_ext($params){
    if (!$params) {
        return;
    }
    $tmp = explode("\r\n", $params);
    $res = array();
    foreach ($tmp as $key => $value) {
        list($name,$v) = explode('|', $value);
        $res[$name] = $v;
    }
    return $res;
}