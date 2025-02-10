<?php 
namespace app\controllers\admin;
use app\controllers\Base;
class Dashboard extends Base{
    public $data;
    public function index() {
        $this->data['title_page'] = 'Dashboard';
        $this->data['content'] = 'admin/dashboard';
        $this->data['sub_content'] = [];
        $this->render('layouts/main_admin', $this->data);
    }
   
}