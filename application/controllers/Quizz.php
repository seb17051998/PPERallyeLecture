<?php

/** @property quizzModel $quizzModel 
 * 
 */
class Quizz extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('quizzModel');
        $this->load->library('pagination');
    }

    function index() {
        //$data['all_quizz']=$this->quizzModel->get_all_quizz();
        $data['title']='Les Quizzs';
        $config['base_url']=site_url().'/Quizz/Index/page';
        $page=$this->uri->segment(4,0);
        $config['total_rows']=$this->quizzModel->get_count();
        $config['per_page']=10;
        $config['uri_segment']=4;
        $this->pagination->initialize($config);
        $data['quizz']=$this->quizzModel->get_all_quizz($page,$config['per_page']);
        $links=$this->pagination->create_links();
        $data['links']=$links;
        $this->load->view('AppHeader',$data);
        $this->load->view('QuizzIndex',$data);
        $this->load->view('AppFooter',$data);
    }

    function add() {
        $this->load->library('form_validation');
        LoadValidationRules($this->quizzModel,$this->form_validation);

        if ($this->form_validation->run()) {
            $params=array(
                'idfiche'=>$this->input->post('idfiche'),
            );
            $quizz_id=$this->quizzModel->add_quizz($params);
            redirect('quizz/index');
        }
        else {
            $data['title']="Ajout d'un Quizz";
            $this->load->view('AppHeader',$data);
            $this->load->view('QuizzAdd',$data);
            $this->load->view('AppFooter',$data);
        }
    }

    function edit($id) {
        $quizz=$this->quizzModel->get_quizz($id);
        if (isset($quizz['id'])) {
            $this->load->library('form_validation');
            LoadValidationRules($this->quizzModel,$this->form_validation);

            if ($this->form_validation->run()) {
                $params=array(
                    'idfiche'=>$this->input->post('idfiche'),
                );
                $this->quizzModel->update_quizz($id,$params);
                redirect('Quizz/Index');
            }
            else {
                $data['quizz']=$this->quizzModel->get_quizz($id);
                $data['title']="Ajout d'un Quizz";
                $this->load->view('AppHeader',$data);
                $this->load->view('QuizzEdit',$data);
                $this->load->view('AppFooter',$data);
            }
        }
        else
            show_error("Le quizz que vous essayez de modifier n'existe pas.");
    }

    function remove($id) {
        $quizz=$this->quizzModel->get_quizz($id);
        if (isset($quizz['id'])) {
            $this->quizzModel->delete_quizz($id);
            redirect('quizz/index');
        }
        else
            show_error("Le quizz que vous essayez de supprimer n'existe pas.");
    }

}