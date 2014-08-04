<?php

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

	// Store model to not repeat query.
	private $_model;

	// Return first name.
	// access it by Yii::app()->user->email
	public function getEmail(){
		return $this->getIsGuest() ? '' : $this->email;
	}
	
	public function getBagian(){
		return $this->getIsGuest() ? '' : $this->bagian;
	}
	
	public function getUsername(){
		$data = $this->loadUser(Yii::app()->user->id);
		return $this->getIsGuest() ? '' : $data->username;
	}


	// This is a function that checks the field 'role'
	// in the User model to be equal to 1, that means it's admin
	// access it by Yii::app()->user->isAdmin()
	function isAdmin(){
		$user = $this->loadUser(Yii::app()->user->id);
		return $this->getIsGuest() ? '' : intval($user->id_status) == 1;
	}
	
	
	function isHo(){
		$user = $this->loadUser(Yii::app()->user->id);
		return $this->getIsGuest() ? '' : intval($user->id_status) == 2;
	}
	
	function isRo(){
		$user = $this->loadUser(Yii::app()->user->id);
		return $this->getIsGuest() ? '' : intval($user->id_status) == 3;
	}


	protected function loadUser($id=null){
		if($this->_model===null){
			if($id!==null)
				$this->_model=User::model()->findByPk($id);
		}
		return $this->_model;
	}
	
	
	public function getHaknya(){
		if(Yii::app()->user->getIsGuest()){
			return "";
		}else{
			$user = $this->loadUser(Yii::app()->user->id);
			if(intval($user->id_status)==1){
				$result = "Admin";
			}elseif(intval($user->id_status)==2){
				$result = "HO";
			}else{
				$result = "RO";
			}
			return $result;
		}
	}
	
	
	
}
?>