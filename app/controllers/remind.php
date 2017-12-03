<?php

class Remind extends Controller {

    public function index($id = '') {
        $reminder = $this->model('Reminder');
        if(!empty($id)){
            $reminder = $reminder->get_reminder($id);
        }
        $this->view('home/reminder', $reminder);
    }

    public function save() {
        $reminder = $this->model('Reminder');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['reminderId'];
            $reminder->subject = $_POST['subject'];
            $reminder->description = $_POST['description'];
            if($id > 0){
                $reminder->id = $id;
                $reminder->update();
            }else{
                $reminder->add();
            }
        }
        
        $reminder = $this->model('Reminder');
        $this->view("home/reminder", $reminder);
    }

    public function remove($id = '') {
        $reminder = $this->model('Reminder');
        $reminder->remove($id);
        $this->view('home/reminder', $reminder);
    }

}
