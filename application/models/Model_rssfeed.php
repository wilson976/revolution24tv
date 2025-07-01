<?php

class Model_rssfeed extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getrssdata($id) {
        if ($id == 'bangladesh') {
            $rid = array('51');
        }
        if ($id == 'operbangla') {
            $rid = array('181', '182', '183');
        }
        if ($id == 'international') {
            $rid = array('191', '257', '256', '190', '180', '193', '192', '212', '154', '155', '156', '152');
        }
        if ($id == 'worldbangla') {
            $rid = array('47', '49', '52', '55', '54', '56', '57', '147',
                '163', '166', '146', '148', '149', '167', '60', '59', '162',
                '61', '62', '63', '64', '66', '164', '67', '68', '255', '53',
                '153', '65', '211', '151');
        }
        if ($id == 'sports') {
            $rid = array('169', '204', '205', '347');
        }
        if ($id == 'entertainment') {
            $rid = array('168', '194', '195', '196', '197', '199');
        }
        if ($id == 'health') {
            $rid = array('170', '201', '202', '203');
        }
        if ($id == 'technology') {
            $rid = array('348', '208', '207', '213');
        }
        if ($id == 'literature') {
            $rid = array('33', '76', '237', '238', '239', '240', '241', '242', '243', '244', '245', '246', '247', '248', '249', '250', '266');
        }
        if ($id == 'crime') {
            $rid = array('220', '218', '219');
        }
        if ($id == 'amazing') {
            $rid = array('231', '230');
        }
        if ($id == 'knownunknown') {
            $rid = array('227', '226', '225', '228', '229');
        }
        if ($id == 'districts') {
            $rid = array('77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92',
                '93', '94', '95', '96', '97', '98', '99', '100', '101', '102', '103', '104', '105', '106', '107', '108',
                '109', '110', '111', '112', '113', '114', '115', '116', '117', '118', '119', '120', '121', '122', '123',
                '124', '125', '126', '127', '128', '129', '130', '131', '132', '133', '134', '135', '136', '137', '138',
                '139', '140', '258', '259', '260', '261', '262', '263', '264');
        }
        if ($id == 'muktomoncho') {
            $rid = array('50');
        }

        $this->db->order_by('n_id', 'desc');
        $this->db->limit('50');
        $this->db->select('n_id,n_head,n_details,main_image');
        $this->db->select("DATE_FORMAT(post_time, '%a, %e %b %Y %T') as formatted_date", FALSE);
        if ($id != 'general') {
            $this->db->where_in('n_category', $rid);
        }
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

}