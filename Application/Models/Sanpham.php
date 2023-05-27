<?php

use MVC\Model;

class ModelsSanPham extends Model
{
    public function getAllSanPhamAdmin()
    {

        $query = $this->db->query("SELECT * FROM sanpham A inner join kichthuocsanpham B on A.MaSanPham = B.MaSanPham inner join danhmucsanpham C on A.MaDanhMuc = C.MaDanhMuc order by A.MaDanhMuc asc, A.TenSanPham asc");
        $result = array();
        $result = $query->rows;

        return $result;
    }
    public function getSanPhamYeuThich($sdt)
    {

        $query = $this->db->query("SELECT * FROM sanphamyeuthich A inner join sanpham B on A.MaSanPham = B.MaSanPham and A.SDTTaiKhoan = '" . $sdt . "' order by B.MaDanhMuc asc, B.TenSanPham asc");
        $result = array();
        $result = $query->rows;

        return $result;
    }

    public function getAllSanPham()
    {

        $query = $this->db->query("SELECT * FROM sanpham A order by A.MaDanhMuc asc, A.TenSanPham asc");
        $result = array();
        $result = $query->rows;

        return $result;
    }
    public function xoaSanPham($maSanPham)
    {

        $query = $this->db->query("delete from sanpham where MaSanPham = '" . $maSanPham . "' ");
        return $query;
    }
    public function getDetailSanPham($maSanPham)
    {

        $query = $this->db->query("SELECT * FROM sanpham A where A.MaSanPham = '" . $maSanPham . "'");
        $result = array();
        $result = $query->rows;

        return $result;
    }
    public function getDetailSizeSanPham($maSanPham)
    {

        $query = $this->db->query("SELECT * FROM sanpham A inner join kichthuocsanpham B on A.MaSanPham = B.MaSanPham and A.MaSanPham = '" . $maSanPham . "' order by B.GiaTien asc");
        $result = array();
        $result = $query->rows;

        return $result;
    }
    public function getDetailToppingSanPham($maSanPham)
    {

        $query = $this->db->query("SELECT * FROM sanpham A inner join toppingsanpham B on A.MaSanPham = B.MaSanPham and A.MaSanPham = '" . $maSanPham . "' order by B.GiaTien asc");
        $result = array();
        $result = $query->rows;

        return $result;
    }
    public function capNhatSanPhamAdmin($data, $where)
    {
        $sql = '';
        foreach ($data as $key => $value) {
            $sql .= "$key = '" .  $this->db->escape($value) . "',";
        }
        $sql = 'UPDATE sanpham SET ' . trim($sql, ',') . ' WHERE ' . $where;
        $query = $this->db->query($sql);

        return  $query;
    }
    public function createSanPham($data)
    {

        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value) {
            $field_list .= ",$key";
            $value_list .= ",'" . $this->db->escape($value) . "'";
        }
        $sql = 'INSERT INTO sanpham (' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ') ';
        $query = $this->db->query($sql);

        return $this->db->getLastId();
    }
}
