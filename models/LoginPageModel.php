<?php
class LoginPageModel extends PageModelBase{
	public function pageLoad(){
		
    }
	
	protected function login($args){
		$verified = BasicAuth::verify($args['username'], $args['password']);
		if ($verified){
			$this->redirect('home');
		}
	}
	
	protected function logout($args){
		BasicAuth::logout();
	}
}