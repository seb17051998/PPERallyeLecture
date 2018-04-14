<?php

class QuestionModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'question','label'=>'Question','rules'=>'required|max_length[255]'),
        array('field'=>'points','label'=>'Points','rules'=>'required|integer'),
        array('field'=>'idQuizz','label'=>'IdQuizz','rules'=>'required|integer')
    );

    function __construct() {
        parent::__construct();
    }

    function get_question($id) {
        return $this->db->get_where('question',array('id'=>$id))->row_array();
    }

    function get_all_questions($start=null,$count=null) {
        return $this->db->get('question',$count,$start)->result_array();
    }
    
    function get_count(){
        return $this->db->count_all('question');
    }

    function add_question($params) {
        $this->db->insert('question',$params);
        return $this->db->insert_id();
    }

    function update_question($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('question',$params);
    }

    function delete_question($id) {
        $this->db->delete('question',array('id'=>$id));
    }

}