<?php

use MVC\Controller;

class ControllersHome extends Controller
{

    public function index()
    {

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

    public function uploadImage()
    {
        $IMGUR_CLIENT_ID = IMGUR_CLIENT_ID;
        if (isset($this->request->files['image'])) {
            $image = $this->request->files['image'];
            $errors = array();

            // File info
            $file_name = $image['name'];
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_type = $image['type'];

            // Get file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            // White list extensions
            $extensions = array("jpeg", "jpg", "png");

            // Check it's valid file for upload
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }

            // Check file size
            if ($file_size > 2097152) {
                $errors[] = 'File size must be exactly 2 MB';
            }
            $image_source = file_get_contents($file_tmp);

            // API post parameters 
            $postFields = array('image' => base64_encode($image_source));

            if (empty($errors) == true) {

                // Post image to Imgur via API 
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $IMGUR_CLIENT_ID));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                $response = curl_exec($ch);
                curl_close($ch);

                // Decode API response to array 
                $responseArr = json_decode($response);
                if (!empty($responseArr->data->link)) {
                    $imgurData = $responseArr;
                    $data = ['message' => "Upload thành công", 'link' => $imgurData->data->link];
                    // Send Response
                    $this->response->sendStatus(200);
                    $this->response->setContent($data);
                } else {
                    $data = ['message' => "Upload thất bại"];
                    // Send Response
                    $this->response->sendStatus(400);
                    $this->response->setContent($data);
                }
                // move_uploaded_file($file_tmp, UPLOAD . "Images/" . $file_name);


            } else {
                $data = ['message' => "Upload thất bại"];
                // Send Response
                $this->response->sendStatus(400);
                $this->response->setContent($data);
            }
        }
    }
}
