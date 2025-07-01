<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Amp extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_amp');
    }

    

    public function details($n_cat, $n_year, $n_month, $n_date, $n_id) {

        $dt = $n_year . '-' . $n_month . '-' . $n_date;
        $data = array();
        $data['dt'] = $dt;
        $data['class'] = 'post';
        
        $m_id=$this->Model_amp->getMenuID($n_cat);
//exit;
        
        $cat_id = '';
        if ($m_id == NULL) {
            redirect('/my404');
        } else {
            $cat_id = $m_id;
        }
        $data['getnewsby_id'] = $this->Model_amp->getNewsbyID($cat_id, $n_id,$dt);
        $data['getmenu'] = $this->Model_amp->getMenubyID($data['getnewsby_id']['n_category']);
        
        $data['menu_name'] = $data['getmenu']['m_bangla'];

        if($data['getnewsby_id']['article_type']==1){
            $data['Cat_more_news'] = $this->Model_amp->getMorenewsbyCat_online($data['getnewsby_id']['n_category'], $n_id);
        }else{
            $data['Cat_more_news'] = $this->Model_amp->getMorenewsbyCat($data['getnewsby_id']['n_category'], $n_id, $dt);
        }
        $data['related'] = $this->Model_amp->related_news($n_id, $dt);
        // print_r($data['Cat_more_news']);
        $data['comments'] = $this->Model_amp->comments($n_id);
        
        $data['next'] = $this->Model_amp->next($n_id, $data['getnewsby_id']['n_category']);
        $data['previous'] = $this->Model_amp->previous($n_id, $data['getnewsby_id']['n_category']);
        
        $data['online_menu'] = $this->Model_amp->create_Onlinemenu();        
        $data['printmenu'] = $this->Model_amp->create_Printmenu(); 
        $this->load->view('template-amp', $data);
    }

}
