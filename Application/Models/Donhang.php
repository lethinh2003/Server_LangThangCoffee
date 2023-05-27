<?php

use MVC\Model;

class ModelsDonHang extends Model
{

    public function getDHMoiNhat($sdt)
    {

        $query = $this->db->query("SELECT * FROM donhang where SDTTaiKhoan = '" . $sdt . "' and TinhTrang = 0 order by MaDonHang desc ");
        $result = array();
        $result = $query->row;
        return $result;
    }
    public function getDH($maDonHang)
    {

        $query = $this->db->query("SELECT * FROM donhang where MaDonHang = '" . $maDonHang . "'  ");
        $result = array();
        $result = $query->row;
        return $result;
    }
    public function getAllDHBySDT($soDienThoai)
    {

        $query = $this->db->query("SELECT * FROM donhang where SDTTaiKhoan = '" . $soDienThoai . "'  ");
        $result = array();
        $result = $query->row;
        return $result;
    }
    public function getAllDHDangCho($soDienThoai)
    {

        $query = $this->db->query("SELECT * FROM donhang where SDTTaiKhoan = '" . $soDienThoai . "' and TinhTrang = 1 ");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function getAllDHDangChoAdmin()
    {

        $query = $this->db->query("SELECT * FROM donhang where TinhTrang = 1 ");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function getAllDHDangGiao($soDienThoai)
    {

        $query = $this->db->query("SELECT * FROM donhang where SDTTaiKhoan = '" . $soDienThoai . "' and TinhTrang = 2 ");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function getAllDHDangGiaoAdmin()
    {

        $query = $this->db->query("SELECT * FROM donhang where TinhTrang = 2 ");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function getAllDHDaHoanThanh($soDienThoai)
    {

        $query = $this->db->query("SELECT * FROM donhang where SDTTaiKhoan = '" . $soDienThoai . "' and TinhTrang = 3 ");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function getAllDHDaHoanThanhAdmin()
    {

        $query = $this->db->query("SELECT * FROM donhang where TinhTrang = 3 ");
        $result = array();
        $result = $query->rows;
        return $result;
    }


    public function getAllDHDaHuy($soDienThoai)
    {

        $query = $this->db->query("SELECT * FROM donhang where SDTTaiKhoan = '" . $soDienThoai . "' and TinhTrang = 4 ");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function getAllDHDaHuyAdmin()
    {

        $query = $this->db->query("SELECT * FROM donhang where TinhTrang = 4 ");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function sendNotification($token, $title, $content)
    {
        $result = sendFCM($token, $title,  $content);
        return $result;
    }
    public function getLichSuOrder($maDonHang)
    {

        $query = $this->db->query("SELECT * FROM lichsuorder where MaDonHang = '" . $maDonHang . "'");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function getSoLuongOrder($maDonHang)
    {
        $soLuong = 0;
        $query = $this->db->query("SELECT * FROM lichsuorder where MaDonHang = '" . $maDonHang . "'");
        $result = array();
        $result = $query->rows;
        foreach ($result as $item) {
            $soLuong += $item["SoLuong"];
        }

        return $soLuong;
    }
    public function getThongTinDoanhThu()
    {
        $query = $this->db->query("SELECT SUM(SoTienThanhToan) as DoanhThu FROM donhang where TinhTrang = 2");
        $result = $query->row;


        return $result["DoanhThu"];
    }
    public function createDHMoiNhat($sdt, $diaChiGiaoHang)
    {

        $query = $this->db->query("insert into donhang (SDTTaiKhoan, DiaChiGiaoHang) values('" . $sdt . "', '" . $diaChiGiaoHang . "') ");

        return $query;
    }
    public function createLichSuOrder($data)
    {

        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value) {
            $field_list .= ",$key";
            $value_list .= ",'" . $this->db->escape($value) . "'";
        }
        $sql = 'INSERT INTO lichsuorder (' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';
        $query = $this->db->query($sql);

        return $this->db->getLastId();
    }

    public function createLichSuOrderTopping($data)
    {

        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value) {
            $field_list .= ",$key";
            $value_list .= ",'" . $this->db->escape($value) . "'";
        }
        $sql = 'INSERT INTO lichsuorder_topping (' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ') ';
        $query = $this->db->query($sql);

        return $query;
    }
    public function updateDonHang($thanhTien, $maDonHang)
    {


        $sql = "update donhang set ThanhTien = ThanhTien + '" . $thanhTien . "', ThanhTienGiam = ThanhTien, SoTienThanhToan = ThanhTien + PhiGiaoHang, ThoiGianCapNhat = '" . date('Y-m-d H:i:s') . "' where MaDonHang = '" . $maDonHang . "'  ";
        $query = $this->db->query($sql);

        return $query;
    }
    public function updateDonHangThanhTien($thanhTien, $maDonHang)
    {


        $sql = "update donhang set ThanhTien = '" . $thanhTien . "',ThanhTienGiam = ThanhTien,  SoTienThanhToan = ThanhTien + PhiGiaoHang, ThoiGianCapNhat = '" . date('Y-m-d H:i:s') . "' where MaDonHang = '" . $maDonHang . "'  ";
        $query = $this->db->query($sql);

        return $query;
    }
    public function capNhatDiaChiGiaoHang($maDonHang, $diaChiGiaoHang)
    {


        $sql = "update donhang set DiaChiGiaoHang = '" . $diaChiGiaoHang . "', ThoiGianCapNhat = '" . date('Y-m-d H:i:s') . "' where MaDonHang = '" . $maDonHang . "'  ";
        $query = $this->db->query($sql);

        return $query;
    }
    public function capNhatTinhTrang($maDonHang, $tinhTrang)
    {


        $sql = "update donhang set TinhTrang = '" . $tinhTrang . "', ThoiGianCapNhat = '" . date('Y-m-d H:i:s') . "' where MaDonHang = '" . $maDonHang . "'  ";
        $query = $this->db->query($sql);

        return $query;
    }
    public function capNhatVoucher($maDonHang, $maVoucher, $getVoucher)
    {
        $giaTriGiamGia = 0;
        $sql = "";
        if ($getVoucher != null) {
            $giamTongTien = $getVoucher["TongTien"];
            $giamPhiShip = $getVoucher["PhiShip"];
            $sql = "update donhang set MaVoucher = '" . $maVoucher . "', ThanhTienGiam =  ThanhTien - ThanhTien * $giamTongTien / 100, PhiGiaoHangGiam = PhiGiaoHang - PhiGiaoHang * $giamPhiShip / 100 ,  SoTienThanhToan = ThanhTienGiam + PhiGiaoHangGiam,  ThoiGianCapNhat = '" . date('Y-m-d H:i:s') . "' where MaDonHang = '" . $maDonHang . "'  ";
        } else {
            $sql = "update donhang set MaVoucher = null, ThanhTienGiam =  ThanhTien, PhiGiaoHangGiam = PhiGiaoHang, SoTienThanhToan = ThanhTienGiam + PhiGiaoHangGiam ,  ThoiGianCapNhat = '" . date('Y-m-d H:i:s') . "' where MaDonHang = '" . $maDonHang . "'  ";
        }
        $query = $this->db->query($sql);
        $sql = "select * from donhang where MaDonHang = '" . $maDonHang . "'  ";
        $query = $this->db->query($sql);


        return $query->row;
    }
    public function deleteDonHang($maDonHang)
    {

        $query = $this->db->query("delete from donhang where MaDonHang = '" . $maDonHang . "' ");

        return $query;
    }
}
