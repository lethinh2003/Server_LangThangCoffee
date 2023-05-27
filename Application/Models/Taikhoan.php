<?php

use MVC\Model;

class ModelsTaiKhoan extends Model
{

    public function getAllTaiKhoan()
    {
        $query = $this->db->query("SELECT * FROM taikhoan");

        return $query->rows;
    }
    public function getTaiKhoan($sdt)
    {
        $query = $this->db->query("SELECT * FROM taikhoan where SDTTaiKhoan  = '" . $sdt . "'");

        return $query->row;
    }
    public function getAllTaiKhoanAdmin()
    {
        $query = $this->db->query("SELECT * FROM taikhoan A inner join quyenhan B on A.MaQuyenHan = B.MaQuyenHan");

        return $query->rows;
    }
    public function getAllTaiKhoanCuaAdmin()
    {
        $query = $this->db->query("SELECT * FROM taikhoan A inner join quyenhan B on A.MaQuyenHan = B.MaQuyenHan and A.MaQuyenHan > 1");

        return $query->rows;
    }
    public function getThongTin($sdt)
    {
        $query = $this->db->query("SELECT * FROM taikhoan A inner join quyenhan B on A.MaQuyenHan = B.MaQuyenHan and A.SDTTaiKhoan  = '" . $sdt . "'");

        return $query->row;
    }
    public function checkSDTTaiKhoan($sdt)
    {
        $query = $this->db->query("SELECT * FROM taikhoan where SDTTaiKhoan = '" . $sdt . "' ");

        return $query->num_rows;
    }
    public function checkLoginTaiKhoan($sdt, $mk)
    {
        $query = $this->db->query("SELECT * FROM taikhoan where SDTTaiKhoan = '" . $sdt . "' and MatKhau = '" . md5($mk) . "' ");

        return $query->num_rows > 0 ? true : false;
    }
    public function createTaiKhoan($data)
    {
        try {

            $field_list = '';
            $value_list = '';
            foreach ($data as $key => $value) {
                $field_list .= ",$key";
                $value_list .= ",'" . $this->db->escape($value) . "'";
            }
            $sql = 'INSERT INTO taikhoan (' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';
            $query = $this->db->query($sql);

            return $query;
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function capNhatTaiKhoanAdmin($data, $where)
    {
        $sql = '';
        foreach ($data as $key => $value) {
            $sql .= "$key = '" .  $this->db->escape($value) . "',";
        }
        $sql = 'UPDATE taikhoan SET ' . trim($sql, ',') . ' WHERE ' . $where;
        $query = $this->db->query($sql);

        return  $query;
    }

    public function capNhatDiaChiGiaoHang($soDienThoai, $diaChiGiaoHang)
    {


        $sql = "update taikhoan set DiaChiGiaoHang = '" . $diaChiGiaoHang . "' where SDTTaiKhoan = '" . $soDienThoai . "'   ";
        $query = $this->db->query($sql);

        return $query;
    }
    public function capNhatMatKhau($soDienThoai, $matKhau)
    {
        $matKhau = md5($matKhau);

        $sql = "update taikhoan set MatKhau = '" .  $matKhau . "' where SDTTaiKhoan = '" . $soDienThoai . "'   ";
        $query = $this->db->query($sql);

        return $query;
    }
    public function capNhatNotificationToken($soDienThoai, $token)
    {


        $sql = "update taikhoan set NotificationToken = '" .  $token . "' where SDTTaiKhoan = '" . $soDienThoai . "'   ";
        $query = $this->db->query($sql);

        return $query;
    }
    public function updateThongTin($data, $where)
    {
        $sql = '';
        foreach ($data as $key => $value) {
            $sql .= "$key = '" .  $this->db->escape($value) . "',";
        }
        $sql = 'UPDATE taikhoan SET ' . trim($sql, ',') . ' WHERE ' . $where;
        $query = $this->db->query($sql);

        return  $query;
    }
    public function deleteTaiKhoan($soDienThoai)
    {

        $query = $this->db->query("delete from taikhoan where SDTTaiKhoan = '" . $soDienThoai . "' ");

        return $query;
    }
}
