<?php
class RestrictPageModel extends PageModelBase{
    public function pageLoad(){
        $login = BasicAuth::validate();
        if (empty($login) || !isset($login)){
            header('Location: login');
            return;
        }
        $this->content['custom_html'] = "<p>Hello, ".$login."!</p>";
    }
}