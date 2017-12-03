<?php

class UserController extends Controller{
    public function login(){
        $user = $this->model('User');
        
        if(isset($_POST['username']) && isset($_POST['password'])){
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            
            if($user->authenticate()){
                header('Location: ' . HOME);
                die;
            }
        }
        
        header('Location: ' . LOGIN);
        die;
    }
    
    public function logout(){
        $user = $this->model('User');
        $user->updateLogInfo();
        
        session_destroy();
        header('Location: ' . HOME);
    }
    
    public function manageClient(){
        $client = $this->model('Client');
        $this->view('home/client', $client);
    }
    
    public function phoneList(){
        $client = $this->model('Client');
        $this->view('user/phonelist', $client);
    }
    
    public function report(){
        $data = array($this->model('Client'), $this->model('Client'));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $city = $_POST['city'];
            $ageUnder = $_POST['age'];
            $data[1] = $data[1]->getReport($city, $ageUnder);
        }
        
        $this->view('user/report', $data);
    }

    public function add(){
        $user = $this->model('User');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user->username = $_POST['username'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->firstName = $_POST['firstName'];
            $user->lastName = $_POST['lastName'];
            $user->email = $_POST['email'];
            $user->role = $_POST['role'];
            if($user->role == 'staff')
                $user->managedBy = $_POST['managedBy'];
            $user->perform('add');
        }
        
        header('Location: ' . HOME);
    }
    
    public function delete($value=''){
        $user = $this->model('User');
        $user->username = $value;
        $user->perform('delete');
        
        header('Location: ' . HOME);
    }
    
    /** Manage Clients **/
    public function addClient(){
        $client = $this->model('Client');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $client->id     = null;
            $client->name   = $_POST['name'];
            $client->dob    = $_POST['dob'];
            $client->email  = $_POST['email'];
            $client->phone  = $_POST['phone'];
            $client->city   = $_POST['city'];
            $client->note   = $_POST['note'];
            
            $username = $_SESSION['username'];
            $client->createdBy = $username;
            $client->updatedBy = $username;
            
            $date = date('Y-m-d H:i:s');
            $client->createdDate = $date;
            $client->updatedDate = $date;
            
            $client->perform('add');
            
            header('Location: ' . HOME);
        }
    }
    
    public function updateClient(){
        $client = $this->model('Client');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $client->id = $_POST['id'];
            $client->name = $_POST['name'];
            $client->dob = $_POST['dob'];
            $client->email = $_POST['email'];
            $client->phone = $_POST['phone'];
            $client->city = $_POST['city'];
            $client->note = $_POST['note'];
            $client->updatedBy = $_SESSION['username'];
            $client->updatedDate = date('Y-m-d H:i:s');
            
            $client->perform('update');
            
            header('Location: ' . HOME);
        }
    }
    
    public function editClient($id=''){
        $client = $this->model('Client');
        $city = $this->model('City');
        
        $client->id = $id;
        $client->city = $city;
        
        $client = $client->getClient($client);
        
        $this->view('home/client_edit', $client);
    }
}