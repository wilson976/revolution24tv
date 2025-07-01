<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Photo_gallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
        $this->load->model('File_model');
    }

    //--> Video Module Start
    public function index() {
        $data['body'] = 'photo_list';
        $data['photo'] = $this->M_photo_gallery->photo_list();
        $data['cat_list'] = $this->M_photo_gallery->photo_category_list();
        $data['cat_list_browse'] = $this->M_photo_gallery->photo_category_browse();
        $this->load->view('admin/template', $data);
    }

    function photo_entry() {
        if ($this->input->post('p_category')) {
            $this->form_validation->set_rules('p_category', 'Photo Category', 'required');
            if ($this->form_validation->run() == TRUE) {
                $p_id = $this->M_photo_gallery->photo_entry();
                //print_r($p_id);


                $config['file_name'] = $p_id;
                $config['upload_path'] = './assets/images/photo_gallery/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
//                    print_r($error);
                    $this->session->set_flashdata('message', 'Unknown file Selected');
                } else {
                    $filedata = $this->upload->data();
                    //print_r($filedata);
                    $this->M_photo_gallery->addPicture($filedata['file_name'], $p_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/photo_gallery/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/photo_gallery/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 160;
                    $con['height'] = 115;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();

                    $this->File_model->home1();

                    $this->session->set_flashdata('message', 'Photo Upload Successfull');
                    redirect('admin/photo_gallery/', 'refresh');
                }
 
                    $this->File_model->home1();
                    // $this->File_model->home2();

                $this->session->set_flashdata('message', 'Photo Upload Successfull');
                redirect('admin/photo_gallery/', 'refresh');
            } else {
                $data['body'] = 'photo_list';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'photo_list';
            $this->load->view('admin/template', $data);
        }
    }

    function photo_edit_page($p_id, $p_category) {
        $data['body'] = 'photo_edit_page';
        $data['photo'] = $this->M_photo_gallery->photo_edit_page($p_id, $p_category);
        $data['photo_list'] = $this->M_photo_gallery->photo_category_list();
        $this->load->view('admin/template', $data);
    }

    function photo_edit() {
        $this->M_photo_gallery->photo_edit();
        $this->File_model->home2();

        $this->session->set_flashdata('message', 'Photo Information Successfully Updated');
        redirect('admin/photo_gallery/photo_editdeletelist/'. $_POST['p_category']);
    }

    
    function photo_cat_entry() {
        $this->M_photo_gallery->photo_category_entry();
        $this->session->set_flashdata('message', 'Category Saved Successfully');
        redirect('admin/photo_gallery/');
    }

    function cat_edit_page($g_id) {
        $data['body'] = 'photo_cat_edit_page';
        $data['cat_list'] = $this->M_photo_gallery->photo_category_list();
        $data['cat'] = $this->M_photo_gallery->cat_edit_page($g_id);
        $this->load->view('admin/template', $data);
    }

    function cat_edit() {
        $this->M_photo_gallery->cat_edit();
        $this->session->set_flashdata('message', 'Category Successfully Updated');
        redirect('admin/photo_gallery/');
    }
    
    
    public function photo_catwise($p_category) {
        $data['body'] = 'photo_catwise';
        $data['photo'] = $this->M_photo_gallery->photo_catwise($p_category);
        $data['cat'] = $this->M_photo_gallery->catbyid($p_category);
        $this->load->view('admin/template', $data);
    }

    public function photo_editdeletelist($p_category) {
        $data['body'] = 'photo_editdelete';
        $data['photo'] = $this->M_photo_gallery->photo_catwise($p_category);
        $data['cat'] = $this->M_photo_gallery->catbyid($p_category);
        $this->load->view('admin/template', $data);
    }

    function photo_delete($p_id, $p_category) {
        $img = $this->M_photo_gallery->getphotobyid($p_id);
        if ($img['p_location'] != NULL) {
            $picture = './assets/images/photo_gallery/' . $img['p_location'];
            $picture_thumbs = './assets/images/photo_gallery/thmubs/' . $img['p_location'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->M_photo_gallery->photo_delete($p_id, $p_category);
        
        $this->File_model->home2();

        $this->session->set_flashdata('message', 'Photo Deleted');
        redirect('admin/photo_gallery/photo_editdeletelist/' . $p_category);
    }

    function photo_cat_delete($g_id) {
        $this->M_photo_gallery->photo_cat_delete($g_id);
        $this->session->set_flashdata('message', 'Category Deleted');
        redirect('admin/photo_gallery/');
    }
    
    function video_list(){
        $data['body'] = 'vid_list';
        $data['video'] = $this->M_photo_gallery->video_list();        
        $this->load->view('admin/template', $data);
    }


    function video_entry() {        
        $this->M_photo_gallery->video_entry();
        $this->session->set_flashdata('message', 'Video Saved');
        redirect('admin/photo_gallery/video_list/');
    }
    
    function vid_delete($vid_id) {
        $this->M_photo_gallery->video_delete($vid_id);
        $this->session->set_flashdata('message', 'Video Deleted');
        redirect('admin/photo_gallery/video_list/');
    }


    //->End Photo Gallery
}
