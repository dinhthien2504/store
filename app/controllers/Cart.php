<?php
namespace app\controllers;

use app\controllers\Base;
class Cart extends Base
{
    public $data = [];
    private $cart_model;
    private $pro_variant_model;
    private $province_model;
    private $order_model;
    private $order_detail_model;
    public function __construct()
    {
        $this->cart_model = $this->model('CartModel');
        $this->pro_variant_model = $this->model('ProVariantModel');
        $this->province_model = $this->model('ProvinceModel');
        $this->order_model = $this->model('OrderModel');
        $this->order_detail_model = $this->model('OrderDetailModel');
    }

    public function cart()
    {
        $user_id = $_SESSION['user']['id'] ?? 0;
        $this->cart_model->__set('user_id', $user_id);

        $data_cart_user_id = $this->cart_model->get_all_cart_by_user_id();
        $this->data['title_page'] = 'Giỏ Hàng';
        $this->data['sub_content']['data_carts'] = $data_cart_user_id;
        $this->data['content'] = 'carts/cart';
        $this->render('layouts/main', $this->data);
    }
    public function save_cart()
    {
        if (isset($_POST['submit_save_cart'])) {
            $this->cart_model->__sets([
                'user_id' => trim($_POST['user_id']),
                'pro_variant_id' => trim($_POST['pro_variant_id']),
                'quantity' => trim($_POST['pro_quantity']),
            ]);
            //Kiểm tra sản phẩm đã có trong giỏ hàng chưa
            $check_isset_cart = $this->cart_model->check_cart();
            if ($check_isset_cart) {
                //Lấy số lượng trong kho 
                $this->pro_variant_model->__set('id', $_POST['pro_variant_id']);
                $quantity_stock = $this->pro_variant_model->get_quantity_by_id();
                //Kiểm tra số lường trong kho có đủ để thêm vào giỏ hàng hay không
                $total_quantity = $check_isset_cart['quantity'] + $_POST['pro_quantity'];
                if ($total_quantity <= $quantity_stock['quantity']) {
                    $this->cart_model->__sets(['id' => $check_isset_cart['id'], 'quantity_new' => $total_quantity]);
                    $this->cart_model->update_cart();
                    $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Đã cập nhật lại số lượng sản phẩm!', 'type' => 'success'];
                } else {
                    $_SESSION['messager'] = ['title' => 'Lỗi!', 'mess' => 'Tổng lượng hàng trong kho không đủ để thêm vào giỏ hàng của bạn!', 'type' => 'error'];
                }
            } else {
                $this->cart_model->insert_cart();
                $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Sản phẩm đã được thêm vào giỏ hàng!', 'type' => 'success'];
            }
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function handle_del($id)
    {
        if ($id) {
            $id_handle = is_array($id) ? $id : [$id];
            $this->cart_model->__sets($id_handle);
            $this->cart_model->delete_cart();
            $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Xóa sản phẩm thành công!', 'type' => 'success'];
            header('Location: ' . _WEB_ROOT_ . '/cart');
        }
    }

    public function handle_cart()
    {
        if (isset($_POST['pro_check__cart'])) {
            $data_check = $_POST['pro_check__cart'] ?? [];
        }
        //Xử lý xóa danh sách giỏ hàng
        if (isset($_POST['submit_handle__del'])) {
            if (!empty($data_check)) {
                $this->handle_del($data_check);
                header('Location: ' . _WEB_ROOT . '/gio-hang');
            }
        }
        //Xử lý thanh toán danh sách sản phẩm
        if (isset($_POST['submit_handle__buy'])) {
            $this->checkout($_POST['pro_check__cart']);
        }
    }
    public function checkout($id)
    {
        //Dữ liệu sản phẩm lấy từ giỏ hàng để thanh toán
        $id = $id ?? 0;
        $this->cart_model->__sets($id);
        $data_cart_id = $this->cart_model->get_all_cart_by_cart_id();
        $this->data['sub_content']['data_carts'] = $data_cart_id;
        // //Dữ liệu Tỉnh/Thành Phố
        $data_province = $this->province_model->get_all_province();
        $this->data['sub_content']['data_province'] = $data_province;
        $this->data['title_page'] = 'Thanh Toán';
        $this->data['content'] = 'carts/checkout';
        $this->render('layouts/main', $this->data);
    }
    public function handle_checkout()
    {
        if (isset($_POST['submit__checkout'])) {
            // Xử lý dữ liệu đơn hàng
            $this->handle_order_data($_POST);
            $order_id = $this->order_model->insert_order();

            if ($order_id) {
                // Xử lý dữ liệu chi tiết đơn hàng
                $order_details = $this->handle_order_detail__data($_POST, $order_id);
                // Chèn danh sách chi tiết đơn hàng vào cơ sở dữ liệu
                $this->order_detail_model->__sets($order_details);
                if ($this->order_detail_model->insert_order_detail()) {
                    $cart_ids = [];
                    foreach ($_POST['cart_id'] as $cart_id) {
                        $cart_ids[] = $cart_id;
                    }
                    $this->handle_del($cart_ids);
                    $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Tạo đơn hàng thành công!', 'type' => 'success'];
                    header('Location: ' . _WEB_ROOT_ . '/cart');
                } else {
                    echo 'Lỗi khi thêm chi tiết đơn hàng.<br>';
                }
            }
        }
    }

    private function handle_order_data($data_post)
    {
        $code_order = "ORD-" . strtoupper(uniqid());
        $this->order_model->__sets([
            $data_post['user_id'] ?? 0,
            $data_post['voucher_id'] ?? null,
            $data_post['staff_id'] ?? null,
            $code_order,
            $data_post['total'] ?? 0
        ]);
    }
    private function handle_order_detail__data($__data_post, $__order_id)
    {
        if (isset($__data_post['pro_id']) && is_array($__data_post['pro_id'])) {
            $order_details = [];
            foreach ($__data_post['pro_id'] as $index => $pro_id) {
                $order_details[] = [
                    $pro_id,
                    $__order_id,
                    $__data_post['name_variant'][$index] ?? null,
                    $__data_post['quantity'][$index] ?? 0,
                    $__data_post['price'][$index] ?? 0
                ];
            }
        }

        return $order_details;
    }
}