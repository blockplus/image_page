<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    function __construct() {
        parent::__construct();

        Utils::no_cache();
    }
    
    public function index() {
        $data['title'] = 'Image Search - About';

        $this->load->model('content_model');
        $data['content'] = $this->content_model->get_content('about');

        // Get Advertise
        $this->load->model('advertise_model');

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
        $data['advertise_items'] = $items;

        $this->load->view('includes/header', $data);
        $this->load->view('includes/mce_header');
        $this->load->view('about/index');
        $this->load->view('includes/footerbar2');
        $this->load->view('includes/footer');
    }

}
