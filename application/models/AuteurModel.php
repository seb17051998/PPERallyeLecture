<?php

class AuteurModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'nom','label'=>'Nom','rules'=>'required|max_length[60]')
    );

    function __construct() {
        parent::__construct();
    }

    function get_auteur($id) {
        return $this->db->get_where('auteur',array('id'=>$id))->row_array();
    }

    function get_all_auteurs($start=Null,$count=Null) {
        return $this->db->get('auteur',$count,$start)->result_array();
    }
    
    public function get_count(){
        return $this->db->count_all('auteur');
    }

    function add_auteur($params) {
        $this->db->insert('auteur',$params);
        return $this->db->insert_id();
    }

    function update_auteur($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('auteur',$params);
    }

    function delete_auteur($id) {
        $this->db->delete('auteur',array('id'=>$id));
    }

}