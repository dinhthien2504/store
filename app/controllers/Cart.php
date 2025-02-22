<?php
namespace app\controllers;

use app\controllers\Base;
use app\mail\Mailer;
class Cart extends Base
{
    public $data = [];
    private $cart_model;
    private $pro_variant_model;
    private $province_model;
    private $order_model;
    private $order_detail_model;
    private $mail;
    public function __construct()
    {
        $this->cart_model = $this->model('CartModel');
        $this->pro_variant_model = $this->model('ProVariantModel');
        $this->province_model = $this->model('ProvinceModel');
        $this->order_model = $this->model('OrderModel');
        $this->order_detail_model = $this->model('OrderDetailModel');
        $this->mail = new Mailer();
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
                header('Location: ' . _WEB_ROOT_ . '/cart');
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
                    //Thực hiện thao tác gửi mail
                    $this->sendMailOrder($order_id);
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
    private function handle_order_detail__data($data_post, $order_id)
    {
        if (isset($data_post['pro_id']) && is_array($data_post['pro_id'])) {
            $order_details = [];
            foreach ($data_post['pro_id'] as $index => $pro_id) {
                $order_details[] = [
                    $pro_id,
                    $order_id,
                    $data_post['name_variant'][$index] ?? null,
                    $data_post['quantity'][$index] ?? 0,
                    $data_post['price'][$index] ?? 0
                ];
            }
        }

        return $order_details;
    }
    private function sendMailOrder($order_id)
    {
        //Lấy thông tin đơn hàng vừa đặt
        $this->order_detail_model->__set('order_id', $order_id);
        $data_Dorder = $this->order_detail_model->get_order_detail_by_order_id();
        //Lấy mã đơn hàng vừa đặt
        $this->order_model->__set('id', $order_id);
        $data_order = $this->order_model->get_order_by_id();
        $email = $_SESSION['user']['email'] ?? null;
        $name = $_SESSION['user']['name'] ?? null;
        $subject = 'Thong bao dat hang';
        $body = "Xin chào " . $name . "<br>";
        $body .= "Đơn hàng #" . $data_order['code_order'] . " của bạn sẽ được chuẩn bị và giao trong thời gian sớm nhất<br>";
        $body .= '<div style="
            height: auto;
            padding: 10px;
            margin: 10px;
            background-color: #eee;">
                <h1 style="color: #0051ffe8; text-align: center; font-size: 27px;">Đặt Hàng Thành Công</h1>
                <div style="padding: 0 20px;
                background-color: #fff;" class="sendmail_row">
                    <div style="display: grid;
                    grid-template-columns: auto 1fr;
                    align-items: center;
                    grid-column-gap: 10px;" class="name_madh">
                        <p style="color: #444444;
                        font: 100;" class="title_madh">Mã Đơn Hàng: <span style="color: #444444;
                        font-weight: bold;">#' . $data_order['code_order'] . '</span></p>
                    </div>
                    <div>
                        <h2 style="font-weight: bold;">Bạn vừa mua:</h2>
                        <div style="display: grid;
                        grid-template-columns: auto 1fr;
                        align-items: center;" class="products_item_">';

        foreach ($data_Dorder as $item) {
            $body .= '<div style="display: grid;
                    grid-template-columns: auto 1fr;
                    grid-column-gap: 10px;" class="name">
                    <p style="color: #444444;">' . $item['name'] . '</p>
                    <p style="color: #444444;">Giá: <span style="font-weight: bold;">' . number_format($item['price']) . ' đ</span></p>
                    <p style="color: #444444; font-weight: bold; font-style: italic;" class="quantity_name">Phân loại: ' . $item['name_variant'] . ' x ' . $item['quantity'] . '</p>
                </div>';
        }

        $body .= '</div>
                        <div class="sendmail_total">
                            <div style="display: grid;
                            grid-template-columns: auto 1fr;
                            grid-column-gap: 10px;
                            align-items: center;" class="item_total">
                                <h4>Giá trị đơn hàng:</h4>
                                <p>' . number_format($data_order['total']) . ' đ</p>
                            </div>
                            <div style="display: grid;
                            grid-template-columns: auto 1fr;
                            grid-column-gap: 10px;
                            align-items: center;" class="item_total">
                                <h4>Phí vận chuyển:</h4>
                                <p>0 VND</p>
                            </div>
                            <div style="display: grid;
                            grid-template-columns: auto 1fr;
                            grid-column-gap: 10px;
                            align-items: center;" class="item_total">
                                <h4>Tổng cộng:</h4>
                                <p style="color: #0051ffe8;
                                font-size: 20px;
                                font-weight: bold;" class="price_total">' . number_format($data_order['total']) . ' đ</p>
                            </div>
                            <div style="display: grid;
                            grid-template-columns: auto 1fr;
                            grid-column-gap: 10px;
                            align-items: center;" class="item_total">
                                <h4>Phương thức thanh toán:</h4>
                                <p>Thanh toán khi nhận hàng (COD)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p>Cảm ơn bạn đã đặt hàng tại: <span style="color: #0051ffe8;
                font-weight: bold;
                font-size: 24px;" class="sendMail_logo"><a href="">Shop</a></span></p>
            </div>';
        $this->mail->sendMail($email, $name, $subject, $body);
    }
}