<?php

class Reports extends Controller {
    public function attempts() {
        $data = array($this->model('Reminder'), $this->model('Reminder'));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data[1] = $data[1]->getReport($_POST['mostreminder'], $_POST['fromdate'], $_POST['todate'], $_POST['totallogin']);
        }
        $this->view('reports/students', $data);
    }
}