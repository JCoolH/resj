<?php
/***
*用户自定义函数文件，二次开发，可将函数写于此，升级不会覆盖此文件
***/

	//XXXtest为测试数据
	function xxxtest() {
		echo "xxxtest function";
	}

	//获取全局导航列表
	function getNaviLists($order='asc')
	{
	
		$navilist_result = M('Category')->where(array('status'=>1,'is_menu'=>1))->order('sort '.$order)->select();
	
		$navilist_paren = array();
		$navilist_child = array();
	
		$m = 0;
		foreach($navilist_result as $key=>$val){
		    
		    $val['url'] = '/List/index/cid/'.$val['id'].'.html';
			if($val['pid'] > 0){
				$navilist_child[$m] = $val;
			}else{
				$navilist_paren[$m] = $val;
			}
	       
			$m++;
		}
		foreach($navilist_paren as $key=>$val){
			foreach($navilist_child as $k=>$v){
				if($val['id'] == $v['pid']){
					$navilist_paren[$key]['child'][] = $v;
				}
			}
		}
	
		return $navilist_paren;
	}
	//获取栏目下的列表
	function getCateLists($cid,$table,$where,$order)
	{
	    $return = array();
	    if($cid > 0 ){
	        $cate_key = 'cate_lists_'.$cid;
	        $return   = S($cate_key);
	        if(empty($return)){
	            $db = M($table);
	            $result = $db->where($where)->order($order)->select();
	            S($cate_key,$result,array('expire'=>7200));
	            $return   = S($cate_key);
	        }
	    }
	    
	    return $return;
	}
	//获取指定栏目的子栏目
	function get_catelist($typeid,$order='asc')
	{
		$return = array();
		if($typeid >0 ){
			$cate_key = 'cate_key_'.$typeid;
			$return   = S($cate_key);
			if(empty($return)){
				$db = M('category');
				$result = $db->where(array('pid'=>$typeid))->order('sort '.$order)->select();
				S($cate_key,$result,array('expire'=>7200));
				$return   = S($cate_key);
			}
		}
		
		return $return;
	}
	//获取指定栏目信息
	function getCatinfo($id)
	{
		$return = array();
		if($id > 0){
			$key = 'cat_info_'.$id;
			$return   = S($key);
			if(empty($return)){
				$db = M('category');
				$result = $db->where(array('id'=>$id))->find();
				S($key,$result,array('expire'=>7200));
				$return   = S($key);
			}
		}
		return $return;
	}
	//获取多个指定栏目信息
	function getCatinfo_list($ids)
	{
		$return = array();
		if($ids){
			$key = 'cat_info_list';
			$return   = S($key);
			if(empty($return)){
				$db = M('category');
				$result = $db->where(array('id'=>array('in',$ids)))->select();
				S($key,$result,array('expire'=>7200));
				$return   = S($key);
			}
		}
		return $return;
	}
	//获取特别显示栏目信息
	function getFlagCats($field='name,description,id',$limit=4)
	{
		
		$key = 'flagcat_info';
		$return   = S($key);
		if(empty($return)){
			$db = M('category');
			$result= M('category')->field($field)->where(array('flag'=>1))->order('sort asc')->limit($limit)->select();
			S($key,$result,array('expire'=>7200));
			$return   = S($key);
		}
		
		return $return;
	}
	//获取图片显示的栏目
	function getImgCat($field='name,description,picture,id',$limit=3)
	{
		$key = 'imgcat_info';
		$return   = S($key);
		if(empty($return)){
			$db = M('category');
			$result= M('category')->field($field)->where(array('picture'=>array('neq','')))->order('sort asc')->limit($limit)->select();
			S($key,$result,array('expire'=>7200));
			$return   = S($key);
		}
		
		return $return;
	}
	//拆分图片集
	function explodeImgs($imgs)
	{
		$return = array();
		if($imgs){
			$data = explode('|||',$imgs);
			if($data){
				foreach($data as $val){
					$child = explode('$$$$$$',$val);
					$return[] = array(
						'imgurl' => $child[0],
						'title'  => $child[1]
					);
				}
			}
		}
		return $return;
	}
	//获取评价列表
	function getCommentList()
	{
	    $return = array();
	    $key    = 'comment_lists';
	    $return = S($key);
	    if(empty($return)){
	        $return = M('comment')->order('posttime desc')->limit(10)->select();
	        S($key,$return,10800);
	    }
	    return $return;
	}
	//获取标签文章列表
	function getTagArticle($tag_id,$limit=3)
	{
	    $return = array();
	    $key    = 'tag_article_'.$tag_id;
	    $return = S($key);
	    if(empty($return)){
	        $return = M('article')->where(array('tag_id'=>$tag_id))->order('sort desc,publishtime desc')->limit($limit)->select();
	        S($key,$return,10800);
	    }
	    return $return;
	}
	//截取字符串加省率号
	function substrUtf8($string,$len,$type='...',$charset='utf8'){
	    $str = '';
	    if($string){
	        $mb_len = mb_strlen($string,$charset);
	        if($mb_len > $len){
	            $str = mb_substr($string,0,$len,$charset).$type;
	        }else{
	            $str = $string;
	        }
	    }
	    return $str;
	}
	/**
	 * 获取mysql版本
	 *
	 */
	function getDbVersion()
	{
	    $mysql = M()->query('select version()');
	    return $mysql[0]['version()'];
	}
	/**
	 * 获取热门关键词
	 */
	function get_keywords($limit=6)
	{
		$data = M('keywords')->limit($limit)->select();
		return $data?$data:array();
	}
?>