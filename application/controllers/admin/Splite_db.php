<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Splite_db extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
    }

    function index() {
        $data['body'] = 'splite_db';
        $data['reg_mod'] = $this->Musers->showuserRmod();
        $data['loc_mod'] = $this->Musers->showuserLmod();
        $data['user'] = $this->Musers->showuserUser();
        $this->load->view('admin/template', $data);
    }

    function create() {
        if ($this->input->post('t_name') != NULL) {

            if ($this->input->post('s_date') != NULL && $this->input->post('e_date') != NULL) {

                $tablename = $_POST['t_name'];

                if ($this->db->table_exists($tablename)) {
                    $this->session->set_flashdata('error', 'Data Moved');
                    $mastertable = 'news';
                    $s_date = $this->input->post('s_date');
                    $e_date = $this->input->post('e_date');
                    $query = "`n_date` >= '$s_date' AND `n_date` <= '$e_date'";
                    $this->db->where($query);
                    $q = $this->db->get('news')->result(); // get first table
                    foreach ($q as $r) { // loop over results
                        $this->db->insert($tablename, $r); // insert each row to another table

                        $this->db->where('n_id', $r->n_id); // Delete each row from news table
                        $this->db->delete('news');
                    }
                    redirect('admin/splite_db', 'refresh');
                } else {
                    $mastertable = 'news';
                    $this->db->query("CREATE TABLE $tablename LIKE $mastertable");

                    $s_date = $this->input->post('s_date');
                    $e_date = $this->input->post('e_date');
                    $query = "`n_date` >= '$s_date' AND `n_date` <= '$e_date'";
                    $this->db->where($query);
                    $q = $this->db->get('news')->result(); // get first table
                    foreach ($q as $r) { // loop over results
                        $this->db->insert($tablename, $r); // insert each row to another table
                        $this->db->where('n_id', $r->n_id); // Delete each row from news table
                        $this->db->delete('news');
                    }
                }

                $data = array(
                    'table_name' => $tablename
                );
                $query = "`p_dt` >= '$s_date' AND `p_dt` <= '$e_date'";
                // print_r($query);
                // exit();
                $this->db->where($query);
                $this->db->update('wsxq_date_arc', $data);
                $this->session->set_flashdata('success', 'Successfully Moved');
                redirect('admin/splite_db', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Please Enter Start date or End Date');
                redirect('admin/splite_db', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Please Enter a table name');
            redirect('admin/splite_db', 'refresh');
        }
    }

   
}
