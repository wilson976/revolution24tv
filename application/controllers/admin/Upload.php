<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/files_model');
        $this->load->database();
        $this->load->helper('url');
    }

    /*
      public function index() {
      $this->load->view('upload');
      }
     */
    public function upload_file() {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';
        /*   if (empty($_POST['caption'])) {
          $status = "error";
          $msg = "Please enter a caption";
          } */
        if ($status != "error") {
            $config['upload_path'] = './assets/news_images/';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt|jpeg';
            $config['max_size'] = 1024 * 10;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $file_id = $this->files_model->insert_file($data['file_name'], $_POST['caption'], $_POST['c_id']);

                if ($file_id) {

                    $con['image_library'] = 'GD2';
                    $con['source_image'] = './assets/news_images/' . $data['file_name'];
                    $con['new_image'] = './assets/news_images/' . mythumb($data['file_name']);
                    $con['maintain_ratio'] = TRUE;
                    $con['width'] = 91;
                    $con['height'] = 70;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $con['source_image'] = './assets/news_images/' . $data['file_name'];
                    $con['new_image'] = './assets/news_images/' . mymediam($data['file_name']);
                    $con['maintain_ratio'] = TRUE;
                    $con['width'] = 340;
                    $con['height'] = 210;
                    $this->image_lib->initialize($con);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    /*
                    $configwater['image_library'] = 'gd2';
                    $configwater['source_image'] = './assets/news_images/' . $data['file_name'];
                    $configwater['new_image'] = './assets/news_images/' . $data['file_name'];
                    $configwater['wm_text'] = 'www.banglaoutlook.com';
                    $configwater['wm_type'] = 'text';
                    $configwater['wm_font_size'] = '16';
                    $configwater['wm_font_color'] = 'FF0000';
                    $configwater['wm_vrt_alignment'] = 'middle';
                    $configwater['wm_hor_alignment'] = 'center';

                    $this->image_lib->initialize($configwater);
                    $this->image_lib->watermark();
                    $this->image_lib->clear();*/

                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function files($c_id) {
        $files = $this->files_model->get_files($c_id);
        $this->load->view('admin/news/files', array('files' => $files));
    }

    public function delete_file($p_id) {
        if ($this->files_model->delete_file($p_id)) {
            $status = 'success';
            $msg = 'File successfully deleted';
        } else {
            $status = 'error';
            $msg = 'Something went wrong when deleteing the file, please try again';
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}
