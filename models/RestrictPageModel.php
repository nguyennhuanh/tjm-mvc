<?php
class RestrictPageModel extends PageModelBase{
    public function pageLoad(){
        $login = BasicAuth::validate();
        if (empty($login) || !isset($login)){
            $this->redirect('login');
            return;
        }
        $this->content['custom_html'] = Lang::get('WELCOME', $login);
    }
}