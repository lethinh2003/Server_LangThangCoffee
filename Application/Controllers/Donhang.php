<?php

use MVC\Controller;

class ControllersDonHang extends Controller
{

    public function getDonHangMoiNhat()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $soDienThoai = $this->request->input("SDTTaiKhoan");
            $sanPham = $model->getDHMoiNhat($soDienThoai);
            if (count($sanPham) == 0) {
                // get account address ship
                $diaChiGiaoHang = $this->model("taikhoan")->getTaiKhoan($soDienThoai);
                $diaChiGiaoHang =  $diaChiGiaoHang["DiaChiGiaoHang"];
                // create new bill

                $sanPham = $model->createDHMoiNhat($soDienThoai, $diaChiGiaoHang);
                $sanPham = $model->getDHMoiNhat($soDienThoai);
            }

            $model->capNhatVoucher($sanPham["MaDonHang"], null, null);

            $lichSuOrderList = $this->model("lichsuorder")->getLichSuOrder($sanPham["MaDonHang"]);

            $lichSuOrderToppingList = $this->model("lichsuorder")->getLichSuOrderTopping($sanPham["MaDonHang"]);


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
            $data = ['data' => $sanPham, 'lichSuOrder' => $lichSuOrderList];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function getDonHangDangCho()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $soDienThoai = $this->request->input("SDTTaiKhoan");
            $danhSachDonHang = $model->getAllDHDangCho($soDienThoai);
            foreach ($danhSachDonHang as &$donHang) {
                $lichSuOrderList = $this->model("lichsuorder")->getLichSuOrder($donHang["MaDonHang"]);

                $lichSuOrderToppingList = $this->model("lichsuorder")->getLichSuOrderTopping($donHang["MaDonHang"]);


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
                $donHang["lichSuOrder"] = $lichSuOrderList;
            }


            // Prepare Data
            $data = ['data' =>  $danhSachDonHang];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function huyDonHangDangCho()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $maDonHang = $this->request->input("maDonHang");
            $tinhTrang = 4;
            $model->capNhatTinhTrang($maDonHang, $tinhTrang);

            // Prepare Data
            $data = ['message' =>  "Cập nhật thành công"];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function getDonHangDangGiao()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $soDienThoai = $this->request->input("SDTTaiKhoan");
            $danhSachDonHang = $model->getAllDHDangGiao($soDienThoai);
            foreach ($danhSachDonHang as &$donHang) {
                $lichSuOrderList = $this->model("lichsuorder")->getLichSuOrder($donHang["MaDonHang"]);

                $lichSuOrderToppingList = $this->model("lichsuorder")->getLichSuOrderTopping($donHang["MaDonHang"]);


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
                $donHang["lichSuOrder"] = $lichSuOrderList;
            }


            // Prepare Data
            $data = ['data' =>  $danhSachDonHang];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function getDonHangDaHuy()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $soDienThoai = $this->request->input("SDTTaiKhoan");
            $danhSachDonHang = $model->getAllDHDaHuy($soDienThoai);
            foreach ($danhSachDonHang as &$donHang) {
                $lichSuOrderList = $this->model("lichsuorder")->getLichSuOrder($donHang["MaDonHang"]);

                $lichSuOrderToppingList = $this->model("lichsuorder")->getLichSuOrderTopping($donHang["MaDonHang"]);


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
                $donHang["lichSuOrder"] = $lichSuOrderList;
            }


            // Prepare Data
            $data = ['data' =>  $danhSachDonHang];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function getDonHangDaHoanThanh()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $soDienThoai = $this->request->input("SDTTaiKhoan");
            $danhSachDonHang = $model->getAllDHDaHoanThanh($soDienThoai);
            foreach ($danhSachDonHang as &$donHang) {
                $lichSuOrderList = $this->model("lichsuorder")->getLichSuOrder($donHang["MaDonHang"]);

                $lichSuOrderToppingList = $this->model("lichsuorder")->getLichSuOrderTopping($donHang["MaDonHang"]);


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
                $donHang["lichSuOrder"] = $lichSuOrderList;
            }


            // Prepare Data
            $data = ['data' =>  $danhSachDonHang];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function updateDiaChi()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $soDienThoai = $this->request->input("sdtTaiKhoan");
            $maDonHang = $this->request->input("maDonHang");
            $diaChiGiaoHang = $this->request->input("diaChiGiaoHang");
            $macDinh = $this->request->input("macDinh");

            $model->capNhatDiaChiGiaoHang($maDonHang, $diaChiGiaoHang);
            if ($macDinh == true) {

                $this->model('taikhoan')->capNhatDiaChiGiaoHang($soDienThoai, $diaChiGiaoHang);
            }

            // Prepare Data
            $data = ['message' => "Cập nhật thành công"];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function updateVoucher()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $soDienThoai = $this->request->input("sdtTaiKhoan");
            $maDonHang = $this->request->input("maDonHang");
            $maVoucher = $this->request->input("maVoucher");
            if ($this->model('voucher')->checkVoucherValid($soDienThoai, $maVoucher)) {
                $getVoucher = $this->model('voucher')->getVoucher($soDienThoai, $maVoucher);
                $getSoLuongOrderDonHang = $model->getSoLuongOrder($maDonHang);

                // check điều kiện tối thiểu để áp dụng voucher
                if ($getSoLuongOrderDonHang < $getVoucher["SoLuongToiThieu"]) {
                    $data = ['message' => "Đơn hàng này không đủ điều kiện để áp dụng voucher"];
                    $this->response->sendStatus(400);
                    $this->response->setContent($data);
                    return;
                }
                $donHangRes = $model->capNhatVoucher($maDonHang, $maVoucher, $getVoucher);
                // Prepare Data
                $data = ['voucher' => $getVoucher, 'donHang' => $donHangRes];
                // Send Response
                $this->response->sendStatus(200);
                $this->response->setContent($data);
            } else {
                $data = ['message' => "Voucher không tồn tại"];
                $this->response->sendStatus(400);
                $this->response->setContent($data);
            }
        }
    }
    public function updateTinhTrangDonHang()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $maDonHang = $this->request->input("maDonHang");
            $tinhTrang = $this->request->input("tinhTrang");
            $getCurrentDonHang = $model->getDH($maDonHang);
            if ($getCurrentDonHang["MaVoucher"] != null) {
                $this->model("voucher")->updateTrangThaiSuDung($getCurrentDonHang["SDTTaiKhoan"], $getCurrentDonHang["MaVoucher"], 1);
            }
            $model->capNhatTinhTrang($maDonHang, $tinhTrang);
            // gửi thông báo đến admin
            $getListTaiKhoanAdmin = $this->model("taikhoan")->getAllTaiKhoanCuaAdmin();
            if ($tinhTrang == 1) {
                foreach ($getListTaiKhoanAdmin as $getTaiKhoan) {
                    $model->sendNotification($getTaiKhoan["NotificationToken"], "Thông báo về đơn hàng", "Đơn hàng " . $maDonHang . " đang chờ bạn xác nhận!");
                }
            }

            $data = ['message' => "Cập nhật thành công"];
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function taoLichSuOrder()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $maDonHang = $this->request->input("maDonHang");
            $maSanPham = $this->request->input("maSanPham");
            $kichThuoc = $this->request->input("kichThuoc");
            $giaTienKichThuoc = $this->request->input("giaTienKichThuoc");
            $ghiChu = $this->request->input("ghiChu");
            $soLuong = $this->request->input("soLuong");
            $thanhTien = $this->request->input("thanhTien");
            $listTopping = $this->request->input("topping");


            $lichSuOrderID = $model->createLichSuOrder([
                "MaDonHang" => $maDonHang,
                "MaSanPham" => $maSanPham,
                "SoLuong" => $soLuong,
                "ThanhTien" => $thanhTien,
                "GhiChu" => $ghiChu,
                "KichThuoc" => $kichThuoc,
                "GiaTienKichThuoc" => $giaTienKichThuoc
            ]);

            foreach ($listTopping as $topping) {
                $model->createLichSuOrderTopping([
                    "MaLichSuOrder" => $lichSuOrderID,
                    "TenTopping" => $topping["TenTopping"],
                    "GiaTien" =>  $topping["GiaTien"]

                ]);
            }

            $model->updateDonHang($thanhTien, $maDonHang);


            // Prepare Data
            $data = ['data' => $lichSuOrderID];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function updateLichSuOrder()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');


            $maLichSuOrder = $this->request->input("maLichSuOrder");
            $maDonHang = $this->request->input("maDonHang");
            $maSanPham = $this->request->input("maSanPham");
            $kichThuoc = $this->request->input("kichThuoc");
            $giaTienKichThuoc = $this->request->input("giaTienKichThuoc");
            $ghiChu = $this->request->input("ghiChu");
            $soLuong = $this->request->input("soLuong");
            $thanhTien = $this->request->input("thanhTien");
            $listTopping = $this->request->input("topping");

            $model->capNhatVoucher($maDonHang, null, null);

            $this->model("lichsuorder")->updateLichSuOrder([
                "SoLuong" => $soLuong,
                "ThanhTien" => $thanhTien,
                "GhiChu" => $ghiChu,
                "KichThuoc" => $kichThuoc,
                "GiaTienKichThuoc" => $giaTienKichThuoc
            ], "MaLichSuOrder = '" . $maLichSuOrder . "' ");
            $this->model("lichsuordertopping")->deleteLichSuOrderTopping($maLichSuOrder);

            foreach ($listTopping as $topping) {
                $model->createLichSuOrderTopping([
                    "MaLichSuOrder" => $maLichSuOrder,
                    "TenTopping" => $topping["TenTopping"],
                    "GiaTien" =>  $topping["GiaTien"]
                ]);
            }

            $lichSuOrderList = $this->model("lichsuorder")->getLichSuOrder($maDonHang);
            $thanhTien = 0;
            foreach ($lichSuOrderList as $lichSuOrder) {
                $thanhTien += $lichSuOrder["ThanhTien"];
            }

            // Cap nhat don hang
            $model->updateDonHangThanhTien($thanhTien, $maDonHang);


            // Prepare Data
            $data = ['message' => "Cập nhật thành công", 'thanhTienDonHang' =>  $thanhTien];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function deleteLichSuOrder()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('donhang');
            $maLichSuOrder = $this->request->input("maLichSuOrder");
            $maDonHang = $this->request->input("maDonHang");
            $model->capNhatVoucher($maDonHang, null, null);

            $this->model("lichsuordertopping")->deleteLichSuOrderTopping($maLichSuOrder);
            $this->model("lichsuorder")->deleteLichSuOrder($maLichSuOrder);

            $lichSuOrderList = $this->model("lichsuorder")->getLichSuOrder($maDonHang);
            $thanhTien = 0;
            foreach ($lichSuOrderList as $lichSuOrder) {
                $thanhTien += $lichSuOrder["ThanhTien"];
            }

            // Cap nhat don hang
            $model->updateDonHangThanhTien($thanhTien, $maDonHang);

            // Prepare Data
            $data = ['message' => "Xóa thành công", 'thanhTien' => $thanhTien];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
}
