<?php

use MVC\Model;

class ModelsToppingSanPham extends Model
{

    public function getTopping($maSanPham)
    {
        $query = $this->db->query("SELECT * FROM toppingsanpham where MaSanPham = '" . $maSanPham . "' ");

        return $query->rows;
    }

    public function xoaTatCaTopping($maSanPham)
    {
        $query = $this->db->query("DELETE FROM toppingsanpham where MaSanPham = '" . $maSanPham . "' ");
        return $query;
    }
    public function createTopping($data)
    {

        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value) {
            $field_list .= ",$key";
            $value_list .= ",'" . $this->db->escape($value) . "'";
        }
        $sql = 'INSERT INTO toppingsanpham (' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ') ';
        $query = $this->db->query($sql);

        return $query;
    }
}
