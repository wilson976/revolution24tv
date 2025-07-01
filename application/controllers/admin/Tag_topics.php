<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tag_topics extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
         $this->load->model('admin/Mtags_topics'); 
    }

    function index() {
        $data['body'] = 'tag_list';        
        $data['tags_info'] = $this->Mtags_topics->tags_list();
        $this->load->view('admin/template', $data);
    }

    function tag_entry() {
        if ($this->input->post('tag_name')) {
            $this->form_validation->set_rules('tag_name', 'tag_name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $tag_id = $this->Mtags_topics->tags_entry();

                $config['file_name'] = $tag_id;
                $config['upload_path'] = './assets/images/tag_image/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    
                } else {
                    $filedata = $this->upload->data();
                    //print_r($filedata);
                    $this->Mtags_topics->TaddPicture($filedata['file_name'], $tag_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/tag_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/tag_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    // $this->session->set_flashdata('message', 'New tag entry Successfully Created');
                    redirect('admin/tag_topics/tag_entry/', 'refresh');
                }

                // $this->session->set_flashdata('message', 'New tag entry Successfully Created');
                redirect('admin/tag_topics/tag_entry/', 'refresh');
            } else {
                $data['body'] = 'tag_entry';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'tag_entry';
            $this->load->view('admin/template', $data);
        }
    }

    function tag_edit_page($tag_id) {
        $data['body'] = 'edit_tag_topics';
        $data['tag_info'] = $this->Mtags_topics->getTagbyid($tag_id);
        $this->load->view('admin/template', $data);
    }

    function tag_edit() {
        if ($this->input->post('tag_name')) {
            $this->form_validation->set_rules('tag_name', 'tag_name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->Mtags_topics->tag_edit();
                $tag_id = $this->input->post('tag_id');
                //print_r($col_id);

                $config['file_name'] = $tag_id;
                $config['upload_path'] = './assets/images/tag_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("tag_image")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->Mtags_topics->getTagbyid($tag_id);
                    if ($img['tag_image'] != NULL) {
                        $picture = './assets/images/tag_image/' . $img['tag_image'];
                        $picture_thumbs = './assets/images/tag_image/thmubs/' . $img['tag_image'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    //print_r($filedata);
                    $this->Mtags_topics->TaddPicture($filedata['file_name'], $tag_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/tag_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/tag_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 50;
                    $con['height'] = 40;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    // $this->session->set_flashdata('message', 'tag entry Info Successfully Updated');
                    redirect('admin/tag_topics/tag_entry/', 'refresh');
                }

                // $this->session->set_flashdata('message', 'tag entry Info Successfully Updated');
                redirect('admin/tag_topics/tag_entry/', 'refresh');
            } else {
                $data['body'] = 'tag_list';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'tag_list';
            $this->load->view('admin/template', $data);
        }
    }

    function tag_delete($tag_id) {
        $img = $this->Mtags_topics->getTagbyid($tag_id);
        if ($img['tag_image'] != NULL) {
            $picture = './assets/images/tag_image/' . $img['tag_image'];
            $picture_thumbs = './assets/images/tag_image/thmubs/' . $img['tag_image'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->Mtags_topics->tag_delete($tag_id);
        // $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/tag_topics/tag_entry/');
    }

    ///->columnist tag_entry End

}
