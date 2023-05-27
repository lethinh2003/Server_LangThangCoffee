<?php

use MVC\Model;

class ModelsKichThuocSanPham extends Model
{

    public function getKichThuoc($maSanPham)
    {
        $query = $this->db->query("SELECT * FROM kichthuocsanpham where MaSanPham = '" . $maSanPham . "' order by GiaTien asc ");

        return $query->rows;
    }
    public function xoaTatCaKichThuoc($maSanPham)
    {
        $query = $this->db->query("DELETE FROM kichthuocsanpham where MaSanPham = '" . $maSanPham . "' ");
        return $query;
    }
    public function createKichThuoc($data)
    {

        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value) {
            $field_list .= ",$key";
            $value_list .= ",'" . $this->db->escape($value) . "'";
        }
        $sql = 'INSERT INTO kichthuocsanpham (' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ') ';
        $query = $this->db->query($sql);

        return $query;
    }
}
