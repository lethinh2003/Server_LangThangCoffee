<?php

use MVC\Model;

class ModelsSanPhamYeuThich extends Model
{

    public function getDanhSachYeuThich($sdt)
    {
        $query = $this->db->query("SELECT * FROM sanphamyeuthich A inner join sanpham B on A.MaSanPham = B.MaSanPham and A.SDTTaiKhoan = '" . $sdt . "' order by A.ThoiGianTao asc");

        return $query->rows;
    }
    public function checkYeuThich($sdt, $maSanPham)
    {
        $query = $this->db->query("SELECT * FROM sanphamyeuthich where MaSanPham = '" . $maSanPham . "' and SDTTaiKhoan = '" . $sdt . "' ");

        return $query->num_rows > 0;
    }

    public function xoaYeuThich($sdt, $maSanPham)
    {
        $query = $this->db->query("DELETE FROM sanphamyeuthich where MaSanPham = '" . $maSanPham . "' and  SDTTaiKhoan = '" . $sdt . "' ");
        return $query;
    }
    public function taoYeuThich($sdt, $maSanPham)
    {
        $query = $this->db->query("insert into sanphamyeuthich (MaSanPham, SDTTaiKhoan) values ('" . $maSanPham . "', '" . $sdt . "') ");
        return $query;
    }
    public function xoaTatCa($maSanPham)
    {
        $query = $this->db->query("DELETE FROM sanphamyeuthich where MaSanPham = '" . $maSanPham . "' ");
        return $query;
    }
    public function xoaTatCaBySDT($soDienThoai)
    {
        $query = $this->db->query("DELETE FROM sanphamyeuthich where SDTTaiKhoan = '" . $soDienThoai . "' ");
        return $query;
    }
}
