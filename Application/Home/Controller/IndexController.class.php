<?php
namespace Home\Controller;

use Home\Model\MessageViewModel;
use Think\Controller;
use Think\Model;
use Think\Page;


class IndexController extends Controller {

    public function index()
    {
		$model = new MessageViewModel();
		$count = $model->count();

		$page = new Page($count,10);
		$show = $page->show();
		$list = $model->order('message_id desc')->limit($page->firstRow .','.$page->listRows)->select();

		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}

    private function checkLogin()
    {
    	if(!session('user.userId')){
    		$this->error('请登录',U('User/login'));
    	}
    }
    public function post()
    {
    	$this->checkLogin();
    	$this->display();
    }
    public function do_post()
    {
    	$this->checkLogin();
    	$content = I('content');
    	if(empty($content)){
    		$this->error('留言内容不能为空');
    	}
    	if(mb_strlen($content,'utf-8')>100){
    		$this->error('留言内容最多100字');
    	}

    	$model = new Model('Message');
    	$userId = session('user.userId');
    	$data = array(
    		'content' => $content,
    		'created_at' => time(),
    		'user_id' => $userId
    		);
        if(!($model->create($data) && $model->add()))
        {

            $this->error('留言失败');
        }
    	$this->success('留言成功',U('Index/index'));
    }

    public function delete()
    {
    	$id = I('id');
    	if(empty($id)){
    		$this->error('缺少参数');
    	}
    	$this->checkLogin();
    	$model = new Model('Message');
        $result = $model->where(array('message_id' => $id,'user_id' => session('user.userId')))->delete();
    	if(!$result){
    		$this->error('删除失败');
    	}
    	$this->success('删除成功',U('index'));
    }
}