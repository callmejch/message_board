<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;


class UserController extends Controller {

    public function register()
    {
		$this->display();
	}

    public function do_register()
    {
    	$username = I('username');
        $password = I('password');
        $repassword = I('repassword');
        if(empty($username)){
            $this->error('用户名不能为空');
        }
        if(empty($password)){
            $this->error('密码不能为空');
        }
        if($password != $repassword){
            $this->error('确认密码错误');
        }

        $model = new Model('User');
        $user = $model->where(array('username' => $username))->find();

        if(!empty($user)){
            $this->error('用户名已存在');
        }
        $data = array(
            'username' => $username,
            'password' => md5($password),
            'created_at' => time()
            );

        if(!($model->create($data) && $model->add())){
            $this->error('注册失败'.$model->getDbError());
        }
        $this->success('注册成功，请登录',U('login'));
    }

    
    public function login()
    {
        $this->display();
    }

    public function do_login()
    {
        $username = I('username');
        $password = I('password');
        $model = new Model('User');
        $user = $model->where(array('username' => $username))->find();

        if(empty($user) || $user['password'] != md5($password)){
            $this->error('账号或密码错误');
        }

        session('user.userId',$user['user_id']);
        session('user.username',$user['username']);

        $this->redirect('Index/index');
    }
    public function logout()
    {
        if(!session('user.userId')){
            $this->error('请登录');
        }
        session_destroy();
        $this->success('退出登录成功',U('Index/index'));
    }
}