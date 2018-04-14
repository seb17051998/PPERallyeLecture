<?php

class Account extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('enseignantModel');
        $this->load->library('Aauth');
        $this->load->library('form_validation');
    }
    function verification($idAuth,$keyVerif){
        if($this->aauth->verify_user($idAuth,$keyVerif)==true){
            $this->aauth->unban_user($idAuth);
            redirect('Account/Inscrit');
        }
        else{
            echo "Une erreur est survenu lors de la création de votre compte, veuillez réssayez";
        }
    }
    function create(){
        $this->load->library('form_validation');
        LoadValidationRules($this->enseignantModel,$this->form_validation);
        $this->form_validation->set_rules('password','Password','required|max_length[100]');
        $this->form_validation->set_rules('passwordConfirmation','Confirmez le mot de passe',"required|max_length[100]|callback_password_check");
            if($this->form_validation->run()){
                
                $email=$this->input->post('login');
                $password=$this->input->post('password');
                $this->aauth->create_user($email,$password);
                $idAuth=$this->aauth->get_user_id($email);
                $params=array(
                    'nom'=>$this->input->post('nom'),
                    'prenom'=>$this->input->post('prenom'),
                    'login'=>$this->input->post('login'),
                    'id'=>$idAuth
                    
                );
                
                $this->enseignantModel->add_enseignant($params);
                $this->aauth->add_member($this->aauth->get_user_id($email),'Enseignant');
                $this->attente_confirmation($email);
            }
            else{
                $data['title']="Inscription au rallye lecture";
                $this->load->view('AppHeader',$data);
                $this->load->view('AccountCreate',$data);
                $this->load->view('AppFooter');
            }
    }
    function password_check(){
        $password=$this->input->post('password');
        $passwordConfirmation=$this->input->post('passwordConfirmation');
        if ($password!=$passwordConfirmation){
            $this->form_validation->set_message('password_check','le mot de passe de confirmation est différent du mot de passe initial');
            return false;    
        }
        else{
            return true;
        }
    }
            
        
        
                
    
    function recaptcha_check($resp){
        
    }
    function edit(){
        
    }
    function attente_confirmation($email){
        $data['title']='Confirmation de votre inscription';
        $data['email']=$email;
        $this->load->view('AppHeader',$data);
        $this->load->view('AccountConfirmation',$data);
        $this->load->view('AppFooter');
    }
}

    
