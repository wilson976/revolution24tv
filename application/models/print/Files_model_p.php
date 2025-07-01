<?php

class Files_Model_p extends CI_Model {

    public function insert_file($filename, $caption, $cat_id) {
        $data = array(
            'n_pic_name' => $filename,
            'pic_caption' => $caption,
            'cat_id' => $cat_id
        );
        $this->db->insert('picture', $data);
     //   echo $this->db->last_query();
        return $this->db->insert_id();
    }

    public function get_files($cat_id) {

        return $this->db->select()
                ->limit(10)
                ->where('cat_id', $cat_id)
                ->order_by('p_id', 'desc')
                ->from('picture')
                ->get()
                ->result();
    }

    public function delete_file($p_id) {
        $file = $this->get_file($p_id);
        if (!$this->db->where('p_id', $p_id)->delete('picture')) {
            return FALSE;
        }
        unlink('./assets/news_images/' . mythumb($file->n_pic_name));
        unlink('./assets/news_images/' . mymediam($file->n_pic_name));
        unlink('./assets/news_images/' . $file->n_pic_name);
        return TRUE;
    }

    public function get_file($p_id) {
        return $this->db->select()
                ->from('picture')
                ->where('p_id', $p_id)
                ->get()
                ->row();
    }

}