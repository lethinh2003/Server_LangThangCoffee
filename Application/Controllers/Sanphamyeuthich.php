<?php

use MVC\Controller;

class ControllersSanPhamYeuThich extends Controller
{


    public function getDanhSach()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database

            $model = $this->model('sanphamyeuthich');
            $soDienThoai = $this->request->input("SDTTaiKhoan");
            $danhSachSanPhamYeuThich = $model->getDanhSachYeuThich($soDienThoai);
            foreach ($danhSachSanPhamYeuThich as &$sanPham) {
                $danhSachKichThuoc = $this->model('kichthuocsanpham')->getKichThuoc($sanPham["MaSanPham"]);
                $sanPham["TenKichThuoc"] =  $danhSachKichThuoc[0]["TenKichThuoc"];
                $sanPham["GiaTien"] =  $danhSachKichThuoc[0]["GiaTien"];
            }
            $data = ['data' => $danhSachSanPhamYeuThich];
            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function updateSanPham()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database

            $model = $this->model('sanphamyeuthich');
            $soDienThoai = $this->request->input("SDTTaiKhoan");
            $maSanPham = $this->request->input("MaSanPham");
            if ($model->checkYeuThich($soDienThoai, $maSanPham)) {
                $model->xoaYeuThich($soDienThoai, $maSanPham);
                $data = ['data' => 0];
            } else {
                $model->taoYeuThich($soDienThoai, $maSanPham);
                $data = ['data' => 1];
            }

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
}
