<?php

/** @property PropositionModel $propositionModel 
 * 
 */
class Proposition extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('propositionModel');
        $this->load->library('pagination');
    }

    function index() {
        //$data['propositions']=$this->propositionModel->get_all_propositions();
        $data['title']='Les Propositions';
        
        $config['base_url']=site_url().'/Proposition/Index/page';
        $page=$this->uri->segment(4,0);
        $config['total_rows']=$this->propositionModel->get_count();
        $config['per_page']=10;
        $config['uri_segment']=4;
        
        $this->pagination->initialize($config);
        $data['propositions']=$this->propositionModel->get_all_propositions($page,$config['per_page']);
        $links=$this->pagination->create_links();
        
        $data['links']=$links;
        $this->load->view('AppHeader',$data);
        $this->load->view('PropositionIndex',$data);
        $this->load->view('AppFooter');
    }

    function add() {
        $this->load->library('form_validation');
        LoadValidationRules($this->propositionModel,$this->form_validation);
        if ($this->form_validation->run()) {
            $params=array(
                'idQuestion'=>$this->input->post('idQuestion'),
                'proposition'=>$this->input->post('proposition'),
                'solution'=>$this->input->post('solution'),
            );

            $proposition_id=$this->propositionModel->add_proposition($params);
            redirect('Proposition/Index');
        }
        else {
            // chargement comboBox Question

            $data['title']='Créer une Proposition';
            $this->load->view('AppHeader',$data);
            $this->load->view('PropositionAdd',$data);
            $this->load->view('AppFooter');
        }
    }

    function edit($id) {
        $proposition=$this->propositionModel->get_proposition($id);

        if (isset($proposition['id'])) {
            $this->load->library('form_validation');
            LoadValidationRules($this->propositionModel,$this->form_validation);
            if ($this->form_validation->run()) {
                $params=array(
                    'idQuestion'=>$this->input->post('idQuestion'),
                    'proposition'=>$this->input->post('proposition'),
                    'solution'=>$this->input->post('solution'),
                );

                $this->propositionModel->update_proposition($id,$params);
                redirect('proposition/index');
            }
            else {
                $data['proposition']=$this->propositionModel->get_proposition($id);
                $data['title']='Créer une Proposition';
                $this->load->view('AppHeader',$data);
                $this->load->view('PropositionEdit',$data);
                $this->load->view('AppFooter');
            }
        }
        else
            show_error("La proposition que vous voulez modifier n'existe pas.");
    }

    function remove($id) {
        $proposition=$this->propositionModel->get_proposition($id);

        if (isset($proposition['id'])) {
            $this->propositionModel->delete_proposition($id);
            redirect('proposition/index');
        }
        else
            show_error("La proposition que vous voulez supprimer n'existe pas.");
    }

}