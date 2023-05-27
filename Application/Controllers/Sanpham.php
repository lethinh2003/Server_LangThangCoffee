<?php

use MVC\Controller;

class ControllersSanPham extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('sanpham');

        // Read All Task
        $danhSachSanPham = $model->getAllSanPham();
        foreach ($danhSachSanPham as &$sanPham) {
            $danhSachKichThuoc = $this->model('kichthuocsanpham')->getKichThuoc($sanPham["MaSanPham"]);
            $sanPham["TenKichThuoc"] =  $danhSachKichThuoc[0]["TenKichThuoc"];
            $sanPham["GiaTien"] =  $danhSachKichThuoc[0]["GiaTien"];
        }

        // Prepare Data
        $data = ['data' => $danhSachSanPham];

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data);
    }

    public function getChiTietSanPham()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('sanpham');

            $maSanPham = $this->request->input("maSanPham");
            $sanPham = $model->getDetailSanPham($maSanPham);
            $danhSachKichThuoc = $this->model('kichthuocsanpham')->getKichThuoc($sanPham[0]["MaSanPham"]);
            $sanPham[0]["TenKichThuoc"] =  $danhSachKichThuoc[0]["TenKichThuoc"];
            $sanPham[0]["GiaTien"] =  $danhSachKichThuoc[0]["GiaTien"];
            $kichThuocSanPham = $model->getDetailSizeSanPham($maSanPham);
            $toppingSanPham = $model->getDetailToppingSanPham($maSanPham);
            // Prepare Data
            $data = ['data' => $sanPham, 'kichThuoc' => $kichThuocSanPham, 'topping' => $toppingSanPham];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
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
