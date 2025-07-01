<?php

class M_admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

/// Login Verification
    function verify($email, $pw) {
        $arn = array();
        $this->db->where('email', $email);
        $this->db->where('password', $pw);
        $this->db->where('status', '1');
        $this->db->limit(1);
        $q = $this->db->get('admin');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            //$data['user_id'] = $row['id'];
            //$data['mail'] = $row['email'];
            //$data['tag'] = $row['tag'];
            //$data['type'] = $row['type'];
            //$data['name'] = $row['u_name'];
			$newdata = array(
				'user_id'  => $row['id'],
				'mail'     => $row['email'],
				'tag' => $row['tag'],
				'type'  => $row['type'],
				'name'     => $row['u_name']
			);

            //'<pre>' . print_r($data) . '</pre>';
            //print_r($this->db->last_query());
			//exit;
            $this->session->set_userdata($newdata);
        } else {
            $this->session->set_flashdata('error', 'The Email or Password You Entered is incorrect!');
        }
    }

    public function user_list(){
        $this->db->select('id, u_name');
        $this->db->where('status', '1');
        // $type = array('5', '10');
        // $this->db->where_in('type', $type);
        $this->db->where('type', '5');
        $data = $this->db->get('admin');
        // print $this->db->last_query();exit;
        if ($data->num_rows() > 0) {
            return $data->result_array();
        }
        $data->free_result();
    }

    function search_total($m_id='', $sdate = '', $title='', $edate='', $user='', $status='') {
        $this->db->select('n_id');
        $this->db->order_by('start_date', 'DESC');
        if($m_id != ''){
            $this->db->where('n_category', $m_id);
        }
        if($title!=''){
            $this->db->like('n_head', $title);
        }
        if($user!=''){
            $this->db->where('n_post_by', $user);
        }
        if($status!=''){
            $this->db->where('n_status', $status);
        }
        if($sdate!=''){
            $this->db->where('start_date >=', $sdate);
        }
        if($edate!=''){
            $this->db->where('start_date <=', $edate);
        }else{
            $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        }
        // if($sdate =='' and $edate ==''){
        //     $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        // }
        $this->db->where('article_type', 1);
        $this->db->join('admin', 'admin.id = news.n_post_by');
        $q = $this->db->get('news');
        // print $this->db->last_query();
        // exit;
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            $q->free_result();
            return $data;
        }
        $q->free_result();
    }

    ///-->Pool News Start

    function pool_list() {
        $this->db->order_by('PK_PoolID', 'DESC');
        $data = $this->db->get('opinion_pool');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getpoolbyid($PK_PoolID) {
        $this->db->where('PK_PoolID', $PK_PoolID);
        $data = $this->db->get('opinion_pool');
        if ($data->num_rows() > 0) {
            return $data->row_array();
            //print_r($mn);
            //$a = $q[0];            
        } else {
            $data = NULL;
        }
    }

    function pool_edit() {
        $dt = new DateTime();
        $data = array(
            'PoolText' => $this->input->post('PoolText'),
            'PoolEDate' => $dt->format('Y-m-d H:i:s')
        );
        $this->db->where('PK_PoolID', $this->input->post('PK_PoolID'));
        $this->db->update('opinion_pool', $data);
    }

    function pool_entry() {
        $dt = new DateTime();
        $data = array(
            'PoolText' => $this->input->post('PoolText'),
            'PoolDate' => $dt->format('Y-m-d H:i:s')
    );
        $this->db->insert('opinion_pool', $data);
    }

    function pool_delete($PK_PoolID) {
        $this->db->where('PK_PoolID', $PK_PoolID);
        $this->db->delete('opinion_pool');
    }

    //-->Pool News End
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
            's_head' => $this->input->post('s_head'),
            's_type' => $this->input->post('s_type'));
        $this->db->insert('scroll', $data);
    }

    function scroll_delete($s_id) {
        $this->db->where('s_id', $s_id);
        $this->db->delete('scroll');
    }

    function news_list($limit='100', $title='', $sdate='', $edate='', $user='', $status='') {
        // $this->db->limit($limit);
        // print_r($sdate);
        // exit;
        $this->db->select("n_id, n_date, n_head, n_category, article_type,start_date,n_status,live_news,most_read,post_time,admin.u_name,n_edit_by,edit_time");
        if($title!=''){
            $this->db->like('n_head', $title);
        }
        if($user!=''){
            $this->db->where('n_post_by', $user);
        }
        if($status!=''){
            $this->db->where('n_status', $status);
        }
        if($sdate!=''){
            $this->db->where('start_date >=', $sdate);
        }
        if($edate!=''){
            $this->db->where('start_date <=', $edate);
        }
        $this->db->where('article_type', 1);
        $this->db->order_by('n_id', 'DESC');
        $this->db->join('admin', 'admin.id = news.n_post_by');
        $data = $this->db->get('news', $limit, $this->uri->segment(4));
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }
    
    function unpublished(){
        $sql='SELECT * FROM (`news`) WHERE `n_status` = 1 OR `n_status` = 2';
        $data = $this->db->query($sql);
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->num_rows();
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

    public function search_total_comments($type='!= app',$status='0'){
        $this->db->select('id');
        $this->db->where('type', $type);
        $this->db->where('status', $status);
        $this->db->join('news','news.n_id = commennt.news_id');
        $data = $this->db->get('commennt');
        // print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        }
        $data->free_result();
    }

    public function comments($status,$date='', $type='!= app', $limit='50'){
        $this->db->where('status', $status);
        //$this->db->where('type', $type);
        if($date!=''){
            $date = str_replace('_','-',$date);
            $this->db->like('created_at', $date);
        }
        $this->db->join('news','news.n_id = commennt.news_id');
        $this->db->order_by('id', 'DESC');
        // $data = $this->db->get('commennt');

        $uri_segment = 4;
        if($this->uri->segment(4)=='web'){
            $uri_segment = 5;
        }
        $data = $this->db->get('commennt', $limit, $this->uri->segment($uri_segment));
        if ($data->num_rows() > 0) {
            return $data->result_array();
        }
        $data->free_result();
    }

    function comment_approve($id) {
        $sql = "UPDATE `commennt` SET `status` = '1' WHERE `id` = '".$id."'";
        $data = $this->db->query($sql);
        return "1";
    }
    function comment_reject($id) {
        $sql = "UPDATE `commennt` SET `status` = '2' WHERE `id` = '".$id."'";
        $data = $this->db->query($sql);
        return "1";
    }

    function unpub_news() {
        $this->db->limit(300);
        $this->db->select("n_id, n_date, n_head, n_category, article_type,start_date,n_status,most_read,post_time,u_name,n_edit_by,edit_time");
        $this->db->where('n_status', 1);
        $this->db->where('article_type', 1);
        $this->db->or_where('n_status', 2);
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

    function publishenews($n_id) {
        $sql = 'UPDATE news SET `n_status`=3 WHERE `n_id` ='.$n_id;
        $data = $this->db->query($sql);
        return "1";
    }
    function unpublishenews($n_id) {
        $sql = 'UPDATE news SET `n_status`=1 WHERE `n_id` ='.$n_id;
        $data = $this->db->query($sql);
        return "1";
    }


}