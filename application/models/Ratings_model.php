<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ratings_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function bar($id, $units = '', $static = '') {
        //set some variables
        ($units) OR $units = 10;
        ($static) OR $static = FALSE;

        $ip = $this->input->ip_address();
        $rating_unitwidth = $this->config->item('rating_unitwidth');

        //default values
        $count = 0;
        $current_rating = 0;
        $tense = "votes"; // 0 votes
        // get votes, values, ips for the current rating bar
        if (!$numbers = $this->findBy_id($id)) {
            // insert the id in the DB if it doesn't exist already
            $data = array(
                'id' => $id,
                'total_votes' => $count,
                'total_value' => $current_rating,
                'used_ips' => '',
            );
            $this->insert($data);
        } else {
            $count = $numbers['total_votes']; //how many votes total        
            $current_rating = $numbers['total_value']; //total number of rating
            $tense = ($count == 1) ? "vote" : "votes"; //plural form votes/vote
        }

        $voted = (bool) $this->countBy_ip($ip, $id);

        //more default values
        $rating_width = 0;
        $rating1 = 0;
        $rating2 = 0;

        // now draw the rating bar
        if ($count > 0) {
            $rating_width = number_format($current_rating / $count, 2) * $rating_unitwidth;
            $rating1 = number_format($current_rating / $count, 1);
            $rating2 = number_format($current_rating / $count, 2);
        }

        $data = array(
            'id' => $id,
            'current_rating' => $current_rating,
            'count' => $count,
            'units' => $units,
            'tense' => $tense,
            'voted' => $voted,
            'rating_width' => $rating_width,
            'rating1' => $rating1,
            'rating2' => $rating2,
            'rating_unitwidth' => $rating_unitwidth,
            'ip' => $ip,
        );


        return $this->load->view('ratings/dynamic_rating_view', $data, TRUE);
    }

    function findBy_id($id) {
        $this->db->select('total_votes, total_value, used_ips');
        $this->db->where("id = '{$id}'");
        $query = $this->db->get('ratings');
        return $query->row_array();
    }

    function countBy_ip($ip, $id) {
        $this->db->select('used_ips');
        $this->db->where("used_ips LIKE '%{$ip}%' AND id = '{$id}'");
        $query = $this->db->get('ratings');
        return count($query->result());
    }

    function updateBy_id($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('ratings', $data);
    }

    function insert($data) {
        $this->db->insert('ratings', $data);
    }

}

