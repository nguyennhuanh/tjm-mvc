<?php
class HomePageModel extends PageModelBase{
    public function pageLoad(){
        $login = BasicAuth::validate();
        if (empty($login)){
            header('Location: index.php?p=login');
            return;
        }
        $this->content['custom_html'] = "<p>You can use Model to get data from db and show it to View</p>";
    }
}