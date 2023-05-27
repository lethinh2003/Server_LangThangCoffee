<?php

use MVC\Model;

class ModelsVoucher extends Model
{

    public function checkVoucherValid($soDienThoai, $maVoucher)
    {

        $query = $this->db->query("SELECT * FROM voucher where SDTTaiKhoan = '" . $soDienThoai . "' and MaVoucher = '" . $maVoucher . "' and ThoiGianHetHan > now() and SuDung = 0");
        $result = $query->num_rows;
        return $result > 0;
    }
    public function getVoucher($soDienThoai, $maVoucher)
    {

        $query = $this->db->query("SELECT * FROM voucher A inner join loaivoucher B on A.MaLoaiVoucher = B.MaLoaiVoucher and A.SDTTaiKhoan = '" . $soDienThoai . "' and A.MaVoucher = '" . $maVoucher . "' and A.ThoiGianHetHan > now()");
        $result = $query->row;
        return $result;
    }
    public function getDanhSach($soDienThoai)
    {

        $query = $this->db->query("SELECT * FROM voucher A inner join loaivoucher B on A.MaLoaiVoucher = B.MaLoaiVoucher and A.SDTTaiKhoan = '" . $soDienThoai . "' and A.ThoiGianHetHan > now() and A.SuDung = 0 order by A.ThoiGianHetHan asc");
        $result = $query->rows;
        return $result;
    }
    public function getDanhSachAdmin()
    {

        $query = $this->db->query("SELECT * FROM voucher A inner join loaivoucher B on A.MaLoaiVoucher = B.MaLoaiVoucher order by A.ThoiGianHetHan asc");
        $result = $query->rows;
        return $result;
    }
    public function updateTrangThaiSuDung($sdt, $ma, $trangThai)
    {

        $query = $this->db->query("update voucher set SuDung = '" . $trangThai . "' where SDTTaiKhoan = '" . $sdt . "' and MaVoucher = '" . $ma . "' ");
        $result = $query;
        return $result;
    }
    public function xoaTatCaBySDT($soDienThoai)
    {
        $query = $this->db->query("DELETE FROM voucher where SDTTaiKhoan = '" . $soDienThoai . "' ");
        return $query;
    }
    public function createVoucher($data)
    {
        try {

            $field_list = '';
            $value_list = '';
            foreach ($data as $key => $value) {
                $field_list .= ",$key";
                $value_list .= ",'" . $this->db->escape($value) . "'";
            }
            $sql = 'INSERT INTO voucher (' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';
            $query = $this->db->query($sql);

            return $query;
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
}
