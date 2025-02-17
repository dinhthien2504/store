<?php
namespace app\controllers\admin;
use app\controllers\Base;
class Order extends Base
{
    public $data = [];
    private $OrderModel;
    public static $item_page = 10;
    public function __construct()
    {
        $this->OrderModel = $this->model('OrderModel');
    }
    public function index()
    {
        //Đặt số lượng phần tử cho trang
        $this->OrderModel->__set('item_page', self::$item_page);

        //Lấy trang hiện tại nếu có
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->OrderModel->__set('current_page', $current_page);

        //Lấy từ khóa theo mã đơn hàng
        $code = isset($_GET['code']) ? trim($_GET['code']) : null;
        $this->OrderModel->__set('code', $code);

        //Lấy trạng thái đơn hàng
        $status = isset($_GET['status']) ? $_GET['status'] : 0;
        $this->OrderModel->__set('status', $status);

        //Lấy tổng thành viên để tính số trang
        $total_order_handle_page = $this->OrderModel->total_order_handle_page();
        $total_page = ceil($total_order_handle_page['total'] / self::$item_page);
        //Xử lý đường dẫn cho phân trang
        if ($total_page > 1) {
            $links = $this->handle_url_page($total_page, $current_page);
            $this->data['sub_content']['links'] = $links;
        }
        //Lấy thông tin đơn hàng
        $orders = $this->OrderModel->get_order_admin();
        $this->data['title_page'] = 'Quản Lý Đơn Hàng';
        $this->data['content'] = 'admin/orders/index';
        $this->data['sub_content']['orders'] = $orders;
        $this->render('layouts/main_admin', $this->data);
    }
}