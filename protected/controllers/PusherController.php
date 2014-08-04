<?php

class PusherController extends Controller
{
	
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	public function actionMessage()
	{
		$pusher=Yii::app()->pusher;
		$pusher->trigger('messaging','newMessage',array('msg'=>'Ular melingkar dipagar bundar'));
		echo "Sukses";
	}
	
	
	
	public function actionIndex()
	{
		echo "WELCOME PUSHER API";
	}
}
