<?php

class Model_cp extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function countallprofile($country_id) {
        $this->db->order_by('cp_order', 'ASC');
        $this->db->where('cp_country', $country_id);
        $q = $this->db->get('community_person');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
        } else {
            $data = NULL;
        }
    }

    function getallprofile($limit, $country_id) {
        $sql = "SELECT * from community_person WHERE cp_country='$country_id' ORDER BY cp_order ASC " . $limit;
        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

    function getdetailsbyID($cp_id) {
        $this->db->where('cp_id', $cp_id);
        $q = $this->db->get('community_person');
        if ($q->num_rows() > 0) {
            return $data = $q->row_array();
        } else {
            $data = NULL;
        }
    }

}