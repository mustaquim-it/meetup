<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participant extends CI_Controller {
    public function __construct(){
        parent::__construct();    
        $this->load->database(); //load database
        $this->load->model(array("api/participant_model")); //load model
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index(){
        if($this->session->userdata('search') != NULL){ //destroy session on reload of page
            $this->session->unset_userdata('search');
        }
        redirect('Participant/loadRecord');        
    }

    public function loadRecord($rowno=0){
        $base_url = base_url().'participant/loadRecord';
        // Search text
        $search_text = "";
        if($this->input->post('submit') != NULL ){
          $search_text = $this->input->post('search');
          $this->session->set_userdata(array("search"=>$search_text));
        }else{
          if($this->session->userdata('search') != NULL){
            $search_text = $this->session->userdata('search');
          }
        }
        // $participants = $this->participant_model->get_participants();
        // Row per page
        $rowperpage = 5;
    
        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
     
        // All records count
        $allcount = $this->participant_model->getrecordCount($search_text);
    
        // Get records
        $participants_record = $this->participant_model->getData($rowno,$rowperpage,$search_text);
     
        // Pagination Configuration
        $config['base_url'] = $base_url;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;
    
        // Initialize
        $this->pagination->initialize($config);
     
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $participants_record;
        $data['row'] = $rowno;
        $data['search'] = $search_text;
        $data['search_url'] = $base_url;
    
        // Load view
        $this->load->view('participant_view',$data);
     
    }
}
