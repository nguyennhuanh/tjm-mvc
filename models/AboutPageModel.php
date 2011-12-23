<?php
class AboutPageModel extends PageModelBase{
    public function pageLoad(){        
        $this->content['custom_html'] = "<p>Hey dude!</p>";
    }
}