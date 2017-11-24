<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    var $session_user;

    function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->session_user = $this->session->userdata('logged_in');

        $this->load->helper(array('form', 'url')); 
    }

    /*
     * 
     */

    public function index() {
        redirect(base_url('admin/manage'));
    }

    public function manage($offset = 0) {
        $this->load->library('session');
            
        $data['title'] = 'Admin - Manage';
        $data['active'] = 'manage';
        $data['session_user'] = $this->session_user;

        $this->load->model('bank_model');

        if (count($_POST) > 0 && isset($_POST['delete'])) {
            $id = $_POST['id'];
            $row = $this->bank_model->get_row($id);

            $filename = $row[0]->{'tb_image'};
            $root_dir = $this->config->item('base_directory');
            $dst_filename = $root_dir . BANK_PATH . $filename;
            $dst_thumb_filename = $root_dir . BANK_THUMB_PATH . $filename;
            if (file_exists($dst_filename)) {
                unlink($dst_filename);
            }
            if (file_exists($dst_thumb_filename)) {
                unlink($dst_thumb_filename);
            }
            $this->bank_model->delete($id);

            $base_engine_url = $this->config->item('base_engine_url');
            $result_json = Utils::getCurlPost($base_engine_url.API_DELETE_IMAGE, '');
        }
        else if (count($_POST) > 0 && isset($_POST['edit'])) {
            $id = $_POST['id'];
            $row = $this->bank_model->get_row($id);

            $data['item'] = $row[0];
            $this->load->view('admin/includes/header', $data);
            $this->load->view('admin/includes/navbar');
            $this->load->view('admin/editDialog');
            $this->load->view('admin/includes/footer');
            return;
        }
        else if  (count($_POST) > 0 && isset($_POST['submit_search'])) {
            $search_text = @$_POST['search_text'] ? $_POST['search_text'] : '';
            $this->session->set_userdata('manage_search_text', $search_text);
            $offset = 0;
        }

        $data['search_text'] = $this->session->userdata('manage_search_text');
        // Get data
        $this->load->library('pagination');

        $rows = $this->bank_model->get_search_rows($data['search_text'], 10, $offset);
        $search_count = $this->bank_model->get_search_count($data['search_text'], 10, $offset);
        $data['items'] = $rows;
        $data['search_count'] = $search_count;
        $data['total_count'] = $this->bank_model->get_total_count();
        // $rows = $this->bank_model->get_rows($config['per_page'],$offset);

        //pagination settings
        $config['base_url'] = site_url('admin/manage');
        $config['total_rows'] = $search_count;
        $config['per_page'] = 10;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);

        /*
         * Load view
         */
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/includes/navbar');
        $this->load->view('admin/manage');
        $this->load->view('admin/includes/footer');
    }

    public function edit_item()
    {
        if (count($_POST) > 0 && isset($_POST['save'])) {
            
            $this->load->model('bank_model');

            $update_data = array(
                'tb_id' => $_POST['id'],
                'tb_title' => $_POST['title'], 
                'tb_desc' => $_POST['description'], 
                'tb_url' => $_POST['link']
            );

            $this->bank_model->update($update_data);
            redirect(base_url('admin/manage'));
        }
    }

    public function upload() {
        $data['title'] = 'Admin - Upload';
        $data['active'] = 'upload';
        $data['session_user'] = $this->session_user;

        $this->load->model('bank_model');

        if (count($_POST)) {
            
            if ($_POST['type'] == 'file') {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $link = $_POST['link'];

                $config = array(
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'max_size' => "3096000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "1024",
                    'max_width' => "1360"
                );
                $this->load->library('upload', $config);
                if($this->upload->do_upload())
                {
                    $uploaded_data = array('upload_data' => $this->upload->data());

                    $orig_file = $uploaded_data['upload_data']['full_path'];

                    $orig_name = $uploaded_data['upload_data']['orig_name'];
                    $filename = time()."_".$uploaded_data['upload_data']['orig_name'];
                    $root_dir = $this->config->item('base_directory');
                    $dst_filename = $root_dir . BANK_PATH . $filename;
                    $dst_thumb_filename = $root_dir . BANK_THUMB_PATH . $filename;
                    
                    // make thumb image
                    $ret = $this->imageResize($orig_file, $dst_filename, 320);
                    $ret = $this->imageResize($orig_file, $dst_thumb_filename, 160);
                    if (file_exists($orig_file)) {
                        unlink($orig_file);
                    }

                    // add to db
                    //SELECT `tb_id`, `tb_image`, `tb_title`, `tb_desc`, `tb_url` FROM `tbl_bank` WHERE 1
                    $insert_data = array(
                        'tb_image' => $filename,
                        'tb_title' => $title, 
                        'tb_desc' => $description, 
                        'tb_url' => $link
                    );

                    if (!$this->is_existing($insert_data)) {
                        $id = $this->bank_model->insert($insert_data);

                        $notif = array();
                        $notif['message'] = 'Uploaded successfully !';
                        $notif['type'] = 'success';
                        $data['notif'] = $notif;

                        $root_dir = $this->config->item('base_directory');
                        $base_engine_url = $this->config->item('base_engine_url');
                        $params = array(
                            'image'  => $dst_filename
                        );
                        $result_json = Utils::getCurlPost($base_engine_url.API_ADD_IMAGE, $params);
                    } else {
                        unlink($dst_filename);
                        unlink($dst_thumb_filename);

                        $notif = array();
                        $notif['message'] = 'Already existing !';
                        $notif['type'] = 'warning';
                        $data['notif'] = $notif;
                    }
                }
                else
                {
                    $notif = array();
                    $notif['message'] = 'Upload error !';
                    $notif['type'] = 'warning';
                    $data['notif'] = $notif;
                }
            }
            else if ($_POST['type'] == 'batch') {
                $root_dir = $this->config->item('base_directory');
                $filename = $_POST['excel_file'];
                $excel_filename = $root_dir . BATCH_PATH . $filename;

                //load the excel library
                $this->load->library('excel');
                 
                //read file from path
                try {
                    $objPHPExcel = PHPExcel_IOFactory::load($excel_filename);
                } catch (Exception $e) {
                    $notif = array();
                    $notif['message'] = 'Excel file doesn\'t exist !';
                    $notif['type'] = 'warning';
                    $data['notif'] = $notif;

                    $objPHPExcel = false;
                }
                
                if ($objPHPExcel) {
                    //get only the Cell Collection
                    $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                     
                    //extract to a PHP readable array format
                    foreach ($cell_collection as $cell) {
                        $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                        $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                        $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                     
                        //header will/should be in row 1 only. of course this can be modified to suit your need.
                        if ($row == 1) {
                            $header[$row][$column] = $data_value;
                        } else {
                            $arr_data[$row][$column] = $data_value;
                        }
                    }
                     
                    //send the data in an array format
                    $data['header'] = $header;
                    $data['values'] = $arr_data;

                    foreach ($arr_data as $data_row) {
                        $image = $data_row['A']; 
                        $title = $data_row['B']; 
                        $description = $data_row['C']; 
                        $link = $data_row['D']; 
        
                        $root_dir = $this->config->item('base_directory');

                        $orig_file = $root_dir . BATCH_PATH . $image;
                        $orig_name = $image;
                        $filename = time()."_".$orig_name;
                        $dst_filename = $root_dir . BANK_PATH . $filename;
                        $dst_thumb_filename = $root_dir . BANK_THUMB_PATH . $filename;
                        
                        if (!file_exists($orig_file)) {
                            continue;
                        }
                        // make thumb image
                        $ret = $this->imageResize($orig_file, $dst_filename, 320);
                        $ret = $this->imageResize($orig_file, $dst_thumb_filename, 160);

                        // add to db
                        //SELECT `tb_id`, `tb_image`, `tb_title`, `tb_desc`, `tb_url` FROM `tbl_bank` WHERE 1
                        $insert_data = array(
                            'tb_image' => $filename,
                            'tb_title' => $title, 
                            'tb_desc' => $description, 
                            'tb_url' => $link
                        );

                        if (!$this->is_existing($insert_data)) {

                            $id = $this->bank_model->insert($insert_data);
                            if (file_exists($orig_file)) {
                                unlink($orig_file);
                            }

                            $root_dir = $this->config->item('base_directory');
                            $base_engine_url = $this->config->item('base_engine_url');
                            $params = array(
                                'image'  => $dst_filename
                            );
                            $result_json = Utils::getCurlPost($base_engine_url.API_ADD_IMAGE, $params);
                        } else {
                            unlink($dst_filename);
                            unlink($dst_thumb_filename);
                        }
                    }

                    $notif = array();
                    $notif['message'] = 'Batch processed successfully !';
                    $notif['type'] = 'success';
                    $data['notif'] = $notif;
                }
            }
        }
        /*
         * Load view
         */
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/includes/navbar');
        $this->load->view('admin/upload');
        $this->load->view('admin/includes/footer');
    }

    public function content() {
        $data['title'] = 'Admin - Content';
        $data['active'] = 'content';
        $data['session_user'] = $this->session_user;

        $this->load->model('content_model');

        if (count($_POST)) {
            if (@$_POST['submit_policy']) {
                $type = 'policy';
            }
            else if (@$_POST['submit_about']) {
                $type = 'about';
            }
            else if (@$_POST['submit_contact']) {
                $type = 'contact';
            }
            
            if ($type) {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $item = array(
                    'tc_type'   => $type,
                    'tc_title'  => $title,
                    'tc_content'=> $content
                );

                $this->content_model->save($item);

                $notif = array();
                $notif['message'] = 'Saved successfully';
                $notif['type'] = 'success';
                $data['notif']["$type"] = $notif;
            }
        }

        $rows = $this->content_model->get_rows();
        $items = array();
        foreach ($rows as $row) {
            $type = $row->{'tc_type'};
            $content = $row->{'tc_content'};
            $id = $row->{'tc_id'};
            $items[$type] = array(
                'id' => $id,
                'content' => $content,
                'title' => $row->{'tc_title'}
            );
        }
        $data['items'] = $items;
        /*
         * Load view
         */
        $this->load->view('admin/includes/header', $data);
        $this->load->view('includes/mce_header');
        $this->load->view('admin/includes/navbar');
        $this->load->view('admin/content');
        $this->load->view('admin/includes/footer');
    }

    public function advertise() {
        $data['title'] = 'Admin - Advertise';
        $data['active'] = 'advertise';
        $data['session_user'] = $this->session_user;

        $this->load->model('advertise_model');

        if (count($_POST)) {
            if (@$_POST['submit_add']) {
                $config = array(
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg|tiff",
                    'overwrite' => TRUE,
                    'max_size' => "3096000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "1024",
                    'max_width' => "1360"
                );
                $this->load->library('upload', $config);
                if($this->upload->do_upload())
                {
                    $uploaded_data = array('upload_data' => $this->upload->data());
                    $orig_file = $uploaded_data['upload_data']['full_path'];

                    $orig_name = $uploaded_data['upload_data']['orig_name'];
                    $filename = time()."_".$uploaded_data['upload_data']['orig_name'];
                    $root_dir = $this->config->item('base_directory');
                    $dst_filename = $root_dir . ADVERTISE_PATH . $filename;
                    $dst_thumb_filename = $root_dir . ADVERTISE_THUMB_PATH . $filename;
                    
                    // make thumb image
                    $ret = $this->imageResize($orig_file, $dst_filename, 320);
                    $ret = $this->imageResize($orig_file, $dst_thumb_filename, 160);
                    if (file_exists($orig_file)) {
                        unlink($orig_file);
                    }
                    $notif = array();
                    $notif['message'] = 'Uploaded successfully !';
                    $notif['type'] = 'success';
                    $data['notif'] = $notif;

                    ///////////////
                    $link = $_POST['link'];
                    // add to db
                    $insert_data = array(
                        'ta_imagename' => $filename,
                        'ta_link' => $link
                    );
                    $id = $this->advertise_model->insert($insert_data);
                }
                else
                {
                    $notif = array();
                    $notif['message'] = 'Upload error !';
                    $notif['type'] = 'warning';
                    $data['notif'] = $notif;
                }
            }
            else if (@$_POST['submit_delete'])
            {
                $id = $_POST['id'];
                $row = $this->advertise_model->get_row($id);
                
                $filename = $row[0]->{'ta_imagename'};
                $root_dir = $this->config->item('base_directory');
                $dst_filename = $root_dir . ADVERTISE_PATH . $filename;
                $dst_thumb_filename = $root_dir . ADVERTISE_THUMB_PATH . $filename;
                if (file_exists($dst_filename)) {
                    unlink($dst_filename);
                }
                if (file_exists($dst_thumb_filename)) {
                    unlink($dst_thumb_filename);
                }
                $this->advertise_model->delete($id);
            }

            if (!isset($notif)) {
                $notif = array();
                $notif['message'] = 'You request was done successfully';
                $notif['type'] = 'success';
                $data['notif'] = $notif;
            }
        }

        // Get data
        $rows = $this->advertise_model->get_rows();
        $items = array();
        foreach ($rows as $row) {
            $item = array();

            $item['id'] = $row->{'ta_id'};
            $item['imagename'] = $row->{'ta_imagename'};
            $item['link'] = $row->{'ta_link'};
            
            $items[] = $item;
        }
        /*
         * Load view
         */
        $data['items'] = $items;
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/includes/navbar');
        $this->load->view('admin/advertise');
        $this->load->view('admin/includes/footer');
    }

    public function imageResize($source_image, $new_image, $image_size){
        $ext = strtolower(pathinfo($source_image, PATHINFO_EXTENSION));

        if ($ext == 'gif' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') 
        {
            // Configuration
            $config['image_library'] = 'gd2';
            $config['source_image'] = $source_image;
            $config['new_image'] = $new_image;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $image_size;
            $config['height'] = $image_size;
            // Load the Library
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            
            // resize image
            $this->image_lib->resize();
            // handle if there is any problem
            if ( ! $this->image_lib->resize()){
                return false;
            }
            return true;
        }
        else 
        {
            $base_engine_url = $this->config->item('base_engine_url');
            $params = array(
                'source_image'  => $source_image,
                'new_image' => $new_image,
                'image_size' => $image_size
            );
            $result = Utils::getCurlPost($base_engine_url.API_RESIZE_IMAGE, $params);
            if ($result == 'success') {
                return true;
            } else {
                return false;
            }
        }
    }

    public function is_existing($data) {
        // $data = array(
        //     'tb_image' => $filename,
        //     'tb_title' => $title, 
        //     'tb_desc' => $description, 
        //     'tb_url' => $link
        // );
        $this->load->model('bank_model');
        if ($this->bank_model->is_existing($data))
            return true;

        /*
        $root_dir = $this->config->item('base_directory');
        $base_engine_url = $this->config->item('base_engine_url');
        $params = array(
            'image'  => $root_dir . BANK_PATH . $data['tb_image']
        );
        $result_json = Utils::getCurlPost($base_engine_url.API_SIMILAR_IMAGE, $params);
        $result = json_decode($result_json);
        if (count(@$result) > 0 || (@$result->{'similarity'} >= MAX_SIM_FOR_ADD)) {
            return true;
        }//*/
        return false;
    }
}
