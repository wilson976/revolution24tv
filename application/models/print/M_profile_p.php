<?php

class M_profile_p extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    ///->Profile Start


    function writer_list() {
        $this->db->order_by('p_order', 'ASC');
        $this->db->where('p_cat_id', '33');
        $data = $this->db->get('profiles');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function p_entry() {

        $data = array(
            'p_name' => $_POST['name_bangla'],
            'p_name_eng' => $_POST['name_english'],
            'p_email' => $_POST['email'],
            'p_profession' => $_POST['p_profession'],
            'p_order' => $_POST['order'],
            'p_cat_id' => $_POST['p_cat_id'],
            'p_details' => $_POST['details']
        );
        $this->db->insert('profiles', $data);
        return $this->db->insert_id();
    }

    function PaddPicture($picture, $p_id) {
        $data = array('p_pic' => $picture);
        $this->db->where('p_id', $p_id);
        $this->db->update('profiles', $data);
    }

    function getPbyid($p_id) {
        $this->db->where('p_id', $p_id);
        $data = $this->db->get('profiles');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function p_edit() {
        $data = array(
            'p_name' => $_POST['name_bangla'],
            'p_name_eng' => $_POST['name_english'],
            'p_email' => $_POST['email'],
            'p_profession' => $_POST['p_profession'],
            'p_order' => $_POST['order'],
            'p_cat_id' => $_POST['p_cat_id'],
            'p_details' => $_POST['details']
        );
        $this->db->where('p_id', $this->input->post('p_id'));
        $this->db->update('profiles', $data);
    }

    function p_delete($p_id) {
        $this->db->where('p_id', $p_id);
        $this->db->delete('profiles');
    }

    //-->Columnist End
    //->NRB Start

    function nrb_list() {
        $this->db->order_by('nrb_tab', 'ASC');
        $data = $this->db->get('nrb');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function nrb_entry() {
        $data = array(
            'nrb_name' => $_POST['name_bangla'],
            'nrb_email' => $_POST['email'],
            'nrb_tab' => $_POST['tab'],
            'nrb_bio' => $_POST['details'],
            'nrb_bio_english' => $_POST['english'],
            'nrb_place' => $_POST['place'],
            'nrb_sector' => $_POST['sector']
        );
        $this->db->insert('nrb', $data);
        return $this->db->insert_id();
    }

    function nrbaddPicture($picture, $nrb_id) {
        $data = array('nrb_pic_location' => $picture);
        $this->db->where('nrb_id', $nrb_id);
        $this->db->update('nrb', $data);
    }

    function getnrbbyid($nrb_id) {
        $this->db->where('nrb_id', $nrb_id);
        $data = $this->db->get('nrb');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function nrb_edit() {
        $data = array(
            'nrb_name' => $_POST['name'],
            'nrb_email' => $_POST['email'],
            'nrb_tab' => $_POST['tab'],
            'nrb_bio' => $_POST['details'],
            'nrb_bio_english' => $_POST['english'],
            'nrb_place' => $_POST['place'],
            'nrb_sector' => $_POST['sector']
        );
        $this->db->where('nrb_id', $this->input->post('nrb_id'));
        $this->db->update('nrb', $data);
    }

    function nrb_delete($nrb_id) {
        $this->db->where('nrb_id', $nrb_id);
        $this->db->delete('nrb');
    }

    ////-->NRB End
    ///->NRB Writer Start

    function nrbwriter_list() {
        $this->db->order_by('nrbw_tab', 'ASC');
        $data = $this->db->get('nrb_writer');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function nrbwriter_entry() {
        $data = array(
            'nrbw_name' => $_POST['name'],
            'nrbw_email' => $_POST['email'],
            'nrbw_tab' => $_POST['tab'],
            'nrbw_place' => $_POST['nrbw_place'],
            'nrbw_details' => $_POST['details']
        );
        $this->db->insert('nrb_writer', $data);
        return $this->db->insert_id();
    }

    function nrbwriteraddPicture($picture, $col_id) {
        $data = array('nrbw_pic_location' => $picture);
        $this->db->where('nrbw_id', $col_id);
        $this->db->update('nrb_writer', $data);
    }

    function getnrbwriterbyid($col_id) {
        $this->db->where('nrbw_id', $col_id);
        $data = $this->db->get('nrb_writer');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function nrbwriter_edit() {
        $data = array(
            'nrbw_name' => $_POST['name'],
            'nrbw_email' => $_POST['email'],
            'nrbw_tab' => $_POST['tab'],
            'nrbw_place' => $_POST['nrbw_place'],
            'nrbw_details' => $_POST['details']
        );
        $this->db->where('nrbw_id', $this->input->post('nrbw_id'));
        $this->db->update('nrb_writer', $data);
    }

    function nrbwriter_delete($col_id) {
        $this->db->where('nrbw_id', $col_id);
        $this->db->delete('nrb_writer');
    }

    ////-->NRB Writer End
    //->NRB Cultural Start

    function nrb_cultural_list() {
        $this->db->order_by('nrb_cultural_tab', 'ASC');
        $data = $this->db->get('nrb_cultural');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function nrb_cultural_entry() {
        $data = array(
            'nrb_cultural_name' => $_POST['name'],
            'nrb_cultural_email' => $_POST['email'],
            'nrb_cultural_tab' => $_POST['tab'],
            'nrb_cultural_bio' => $_POST['details'],
            'nrb_cultural_bio_english' => $_POST['english'],
            'nrb_cultural_place' => $_POST['place'],
            'nrb_cultural_sector' => $_POST['sector']
        );
        $this->db->insert('nrb_cultural', $data);
        return $this->db->insert_id();
    }

    function nrbculturaladdPicture($picture, $nrb_cultural_id) {
        $data = array('nrb_cultural_pic_location' => $picture);
        $this->db->where('nrb_cultural_id', $nrb_cultural_id);
        $this->db->update('nrb_cultural', $data);
    }

    function getnrbculturalbyid($nrb_cultural_id) {
        $this->db->where('nrb_cultural_id', $nrb_cultural_id);
        $data = $this->db->get('nrb_cultural');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function nrb_cultural_edit() {
        $data = array(
            'nrb_cultural_name' => $_POST['name'],
            'nrb_cultural_email' => $_POST['email'],
            'nrb_cultural_tab' => $_POST['tab'],
            'nrb_cultural_bio' => $_POST['details'],
            'nrb_cultural_bio_english' => $_POST['english'],
            'nrb_cultural_place' => $_POST['place'],
            'nrb_cultural_sector' => $_POST['sector']
        );
        $this->db->where('nrb_cultural_id', $this->input->post('nrb_cultural_id'));
        $this->db->update('nrb_cultural', $data);
    }

    function nrb_cultural_delete($nrb_cultural_id) {
        $this->db->where('nrb_cultural_id', $nrb_cultural_id);
        $this->db->delete('nrb_cultural');
    }

    ////-->NRB Writer End
    //->NRB Start

    function wiw_list() {
        $this->db->order_by('wiw_id', 'desc');
        $this->db->from('wiw');
        $this->db->join('ww_category', 'ww_category.ww_id = wiw.wiw_cat');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function wiw_entry() {
        $data = array(
            'wiw_name' => $_POST['name'],
            'wiw_cat' => $_POST['category'],
            'wiw_email' => $_POST['email'],
            'wiw_order' => $_POST['order'],
            'wiw_bio' => $_POST['details'],
            'wiw_bio_english' => $_POST['english'],
            'wiw_place' => $_POST['place'],
            'wiw_sector' => $_POST['sector']
        );
        $this->db->insert('wiw', $data);
        return $this->db->insert_id();
    }

    function wiwaddPicture($picture, $wiw_id) {
        $data = array('wiw_pic_location' => $picture);
        $this->db->where('wiw_id', $wiw_id);
        $this->db->update('wiw', $data);
    }

    function getwiwbyid($wiw_id) {
        $this->db->where('wiw_id', $wiw_id);
        $data = $this->db->get('wiw');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function wiw_edit() {
        $data = array(
            'wiw_name' => $_POST['name'],
            'wiw_cat' => $_POST['category'],
            'wiw_email' => $_POST['email'],
            'wiw_order' => $_POST['order'],
            'wiw_bio' => $_POST['details'],
            'wiw_bio_english' => $_POST['english'],
            'wiw_place' => $_POST['place'],
            'wiw_sector' => $_POST['sector']
        );
        $this->db->where('wiw_id', $this->input->post('wiw_id'));
        $this->db->update('wiw', $data);
    }

    function wiw_delete($wiw_id) {
        $this->db->where('wiw_id', $wiw_id);
        $this->db->delete('wiw');
    }

    //category
    function ww_category_list() {
        $this->db->order_by('ww_id', 'DESC');
        $data = $this->db->get('ww_category');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function ww_category_entry() {
        $data = array(
            'ww_cat' => $this->input->post('ww_cat'));
        $this->db->insert('ww_category', $data);
    }

    function cat_edit_page($ww_id) {
        $this->db->where('ww_id', $ww_id);
        $data = $this->db->get('ww_category');
        if ($data->num_rows() > 0) {
            return $data->row_array();
            //print_r($mn);
            //$a = $q[0];            
        } else {
            $data = NULL;
        }
    }

    function cat_edit() {
        $data = array(
            'ww_cat' => $this->input->post('ww_cat')
        );
        $this->db->where('ww_id', $this->input->post('ww_id'));
        $this->db->update('ww_category', $data);
    }

    function ww_cat_delete($ww_id) {
        $this->db->where('ww_id', $ww_id);
        $this->db->delete('ww_category');
    }

    ////-->NRB End
}