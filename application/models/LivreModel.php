<?php

/**  @property AuteurModel $hasOneAuteur 
 *   @property Editeurmodel $hasOneEditeur 
 *   @property Quizzmodel $hasOneQuizz 
 */
class LivreModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'titre','label'=>'Titre','rules'=>'required|max_length[45]'),
        array('field'=>'couverture','label'=>'Couverture','rules'=>'max_length[100]'),
        array('field'=>'idAuteur','label'=>'idAuteur','rules'=>'required|integer'),
        array('field'=>'idEditeur','label'=>'idEditeur','rules'=>'required|integer'),
        array('field'=>'idQuizz','label'=>'idQuizz','rules'=>'integer')
    );

    function __construct() {
        parent::__construct();
        $this->load->model('auteurModel','hasOneAuteur');
        $this->load->model('editeurModel','hasOneEditeur');
        $this->load->model('quizzModel','hasOneQuizz');
    }

    function get_livre($id) {
        return $this->db->get_where('livre',array('id'=>$id))->row_array();
        
    }
    
    function get_all_livre_titre(){
        $this->db->get('livre');
        $query = $this->db->order_by('titre');
        return $query->result_array();
    }

    function get_all_livres($start=NULL,$count=NULL) {
        $this->db->select('*');
        $this->db->from('livre');
        $this->db->join('auteur','livre.idAuteur=auteur.id');
        $this->db->limit($count,$start);
        $query=$this->db->get();
        
        //$query = $this->db->get('livre,',$count,$start);
        //$this->db->select('livre.id, titre, couverture, idAuteur, nom, idEditeur, idQuizz');
        
                 
        
        return $query->result_array();
        
        
    }
    
    public function get_count(){
        return $this->db->count_all('livre');
    }

    function add_livre($params) {
        
        $this->db->insert('livre',$params);
        return $this->db->insert_id();
    }

    function update_livre($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('livre',$params);
    }

    function delete_livre($id) {
        $this->db->delete('livre',array('id'=>$id));
    }

    function get_auteur($id) {
        $idAuteur=$this->db->get_where('livre',array('id'=>$id))->row_array()['idAuteur'];
        return $this->hasOneAuteur->get_auteur($idAuteur);
    }

    function get_editeur($id) {
        $idEditeur=$this->db->get_where('livre',array('id'=>$id))->row_array()['idEditeur'];
        return $this->hasOneEditeur->get_editeur($idEditeur);
    }
    
    

    function get_quizz($id) {
        $idQuizz=$this->db->get_where('livre',array('id'=>$id))->row_array()['idQuizz'];
        return $this->hasOneQuizz->get_quizz($idQuizz);
    }

}