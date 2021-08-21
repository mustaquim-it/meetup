<?php

class Participant_model extends CI_Model{
  
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->tbl_name = 'tbl_participants';
  }

  public function get_participants(){

    $this->db->select("*");
    $this->db->from($this->tbl_name);
    $query = $this->db->get();

    return $query->result();
  }

  public function insert_participant($data = array()){
      return $this->db->insert($this->tbl_name, $data);
  }

  public function update_participant_information($id, $informations){
    $ql = $this->db->select('id')->from($this->tbl_name)->where('id',$id)->get();
    $count = $ql->num_rows(); //counting result from query
    if($count === 0){
      return false;
    }else{
      $this->db->where("id", $id);
      return $this->db->update($this->tbl_name, $informations);
    }
  }

  // Fetch records
  public function getData($rowno,$rowperpage,$search="") {
 
    $this->db->select('*');
    $this->db->from($this->tbl_name);

    if($search != ''){
      $this->db->like('name', $search);
      $this->db->or_like('locality', $search);
    }

    $this->db->limit($rowperpage, $rowno); 
    $query = $this->db->get();
 
    return $query->result_array();
  }

  // Select total records
  public function getrecordCount($search = '') {

    $this->db->select('count(id) as allcount');
    $this->db->from($this->tbl_name);
 
    if($search != ''){
      $this->db->like('name', $search);
      $this->db->or_like('locality', $search);
    }

    $query = $this->db->get();
    $result = $query->result_array();
 
    return $result[0]['allcount'];
  }
}

 ?>
