<?php

use MVC\Model;

class ModelsLichSuOrder extends Model
{

    public function getLichSuOrder($maDonHang)
    {

        $query = $this->db->query("SELECT * FROM lichsuorder A inner join sanpham B on A.MaSanPham = B.MaSanPham and A.MaDonHang = '" . $maDonHang . "'");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function getLichSuOrderByMaSanPham($maSanPham)
    {

        $query = $this->db->query("SELECT * FROM lichsuorder where MaSanPham = '" . $maSanPham . "'");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function getLichSuOrderTopping($maDonHang)
    {

        $query = $this->db->query("SELECT * FROM lichsuorder A inner join  lichsuorder_topping B on A.MaLichSuOrder = B.MaLichSuOrder and A.MaDonHang = '" . $maDonHang . "'");
        $result = array();
        $result = $query->rows;
        return $result;
    }
    public function deleteLichSuOrder($maLichSuOrder)
    {

        $query = $this->db->query("delete from lichsuorder where MaLichSuOrder = '" . $maLichSuOrder . "' ");

        return $query;
    }
    public function updateLichSuOrder($data, $where)
    {
        $sql = '';
        foreach ($data as $key => $value) {
            $sql .= "$key = '" .  $this->db->escape($value) . "',";
        }
        $sql = 'UPDATE lichsuorder SET ' . trim($sql, ',') . ' WHERE ' . $where;
        $query = $this->db->query($sql);

        return  $query;
    }
}
