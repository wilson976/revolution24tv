<?php

class M_print_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

/// Login Verification
    function verify($email, $pw) {
        $this->db->where('email', $email);
        $this->db->where('password', $pw);
        $this->db->where('status', '1');
        $this->db->limit(1);
        $q = $this->db->get('admin');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            $data['user_id'] = $row['id'];
            $data['mail'] = $row['email'];
            $data['tag'] = $row['tag'];
            $data['type'] = $row['type'];
            $data['name'] = $row['u_name'];
            
            //Get the User Permission
            if ($row['type'] != 10) {
                $this->db->select('ac_menu_module, ac_pole_module, ac_scroll_module, ac_banner_module, ac_photo_module, 
                    ac_profile_module, ac_entrycontrol_module, ac_news_entry_module, ac_horoscope');
                $this->db->where('user_id', $row['id']);
                $q = $this->db->get('access_control');
                if ($q->num_rows() > 0) {
                    $row1 = $q->row_array();
                    $i = 0;
                    foreach ($row1 as $key => $value):
                        $i++;
                        $j = 'permission' . $i;
                        $arn[$j] = $value;
                    endforeach;
                }
                $data['permission'] = $arn;
            }
            
            $data2 = array(
                'lastlogon' => date('Y-m-d H:i:s'),
                'lastlogout' => NULL
            );
            $this->db->where('id', $row['id']);
            $this->db->update('admin', $data2);

            //'<pre>' . print_r($data) . '</pre>';
            //print_r($this->db->last_query());
            $this->session->set_userdata($data);
        } else {
            $this->session->set_flashdata('error', 'The Email or Password You Entered is incorrect!');
        }
    }

     function CurrentUser(){
        $this->db->select('u_name,lastlogon,lastlogout');
        $this->db->where('lastlogout', NULL);
        $this->db->from('admin');
        $data = $this->db->get();
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
        
    }
    function newdate_list() {
        $data = $this->db->get('wsxq_c_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function new_dt() {
        $data = array(
            'cdt' => $this->input->post('new_date')
        );
        $this->db->where('id', '1');
        $this->db->update('wsxq_c_dt', $data);
        //print $this->db->last_query();
    }

    ///->Publish Date  
    function pubdate_list() {
        $data = $this->db->get('wsxq_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function Published() {
        $dt = $this->pubdate_list();
        $data = array(
            'p_dt' => $dt['pdt'],
            'table_name' => 'news'
        );
        $this->db->insert('wsxq_date_arc', $data);
    }

    function pub_dt() {
        $data = array(
            'pdt' => $this->input->post('pub_date')
        );
        $this->db->where('id', '1');
        $this->db->update('wsxq_p_dt', $data);
    }
    
    
    ////Magazine
    
    
    function mag_newdate_list() {
        $data = $this->db->get('wsxq_m_c_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function mag_new_dt() {
        $data = array(
            'cdt' => $this->input->post('new_date')
        );
        $this->db->where('id', '1');
        $this->db->update('wsxq_m_c_dt', $data);
    }

    ///->Publish Date  
    function mag_pubdate_list() {
        $data = $this->db->get('wsxq_m_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function mag_Published() {
        $data = $this->db->get('wsxq_m_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
        
    }

    function mag_pub_dt() {
        $data = array(
            'pdt' => $this->input->post('pub_date')
        );
        $this->db->where('id', '1');
        $this->db->update('wsxq_m_p_dt', $data);
    }

    
    ////-->Scroll News Start
    function scroll_list() {
        $this->db->order_by('s_id', 'DESC');
        $data = $this->db->get('scroll');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getscrollbyid($s_id) {
        $this->db->where('s_id', $s_id);
        $data = $this->db->get('scroll');
        if ($data->num_rows() > 0) {
            return $data->row_array();
            //print_r($mn);
            //$a = $q[0];            
        } else {
            $data = NULL;
        }
    }

    function scroll_edit() {
        $data = array(
            's_head' => $this->input->post('s_head')
        );
        $this->db->where('s_id', $this->input->post('s_id'));
        $this->db->update('scroll', $data);
    }

    function scroll_entry() {
        $data = array(
            's_head' => $this->input->post('s_head'));
        $this->db->insert('scroll', $data);
    }

    function scroll_delete($s_id) {
        $this->db->where('s_id', $s_id);
        $this->db->delete('scroll');
    }

    function news_list() {
        $dt = $this->newdate_list();
        //$this->db->limit(300);
        $this->db->where('article_type', 2);
        $this->db->where('n_date', $dt['cdt']);
        $this->db->order_by('n_id', 'DESC');
        $this->db->from('news');
        $this->db->join('admin', 'admin.id = news.n_post_by');
        $data = $this->db->get();
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }
    
    function newsedited_by($n_edited_person) {
        $this->db->select('u_name');
        $this->db->where('id', $n_edited_person);
        $q = $this->db->get('admin');
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            echo $row['u_name'];
        }
    }

    function unpublished() {
        $sql = 'SELECT * FROM (`news`) WHERE `n_status` = 1 OR `n_status` = 2';
        $data = $this->db->query($sql);
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            $data = NULL;
        }
    }

    ////-->Scroll News End
    function ScreenShotList() {
        $this->db->limit(30);
        $this->db->order_by('ln_id', 'DESC');
        $data = $this->db->get('wsxq_links');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function ScreenShotEntry() {
        $data = array(
            'ln_title' => $this->input->post('ln_title'),
            'ln_type' => $this->input->post('ln_type'),
            'ln_url' => $this->input->post('ln_url'),
            'ln_pubdate' => $this->input->post('ln_pubdate')
        );
        $this->db->insert('wsxq_links', $data);
        return $this->db->insert_id();
    }

    function addPicture($picture, $m_id) {
        $data = array('ln_source' => $picture);
        $this->db->where('ln_id', $m_id);
        $this->db->update('wsxq_links', $data);
    }

    function ScreenShotEdit() {
        $data = array(
            'ln_title' => $this->input->post('ln_title'),
            'ln_type' => $this->input->post('ln_type'),
            'ln_url' => $this->input->post('ln_url'),
            'ln_pubdate' => $this->input->post('ln_pubdate')
        );
        $this->db->where('ln_id', $this->input->post('ln_id'));
        $this->db->update('wsxq_links', $data);
    }

    function ScreenShotbyID($ln_id) {
        $this->db->where('ln_id', $ln_id);
        $data = $this->db->get('wsxq_links');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function ScreenShotdelete($ln_id) {
        $this->db->where('ln_id', $ln_id);
        $this->db->delete('wsxq_links');
    }

}