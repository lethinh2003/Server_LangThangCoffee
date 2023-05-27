<?php

use MVC\Model;

class ModelsLichSuOrderTopping extends Model
{


    public function deleteLichSuOrderTopping($maLichSuOrder)
    {

        $query = $this->db->query("delete from lichsuorder_topping where MaLichSuOrder = '" . $maLichSuOrder . "' ");

        return $query;
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
}
