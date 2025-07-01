<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Weblink extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
    }

    ///->weblink Start


    function website_link() {
        $data['body'] = 'web_link';
        $data['wl_info'] = $this->M_weblink->wl_list();
        $data['wl_tag_list'] = $this->M_weblink->wl_tag_list();
        $this->load->view('admin/template', $data);
    }

    function wl_entry() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Columnist Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $wl_id = $this->M_weblink->wl_entry();
                //print_r($wl_id);

                $config['file_name'] = $wl_id;
                $config['upload_path'] = './assets/images/link_resource/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //print_r($filedata);
                    $this->M_weblink->wladdPicture($filedata['file_name'], $wl_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/link_resource/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/link_resource/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 50;
                    $con['height'] = 40;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Weblink Link Successfully Created');
                    redirect('admin/weblink/website_link', 'refresh');
                }

                $this->session->set_flashdata('message', 'Weblink Link Successfully Created');
                redirect('admin/weblink/website_link', 'refresh');
            } else {
                $data['body'] = 'website_link';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'website_link';
            $this->load->view('admin/template', $data);
        }
    }

    function wl_edit_page($wl_id) {
        $data['body'] = 'edit_web_link';
        $data['wl_info'] = $this->M_weblink->getwlbyid($wl_id);
        $data['wl_tag_list'] = $this->M_weblink->wl_tag_list();
        $this->load->view('admin/template', $data);
    }

    function wl_edit() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Columnist Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->M_weblink->wl_edit();
                $wl_id = $this->input->post('wl_id');
                //print_r($wl_id);

                $config['file_name'] = $wl_id;
                $config['upload_path'] = './assets/images/link_resource/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->M_weblink->getwlbyid($wl_id);
                    if ($img['wl_pic_location'] != NULL) {
                        $picture = './assets/images/link_resource/' . $img['wl_pic_location'];
                        $picture_thumbs = './assets/images/link_resource/thmubs/' . $img['wl_pic_location'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    //print_r($filedata);
                    $this->M_weblink->wladdPicture($filedata['file_name'], $wl_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/link_resource/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/link_resource/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 50;
                    $con['height'] = 40;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Columnist Profile Successfully Updated');
                    redirect('admin/weblink/website_link', 'refresh');
                }

                $this->session->set_flashdata('message', 'Columnist Profile Successfully Updated');
                redirect('admin/weblink/website_link', 'refresh');
            } else {
                $data['body'] = 'web_link';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'web_link';
            $this->load->view('admin/template', $data);
        }
    }

    function wl_delete($wl_id) {
        $img = $this->M_weblink->getwlbyid($wl_id);
        if ($img['wl_pic_location'] != NULL) {
            $picture = './assets/images/link_resource/' . $img['wl_pic_location'];
            $picture_thumbs = './assets/images/link_resource/thmubs/' . $img['wl_pic_location'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->M_weblink->wl_delete($wl_id);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/weblink/website_link');
    }

    ///->weblink End
    ///Tag Entry

    function website_link_tag() {
        $this->M_weblink->wl_tag_entry();        
        $this->session->set_flashdata('message', 'Tag Successfully Saved');
        redirect('admin/weblink/website_link');
    }   

    function website_tag_delete($wl_tag_id) {
        $this->M_weblink->wl_tag_delete($wl_tag_id);
        $this->session->set_flashdata('message', 'Tag Deleted');
        redirect('admin/weblink/website_link');
    }

}
