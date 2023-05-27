<?php

use MVC\Controller;

class ControllersDanhMucSanPham extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('danhmucsanpham');
        // Read All Task
        $danhMuc = $model->getAllDanhMuc();

        // Prepare Data
        $data = ['data' => $danhMuc];

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data);
    }

    public function post()
    {

        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('home');

            // Read All Task
            $users = $model->getAllUser();

            // Prepare Data
            $data = ['data' => $users];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
}
