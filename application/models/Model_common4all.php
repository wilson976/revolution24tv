<?php

class Model_common4all extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function __destruct() {
        $this->db->close();
    }

    public function common() {
        $data['breakingnews'] = $this->Model_home->BreakingNews();
        $data['headlines'] = $this->Model_home->HeadlineNews();
        $data['latest_news'] = $this->Model_home->LatestNews();
        $data['most_read'] = $this->Model_home->most_read_count();
        $data['banner'] = $this->Model_home->banner();
       // $data['ticker'] = $this->Model_home->HomeTicker();
       $data['highlights'] = $this->Model_home->Highlights();
        $data['vidcat'] = $this->Model_home->VideoCategoryname();
        $data['online_menu'] = $this->Model_menu->create_Onlinemenu();
        //$data['online_menu_more'] = $this->Model_menu->create_Onlinemenu_more();
        $data['footermenu'] = $this->Model_menu->create_footermenu();
        $this->load->vars($data);
    }
}
