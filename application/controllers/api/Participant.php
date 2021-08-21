<?php
require APPPATH.'libraries/REST_Controller.php';

class Participant extends REST_Controller{

  public function __construct(){
    parent::__construct();    
    $this->load->database(); //load database
    $this->load->model(array("api/participant_model")); //load model
    $this->load->library(array("form_validation"));
    $this->load->helper("security");
  }

  /*
    INSERT: POST REQUEST TYPE
    UPDATE: PUT REQUEST TYPE
    LIST: Get REQUEST TYPE
  */

  // POST: <project_url>/participant
  public function index_post(){
    // insert data method
    //print_r($this->input->post());die;
    $this->form_validation->set_data($this->input->post());
    // form validation for inputs
    $this->form_validation->set_rules("name", "Name", "xss_clean|trim|required|min_length[1]|max_length[25]", array());
    $this->form_validation->set_rules("age", "Age", "xss_clean|trim|required|numeric", array());
    $this->form_validation->set_rules("dob", "DOB", "xss_clean|trim|required", array());
    $this->form_validation->set_rules("profession", "Profession", "xss_clean|trim|required|min_length[1]|max_length[25]", array());
    $this->form_validation->set_rules("locality", "Locality", "xss_clean|trim|required|min_length[1]|max_length[25]", array());
    $this->form_validation->set_rules("guests", "Guests", "xss_clean|trim|required|numeric|less_than[3]", array());
    $this->form_validation->set_rules("address", "Address", "xss_clean|trim|required|max_length[50]", array());

    // custom error message
    $this->form_validation->set_message('less_than', 'Guest range is between 0-2');

    // checking form submittion have any error or not
    if($this->form_validation->run() === FALSE){
      // we have some errors
      $this->response(array(
        "status" => 0,
        "message" => validation_errors()
      ) , REST_Controller::HTTP_NOT_FOUND);
    }else{
      // all values are available
      $participant = array(
        "name" => trim($this->input->post("name")),
        "age" => trim($this->input->post("age")),
        "dob" => trim($this->input->post("dob")),
        "profession" => trim($this->input->post("profession")),
        "locality" => trim($this->input->post("locality")),
        "guests" => trim($this->input->post("guests")),
        "address" => trim($this->input->post("address")),
      );
      // print_r($participant);
      // exit;

      if($this->participant_model->insert_participant($participant)){
        $this->response(array(
          "status" => 1,
          "message" => "participant has been created"
        ), REST_Controller::HTTP_OK);
      }else{
        $this->response(array(
          "status" => 0,
          "message" => "Failed to create participant"
        ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
    }
  }

  // PUT: <project_url>/participant
  public function index_put(){
    // updating data method
    //echo "This is PUT Method";
    $data = json_decode(file_get_contents("php://input"));
    $this->form_validation->set_data($this->put());

    // form validation for inputs
    $this->form_validation->set_rules("name", "Name", "xss_clean|trim|required|min_length[1]|max_length[25]", array());
    $this->form_validation->set_rules("age", "Age", "xss_clean|trim|required|numeric", array());
    $this->form_validation->set_rules("dob", "DOB", "xss_clean|trim|required", array());
    $this->form_validation->set_rules("profession", "Profession", "xss_clean|trim|required|min_length[1]|max_length[25]", array());
    $this->form_validation->set_rules("locality", "Locality", "xss_clean|trim|required|min_length[1]|max_length[25]", array());
    $this->form_validation->set_rules("guests", "Guests", "xss_clean|trim|required|numeric|less_than[3]", array());
    $this->form_validation->set_rules("address", "Address", "xss_clean|trim|required|max_length[50]", array());

    // custom error message
    $this->form_validation->set_message('less_than', 'Guest range is between 0-2');

    // checking form submittion have any error or not
    if($this->form_validation->run() === FALSE){
      // we have some errors
      $this->response(array(
        "status" => 0,
        "message" => validation_errors()
      ) , REST_Controller::HTTP_NOT_FOUND);
    }else{
      if(isset($data->id) && isset($data->name) && isset($data->age) && isset($data->dob) && isset($data->profession) && isset($data->locality) && isset($data->guests) && isset($data->address)){
          $participant_id = trim($data->id);
          $participant_info = array(
              "name" => trim($data->name),"age" => trim($data->age),"dob" => trim($data->dob),"profession" => trim($data->profession),"locality" => trim($data->locality),"guests" => trim($data->guests),"address" => trim($data->address),
          );

          if($this->participant_model->update_participant_information($participant_id, $participant_info)){
              $this->response(array(
                  "status" => 1,
                  "message" => "participant data updated successfully"
              ), REST_Controller::HTTP_OK);
          }else{
              $this->response(array(
              "status" => 0,
              "messsage" => "Failed to update participant data OR participant not found"
              ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          }
      }else{
          $this->response(array(
              "status" => 0,
              "message" => "All fields are needed"
          ), REST_Controller::HTTP_NOT_FOUND);
      }
    }
  }

  // GET: <project_url>/participant
  public function index_get(){
    // list data method
    //echo "This is GET Method";
    // SELECT * from tbl_participants;
    $participants = $this->participant_model->get_participants();

    //print_r($query->result());

    if(count($participants) > 0){
      $this->response(array(
        "status" => 1,
        "message" => "participants found",
        "data" => $participants
      ), REST_Controller::HTTP_OK);
    }else{
      $this->response(array(
        "status" => 0,
        "message" => "No participants found",
        "data" => $participants
      ), REST_Controller::HTTP_NOT_FOUND);
    }
  }

}
?>
