<?php

use MVC\Controller;

class ControllersLichSuOrder extends Controller
{

    public function getLichSuOrder()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('lichsuorder');
            $maDonHang = $this->request->input("maDonHang");
            $this->model("donhang")->capNhatVoucher($maDonHang, null, null);

            $lichSuOrderList = $model->getLichSuOrder($maDonHang);
            $lichSuOrderToppingList = $model->getLichSuOrderTopping($maDonHang);


            foreach ($lichSuOrderList as &$lichSuOrder) {
                $arrayTopping = array();
                $p = 0;
                foreach ($lichSuOrderToppingList as $lichSuOrderTopping) {
                    if ($lichSuOrder["MaLichSuOrder"] == $lichSuOrderTopping["MaLichSuOrder"]) {
                        array_push($arrayTopping, $lichSuOrderTopping);
                        array_splice($lichSuOrderToppingList, $p, 1);
                        $p--;
                    }
                    $p++;
                }

                $lichSuOrder["Topping"] =  $arrayTopping;
            }
            // Prepare Data
            $data = ['lichSuOrder' => $lichSuOrderList];
            //$data = ['lichSuOrder' => $lichSuOrder, 'lichSuOrderTopping' => $lichSuOrderTopping];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
}
