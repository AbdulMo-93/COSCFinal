<?php

class Home extends Controller {
    public function index() {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin'){
                $this->user();
            }else{
                $this->client();
            }
        }else {
            header('Location: ' . LOGIN);
            die;
        }
    }

    public function login() {
        $this->view('home/login');
    }
    
    public function user(){
        $user = $this->model('User');
        $this->view('admin/user', $user->getUsers());
    }
    
    public function client(){
        $client = $this->model('Client');
        $this->view('home/client', $client);
    }
    
    public function remind(){
        
    }
}
