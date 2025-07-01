<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
    }

    function index() {
        $data['body'] = 'profile_list';        
        $data['writer_info'] = $this->M_profile->writer_list();
        $this->load->view('admin/template', $data);
    }

    function p_entry() {
        if ($this->input->post('name_bangla')) {
            $this->form_validation->set_rules('name_bangla', 'Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $p_id = $this->M_profile->p_entry();

                $config['file_name'] = $p_id;
                $config['upload_path'] = './assets/images/profile_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    
                } else {
                    $filedata = $this->upload->data();
                    //print_r($filedata);
                    $this->M_profile->PaddPicture($filedata['file_name'], $p_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/profile_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/profile_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'New Profile Successfully Created');
                    redirect('admin/profile/', 'refresh');
                }

                $this->session->set_flashdata('message', 'New Profile Successfully Created');
                redirect('admin/profile/', 'refresh');
            } else {
                $data['body'] = 'profile_list';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'profile_list';
            $data['col_info'] = $this->M_profile->columnist_list();
            $data['writer_info'] = $this->M_profile->writer_list();
            $this->load->view('admin/template', $data);
        }
    }

    function p_edit_page($p_id) {
        $data['body'] = 'edit_profile';
        $data['p_info'] = $this->M_profile->getPbyid($p_id);
        $this->load->view('admin/template', $data);
    }

    function p_edit() {
        if ($this->input->post('name_bangla')) {
            $this->form_validation->set_rules('name_bangla', 'Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->M_profile->p_edit();
                $p_id = $this->input->post('p_id');
                //print_r($col_id);

                $config['file_name'] = $p_id;
                $config['upload_path'] = './assets/images/profile_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->M_profile->getPbyid($p_id);
                    if ($img['p_pic'] != NULL) {
                        $picture = './assets/images/profile_image/' . $img['p_pic'];
                        $picture_thumbs = './assets/images/profile_image/thmubs/' . $img['p_pic'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    //print_r($filedata);
                    $this->M_profile->PaddPicture($filedata['file_name'], $p_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/profile_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/profile_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 50;
                    $con['height'] = 40;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Profile Info Successfully Updated');
                    redirect('admin/profile/', 'refresh');
                }

                $this->session->set_flashdata('message', 'Profile Info Successfully Updated');
                redirect('admin/profile/', 'refresh');
            } else {
                $data['body'] = 'profile_list';
                $data['col_info'] = $this->M_profile->columnist_list();
                $data['writer_info'] = $this->M_profile->writer_list();
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'profile_list';
            $data['col_info'] = $this->M_profile->columnist_list();
            $data['writer_info'] = $this->M_profile->writer_list();
            $this->load->view('admin/template', $data);
        }
    }

    function p_delete($p_id) {
        $img = $this->M_profile->getPbyid($p_id);
        if ($img['p_pic'] != NULL) {
            $picture = './assets/images/profile_image/' . $img['p_pic'];
            $picture_thumbs = './assets/images/profile_image/thmubs/' . $img['p_pic'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->M_profile->p_delete($p_id);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/profile/');
    }

    ///->columnist profile End
///->NRB profile Start

    function nrb() {
        $data['body'] = 'nrb';
        $data['nrb_info'] = $this->M_profile->nrb_list();
        $this->load->view('admin/template', $data);
    }

    function nrb_entry() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Columnist Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $nrb_id = $this->M_profile->nrb_entry();
                //print_r($nrb_id);

                $config['file_name'] = $nrb_id;
                $config['upload_path'] = './assets/images/nrb_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //print_r($filedata);
                    $this->M_profile->nrbaddPicture($filedata['file_name'], $nrb_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/nrb_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/nrb_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Columnist Profile Successfully Created');
                    redirect('admin/profile/nrb', 'refresh');
                }

                $this->session->set_flashdata('message', 'Columnist Profile Successfully Created');
                redirect('admin/profile/nrb', 'refresh');
            } else {
                $data['body'] = 'nrb';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'nrb';
            $this->load->view('admin/template', $data);
        }
    }

    function nrb_edit_page($nrb_id) {
        $data['body'] = 'edit_nrb';
        $data['nrb_info'] = $this->M_profile->getnrbbyid($nrb_id);
        $this->load->view('admin/template', $data);
    }

    function nrb_edit() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Columnist Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->M_profile->nrb_edit();
                $nrb_id = $this->input->post('nrb_id');
                //print_r($nrb_id);

                $config['file_name'] = $nrb_id;
                $config['upload_path'] = './assets/images/nrb_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->M_profile->getnrbbyid($nrb_id);
                    if ($img['nrb_pic_location'] != NULL) {
                        $picture = './assets/images/nrb_image/' . $img['nrb_pic_location'];
                        $picture_thumbs = './assets/images/nrb_image/thmubs/' . $img['nrb_pic_location'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    //print_r($filedata);
                    $this->M_profile->nrbaddPicture($filedata['file_name'], $nrb_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/nrb_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/nrb_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Columnist Profile Successfully Updated');
                    redirect('admin/profile/nrb', 'refresh');
                }

                $this->session->set_flashdata('message', 'Columnist Profile Successfully Updated');
                redirect('admin/profile/nrb', 'refresh');
            } else {
                $data['body'] = 'nrb';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'nrb';
            $this->load->view('admin/template', $data);
        }
    }

    function nrb_delete($nrb_id) {
        $img = $this->M_profile->getnrbbyid($nrb_id);
        if ($img['nrb_pic_location'] != NULL) {
            $picture = './assets/images/nrb_image/' . $img['nrb_pic_location'];
            $picture_thumbs = './assets/images/nrb_image/thmubs/' . $img['nrb_pic_location'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->M_profile->nrb_delete($nrb_id);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/profile/nrb');
    }

    ///->NRB profile End
    ///->NRB Writer Start

    function nrbwriter() {
        $data['body'] = 'nrbwriter';
        $data['nrbwriter_info'] = $this->M_profile->nrbwriter_list();
        $this->load->view('admin/template', $data);
    }

    function nrbwriter_entry() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'NRB Writer Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $col_id = $this->M_profile->nrbwriter_entry();
                //print_r($col_id);

                $config['file_name'] = $col_id;
                $config['upload_path'] = './assets/images/nrbwriter_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //print_r($filedata);
                    $this->M_profile->nrbwriteraddPicture($filedata['file_name'], $col_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/nrbwriter_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/nrbwriter_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Columnist Profile Successfully Created');
                    redirect('admin/profile/nrbwriter', 'refresh');
                }

                $this->session->set_flashdata('message', 'Columnist Profile Successfully Created');
                redirect('admin/profile/nrbwriter', 'refresh');
            } else {
                $data['body'] = 'nrbwriter';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'nrbwriter';
            $this->load->view('admin/template', $data);
        }
    }

    function nrbwriter_edit_page($col_id) {
        $data['body'] = 'edit_nrbwriter';
        $data['nrbwriter_info'] = $this->M_profile->getnrbwriterbyid($col_id);
        $this->load->view('admin/template', $data);
    }

    function nrbwriter_edit() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'NRB Writer Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->M_profile->nrbwriter_edit();
                $col_id = $this->input->post('col_id');
                //print_r($col_id);

                $config['file_name'] = $col_id;
                $config['upload_path'] = './assets/images/nrbwriter_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->M_profile->getnrbwriterbyid($col_id);
                    if ($img['col_pic_location'] != NULL) {
                        $picture = './assets/images/nrbwriter_image/' . $img['col_pic_location'];
                        $picture_thumbs = './assets/images/nrbwriter_image/thmubs/' . $img['col_pic_location'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    //print_r($filedata);
                    $this->M_profile->nrbwriteraddPicture($filedata['file_name'], $col_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/nrbwriter_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/nrbwriter_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Columnist Profile Successfully Updated');
                    redirect('admin/profile/nrbwriter', 'refresh');
                }

                $this->session->set_flashdata('message', 'Columnist Profile Successfully Updated');
                redirect('admin/profile/nrbwriter', 'refresh');
            } else {
                $data['body'] = 'nrbwriter';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'nrbwriter';
            $this->load->view('admin/template', $data);
        }
    }

    function nrbwriter_delete($col_id) {
        $img = $this->M_profile->getnrbwriterbyid($col_id);
        if ($img['col_pic_location'] != NULL) {
            $picture = './assets/images/nrbwriter_image/' . $img['col_pic_location'];
            $picture_thumbs = './assets/images/nrbwriter_image/thmubs/' . $img['col_pic_location'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->M_profile->nrbwriter_delete($col_id);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/profile/nrbwriter');
    }

    ///->NRB Writer End
    ///->NRB cultural profile Start

    function cultural_personality() {
        $data['body'] = 'nrb_cultural';
        $data['nrb_cultural_info'] = $this->M_profile->nrb_cultural_list();
        $this->load->view('admin/template', $data);
    }

    function cultural_entry() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'cultural personality', 'required');
            if ($this->form_validation->run() == TRUE) {
                $nrb_cultural_id = $this->M_profile->nrb_cultural_entry();

                $config['file_name'] = $nrb_cultural_id;
                $config['upload_path'] = './assets/images/nrb_cultural/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //print_r($filedata);
                    $this->M_profile->nrbculturaladdPicture($filedata['file_name'], $nrb_cultural_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/nrb_cultural/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/nrb_cultural/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Cultural Profile Successfully Created');
                    redirect('admin/profile/cultural_personality', 'refresh');
                }

                $this->session->set_flashdata('message', 'Cultural Profile Successfully Created');
                redirect('admin/profile/cultural_personality', 'refresh');
            } else {
                $data['body'] = 'nrb_cultural';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'nrb_cultural';
            $this->load->view('admin/template', $data);
        }
    }

    function cultural_edit_page($nrb_cultural_id) {
        $data['body'] = 'edit_nrb_cultural';
        $data['nrb_cultural_info'] = $this->M_profile->getnrbculturalbyid($nrb_cultural_id);
        $this->load->view('admin/template', $data);
    }

    function cultural_edit() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'cultural personality', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->M_profile->nrb_cultural_edit();
                $nrb_cultural_id = $this->input->post('nrb_cultural_id');
                //print_r($nrb_id);

                $config['file_name'] = $nrb_cultural_id;
                $config['upload_path'] = './assets/images/nrb_cultural/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->M_profile->getnrbculturalbyid($nrb_cultural_id);
                    if ($img['nrb_cultural_pic_location'] != NULL) {
                        $picture = './assets/images/nrb_cultural/' . $img['nrb_cultural_pic_location'];
                        $picture_thumbs = './assets/images/nrb_cultural/thmubs/' . $img['nrb_cultural_pic_location'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    //print_r($filedata);
                    $this->M_profile->nrbculturaladdPicture($filedata['file_name'], $nrb_cultural_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/nrb_cultural/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/nrb_cultural/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Cultural Profile Successfully Updated');
                    redirect('admin/profile/cultural_personality', 'refresh');
                }

                $this->session->set_flashdata('message', 'Cultural Profile Successfully Updated');
                redirect('admin/profile/cultural_personality', 'refresh');
            } else {
                $data['body'] = 'nrb_cultural';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'nrb_cultural';
            $this->load->view('admin/template', $data);
        }
    }

    function cultural_delete($nrb_cultural_id) {
        $img = $this->M_profile->getnrbculturalbyid($nrb_cultural_id);
        if ($img['nrb_cultural_pic_location'] != NULL) {
            $picture = './assets/images/nrb_cultural/' . $img['nrb_cultural_pic_location'];
            $picture_thumbs = './assets/images/nrb_cultural/thmubs/' . $img['nrb_cultural_pic_location'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->M_profile->nrb_cultural_delete($nrb_cultural_id);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/profile/cultural_personality');
    }

    ///->NRB cultural profile End
    ///->WHO is WHO

    function wiw() {
        $data['body'] = 'wiw';
        $data['wiw_info'] = $this->M_profile->wiw_list();
        $data['ww_list'] = $this->M_profile->ww_category_list();
        $this->load->view('admin/template', $data);
    }

    function wiw_entry() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $wiw_id = $this->M_profile->wiw_entry();
                //print_r($wiw_id);

                $config['file_name'] = $wiw_id;
                $config['upload_path'] = './assets/images/wiw_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //print_r($filedata);
                    $this->M_profile->wiwaddPicture($filedata['file_name'], $wiw_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/wiw_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/wiw_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Profile Successfully Created');
                    redirect('admin/profile/wiw', 'refresh');
                }

                $this->session->set_flashdata('message', 'Profile Successfully Created');
                redirect('admin/profile/wiw', 'refresh');
            } else {
                $data['body'] = 'wiw';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'wiw';
            $this->load->view('admin/template', $data);
        }
    }

    function wiw_edit_page($wiw_id) {
        $data['body'] = 'edit_wiw';
        $data['ww_list'] = $this->M_profile->ww_category_list();
        $data['wiw_info'] = $this->M_profile->getwiwbyid($wiw_id);
        $this->load->view('admin/template', $data);
    }

    function wiw_edit() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Columnist Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->M_profile->wiw_edit();
                $wiw_id = $this->input->post('wiw_id');
                //print_r($wiw_id);

                $config['file_name'] = $wiw_id;
                $config['upload_path'] = './assets/images/wiw_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->M_profile->getwiwbyid($wiw_id);
                    if ($img['wiw_pic_location'] != NULL) {
                        $picture = './assets/images/wiw_image/' . $img['wiw_pic_location'];
                        $picture_thumbs = './assets/images/wiw_image/thmubs/' . $img['wiw_pic_location'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    //print_r($filedata);
                    $this->M_profile->wiwaddPicture($filedata['file_name'], $wiw_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/wiw_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/wiw_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Profile Successfully Updated');
                    redirect('admin/profile/wiw', 'refresh');
                }

                $this->session->set_flashdata('message', 'Profile Successfully Updated');
                redirect('admin/profile/wiw', 'refresh');
            } else {
                $data['body'] = 'wiw';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'wiw';
            $this->load->view('admin/template', $data);
        }
    }

    function wiw_delete($wiw_id) {
        $img = $this->M_profile->getwiwbyid($wiw_id);
        if ($img['wiw_pic_location'] != NULL) {
            $picture = './assets/images/wiw_image/' . $img['wiw_pic_location'];
            $picture_thumbs = './assets/images/wiw_image/thmubs/' . $img['wiw_pic_location'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->M_profile->wiw_delete($wiw_id);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/profile/wiw');
    }

    ///Category
    function ww_cat_entry() {
        $this->M_profile->ww_category_entry();
        $this->session->set_flashdata('message', 'Category Successfully Saved');
        redirect('admin/profile/wiw');
    }

    function cat_edit_page($ww_id) {
        $data['body'] = 'ww_cat_edit_page';
        $data['cat'] = $this->M_profile->cat_edit_page($ww_id);
        $this->load->view('admin/template', $data);
    }

    function cat_edit() {
        $this->M_profile->cat_edit();
        $this->session->set_flashdata('message', 'Category Successfully Updated');
        redirect('admin/profile/wiw');
    }

    function ww_cat_delete($ww_id) {
        $this->M_profile->ww_cat_delete($ww_id);
        $this->session->set_flashdata('message', 'Category Deleted');
        redirect('admin/profile/wiw');
    }

    ///->WHO is WHO End
}
