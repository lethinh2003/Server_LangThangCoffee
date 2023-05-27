<?php

use MVC\Controller;

class ControllersVoucher extends Controller
{


    public function getDanhSach()
    {
        try {

            if ($this->request->getMethod() == "POST") {
                $model = $this->model('voucher');
                $soDienThoai = $this->request->input("SDTTaiKhoan");
                $danhSachVoucher = $model->getDanhSach($soDienThoai);
                $data = ['status' => "success", 'data' => $danhSachVoucher];
                $this->response->sendStatus(200);
                $this->response->setContent($data);
            }
        } catch (Exception $err) {
            $data = ['status' => "error", 'message' => $err->getMessage()];
            $this->response->sendStatus(404);
            $this->response->setContent($data);
        }
    }
}
