<?php

class Editeurmodel extends CI_Model {
    public $validationRules=array(
        array('field'=>'nom','label'=>'Nom','rules'=>'max_length[60]')
    );

    function __construct() {
        parent::__construct();
    }

    function get_editeur($id) {
        return $this->db->get_where('editeur',array('id'=>$id))->row_array();
    }

    function get_all_editeurs($start=null,$count=null) {
        return $this->db->get('editeur',$count,$start)->result_array();
    }
    
    public function get_count(){
        return $this->db->count_all('editeur');
    }

    function add_editeur($params) {
        $this->db->insert('editeur',$params);
        return $this->db->insert_id();
    }

    function update_editeur($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('editeur',$params);
    }

    function delete_editeur($id) {
        $this->db->delete('editeur',array('id'=>$id));
    }
}