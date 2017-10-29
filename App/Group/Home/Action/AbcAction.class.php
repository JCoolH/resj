<?php

class AbcAction extends Action{
	//shows
	public function shows(){
		
		$id = I('id', 0, 'intval');
		$flag = I('flag', 0, 'intval');
		if (!empty($id)) {
			echo getAbc($id,$flag);
		}else {
			echo '';
		}

	}
	public function list_banner(){

	    $id = I('aid',0,'intval');
	    $limit = I('limit',0,'intval');

	    $where = array('aid'=>$id,'status'=>1);
	    if(!empty($id) &&!empty($limit))
        {
            $_abc = M('abcDetail')->where($where)->order('sort')->limit($limit)->select();
            //var_dump($_abc);exit;\

           
           echo msg('1','成功',$_abc) ;
        }else{
	        msg('0','参数错误','');
        }

    }
}

?>