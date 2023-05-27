<?php

$router->get('/server_langthangcoffee/danhmucsanpham', 'danhmucsanpham@index');


$router->get('/server_langthangcoffee/sanpham', 'sanpham@index');
$router->post('/server_langthangcoffee/sanpham/chitiet', 'sanpham@getChiTietSanPham');

$router->post('/server_langthangcoffee/sanphamyeuthich/get-danh-sach', 'sanphamyeuthich@getDanhSach');
$router->post('/server_langthangcoffee/sanphamyeuthich/update', 'sanphamyeuthich@updateSanPham');

$router->post('/server_langthangcoffee/taikhoan', 'taikhoan@getThongTinTaiKhoan');
$router->post('/server_langthangcoffee/taikhoan/sign-up', 'taikhoan@createTaiKhoan');
$router->post('/server_langthangcoffee/taikhoan/sign-in', 'taikhoan@loginTaiKhoan');
$router->post('/server_langthangcoffee/taikhoan/update', 'taikhoan@updateThongTinTaiKhoan');
$router->post('/server_langthangcoffee/taikhoan/update-mat-khau', 'taikhoan@updateMatKhauTaiKhoan');
$router->post('/server_langthangcoffee/taikhoan/update-notification-token', 'taikhoan@updateNotificationToken');


$router->post('/server_langthangcoffee/donhang/moinhat', 'donhang@getDonHangMoiNhat');
$router->post('/server_langthangcoffee/donhang/get-don-hang-dang-cho', 'donhang@getDonHangDangCho');
$router->post('/server_langthangcoffee/donhang/huy-don-hang-dang-cho', 'donhang@huyDonHangDangCho');
$router->post('/server_langthangcoffee/donhang/get-don-hang-dang-giao', 'donhang@getDonHangDangGiao');
$router->post('/server_langthangcoffee/donhang/get-don-hang-da-huy', 'donhang@getDonHangDaHuy');
$router->post('/server_langthangcoffee/donhang/get-don-hang-da-hoan-thanh', 'donhang@getDonHangDaHoanThanh');


$router->post('/server_langthangcoffee/admin/up-anh', 'home@uploadImage');

$router->post('/server_langthangcoffee/admin/donhang/get-don-hang-dang-cho', 'admin@getDonHangDangCho');
$router->post('/server_langthangcoffee/admin/donhang/huy-don-hang-dang-cho', 'admin@huyDonHangDangCho');
$router->post('/server_langthangcoffee/admin/donhang/xac-nhan-don-hang-dang-cho', 'admin@xacNhanDonHangDangCho');
$router->post('/server_langthangcoffee/admin/donhang/hoan-tat-don-hang-dang-giao', 'admin@hoanTatDonHangDangGiao');
$router->post('/server_langthangcoffee/admin/donhang/get-don-hang-dang-giao', 'admin@getDonHangDangGiao');
$router->post('/server_langthangcoffee/admin/donhang/get-don-hang-da-huy', 'admin@getDonHangDaHuy');
$router->post('/server_langthangcoffee/admin/donhang/get-don-hang-da-hoan-thanh', 'admin@getDonHangDaHoanThanh');
$router->post('/server_langthangcoffee/admin/taikhoan/send-notification', 'admin@sendNotification');
$router->get('/server_langthangcoffee/admin/taikhoan/get-danh-sach', 'admin@getDanhSachTaiKhoan');
$router->post('/server_langthangcoffee/admin/taikhoan/cap-nhat', 'admin@capNhatTaiKhoan');
$router->post('/server_langthangcoffee/admin/taikhoan/xoa-tai-khoan', 'admin@xoaTaiKhoan');
$router->post('/server_langthangcoffee/admin/taikhoan/them-moi', 'admin@themTaiKhoan');
$router->get('/server_langthangcoffee/admin/voucher/get-danh-sach', 'admin@getDanhSachVoucher');
$router->get('/server_langthangcoffee/admin/loaivoucher/get-danh-sach', 'admin@getDanhSachLoaiVoucher');
$router->post('/server_langthangcoffee/admin/loaivoucher/them-moi', 'admin@themLoaiVoucher');
$router->post('/server_langthangcoffee/admin/voucher/them-moi', 'admin@themVoucher');
$router->get('/server_langthangcoffee/admin/doanhthu/get-thong-tin', 'admin@getThongTinDoanhThu');



$router->get('/server_langthangcoffee/admin/sanpham/get-danh-sach', 'admin@getDanhSachSanPham');
$router->post('/server_langthangcoffee/admin/sanpham/cap-nhat', 'admin@capNhatSanPham');
$router->post('/server_langthangcoffee/admin/sanpham/xoa-san-pham', 'admin@xoaSanPham');
$router->post('/server_langthangcoffee/admin/sanpham/them-moi', 'admin@themSanPham');

$router->post('/server_langthangcoffee/voucher/get-danh-sach', 'voucher@getDanhSach');


$router->post('/server_langthangcoffee/donhang/update-dia-chi', 'donhang@updateDiaChi');
$router->post('/server_langthangcoffee/donhang/update-voucher', 'donhang@updateVoucher');
$router->post('/server_langthangcoffee/donhang/delete-lich-su-order', 'donhang@deleteLichSuOrder');
$router->post('/server_langthangcoffee/donhang/update-lich-su-order', 'donhang@updateLichSuOrder');
$router->post('/server_langthangcoffee/donhang/update-tinh-trang', 'donhang@updateTinhTrangDonHang');

$router->post('/server_langthangcoffee/donhang/tao-lich-su-order', 'donhang@taoLichSuOrder');

$router->post('/server_langthangcoffee/lichsuorder', 'lichsuorder@getLichSuOrder');




$router->get('/', function () {
    echo 'Welcome ';
});
