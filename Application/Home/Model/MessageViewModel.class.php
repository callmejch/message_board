<?php
namespace Home\Model;
use Think\Model\ViewModel;

class MessageViewModel extends ViewModel
{
	public $viewFields = array(
		'Message' => array('message_id','content','created_at'),
		'User'=>array('user_id','username','_on' => 'Message.user_id=User.user_id'));
}
?>