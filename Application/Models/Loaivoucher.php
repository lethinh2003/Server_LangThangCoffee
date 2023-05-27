<?php

use MVC\Model;

class ModelsLoaiVoucher extends Model
{
    public function getDanhSachAdmin()
    {

        $query = $this->db->query("SELECT * FROM loaivoucher");
        $result = $query->rows;
        return $result;
    }
    public function createLoaiVoucher($data)
    {
        try {

            $field_list = '';
            $value_list = '';
            foreach ($data as $key => $value) {
                $field_list .= ",$key";
                $value_list .= ",'" . $this->db->escape($value) . "'";
            }
            $sql = 'INSERT INTO loaivoucher (' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';
            $query = $this->db->query($sql);

            return $query;
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
}
