<?php

use MVC\Model;

class ModelsDanhMucSanPham extends Model
{

    public function getAllDanhMuc()
    {
        $query = $this->db->query("SELECT * FROM danhmucsanpham");

        return $query->rows;
    }
}
