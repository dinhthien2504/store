<?php
namespace app\controllers;
use app\controllers\Base;

class Ajax extends Base {
    public $data;
    protected $pro_variant_model;
    protected $category_model;
    protected $attri_val_model;
    protected $cart_model;
    protected $province_model;
    protected $district_model;
    protected $ward_model;
    protected $user_model;
    public function __construct()
    {
        $this->pro_variant_model = $this->model('ProVariantModel');
        // $this->category_model = $this->model('category_model');
        // $this->attri_val_model = $this->model('attri_value_model');
        $this->cart_model = $this->model('CartModel');
        $this->province_model = $this->model('ProvinceModel');
        $this->district_model = $this->model('DistrictModel');
        $this->ward_model = $this->model('WardModel');
        $this->user_model = $this->model('UserModel');
    }
    //Các hàm trang sản phẩm
    public function get_size()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->pro_variant_model->__set('pro_id', $_POST['pro_id']);
            $this->pro_variant_model->__set('cor_id', $_POST['cor_id']);
            $data = $this->pro_variant_model->get_size_by_cor_id();
            if (!empty($data)) {
                $out_put = '';
                foreach ($data as $item) {
                    $out_put .= '<button onclick="get_quantity(this, \'.size\', \'' . $item['pro_id'] . '\', \'' . $item['cor_id'] . '\', \'' . $item['size_id'] . '\')"
                class="size ">' . $item['name'] . '</button>';
                }
                echo $out_put;
            }
        }
    }
    public function get_quantity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->pro_variant_model->__set('pro_id', $_POST['pro_id']);
            if (isset($_POST['cor_id']) && isset($_POST['size_id'])) {
                $this->pro_variant_model->__set('cor_id', $_POST['cor_id']);
                $this->pro_variant_model->__set('size_id', $_POST['size_id']);
            }
            if (isset($_POST['cor_id']) && !isset($_POST['size_id'])) {
                $this->pro_variant_model->__set('cor_id', $_POST['cor_id']);
            }
            if (isset($_POST['size_id']) && !isset($_POST['cor_id'])) {
                $this->pro_variant_model->__set('size_id', $_POST['size_id']);
            }
            $data = $this->pro_variant_model->get_quantity();
            echo json_encode($data);
        }
    }

    //Các hàm trang thêm sản phẩm
    public function get_cate_chirld_by_parent()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->category_model->setparent($_POST['parent_id']);
            $data = $this->category_model->get_all_cate_by_parent_id($this->category_model);
            if (!empty($data)) {
                $out_put = '';
                foreach ($data as $cate) {
                    $out_put .= '<li onclick="action_cate_chirld(this, ' . $cate['id'] . ', \'' . $cate['name'] . '\')">
                                <div class="d-flex align-items-center justify-content-between">
                                    ' . $cate['name'] . '
                                    <i class="ph ph-caret-right"></i>
                                </div>
                            </li>';
                }
                echo $out_put;
            }
        }
    }
    public function get_attri_val_by_attri_id()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->attri_val_model->setattri_id($_POST['attri_id']);
            $data = $this->attri_val_model->get_all_attri_val_by_attri_id($this->attri_val_model);
            if (!empty($data)) {
                $out_put = '<option value="">Chọn</option>';
                foreach ($data as $attri_val) {
                    $out_put .= '<option data-type="' . $attri_val['id'] . '" value="' . $attri_val['id'] . '">' . $attri_val['name'] . '</option>';
                }
                echo $out_put;
            }
        }
    }
    public function get_attri_val_select2()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->attri_val_model->setattri_id(2);
            $data = $this->attri_val_model->get_all_attri_val_by_attri_id($this->attri_val_model);
            if (!empty($data)) {
                $out_put = '
                 <div class="row g-2 containeroption">
                    <div class="col-2">
                        <p class="fs-15">Phân loại 2</p>
                    </div>
                    <div class="col-10">
                        <div class="d-flex align-items-center justify-content-between">
                        <select class="custom-formselect w-50 main-select" id="check_show_option2">
                            <option value="2">Size</option>
                        </select>
                        <button type="button" onclick="del_select2()" class="btn text-secondary fs-5"><i class="fa-solid fa-delete-left"></i></button>
                        </div>
                    </div>
                    <div class="col-2">
                        <p class="fs-15">Tùy chọn</p>
                    </div>
                    <div class="col-10">
                        <div class="row g-2 select-group">
                            <div class="col-6 select-template">
                                <div class="d-flex align-items-center justify-content-between gap-1">
                                    <select name="pro_two_option[]" class="custom-formselect w-100 option-select show_select show_option_select2">
                                        <option value="">Chọn</option>';
                foreach ($data as $attri_val) {
                    $out_put .= '<option value="' . $attri_val['id'] . '">' . $attri_val['name'] . '</option>';
                }
                $out_put .= '</select>
                                                    <div class="text-secondary del_option" style="cursor: pointer;">
                                                        <i class="ph ph-trash-simple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                ';
                echo $out_put;
            }
        }
    }


    //cart
    public function update_quantity_cart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id']) && isset($_POST['quantity'])) {
            $this->cart_model->__sets(['quantity_new'=> $_POST['quantity'], 'id' => $_POST['cart_id']]);
            $check = $this->cart_model->update_cart();
            if ($check > 0) {
                echo 1;
            }
        }
    }

    // order
    public function get_province()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = $this->province_model->get_all_province();
            if (!empty($data)) {
                $out_put = '';
                foreach ($data as $province) {
                    $out_put .= '<li onclick="get_district_province_id(\'' . $province['id'] . '\', \'' . $province['name'] . '\')">' . $province['name'] . '</li>';
                }
                echo $out_put;
            }
        }
    }
    public function get_district_province_id()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->district_model->__set('province_id', $_POST['province_id']);
            $data = $this->district_model->get_all_district_by_province_id();
            if (!empty($data)) {
                $out_put = '';
                foreach ($data as $district) {
                    $out_put .= '<li onclick="get_ward_district_id(\'' . $district['id'] . '\', \'' . $district['name'] . '\')">' . $district['name'] . '</li>';
                }
                echo $out_put;
            }
        }
    }
    public function get_ward_district_id()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->ward_model->__set('district_id', $_POST['district_id']);
            $data = $this->ward_model->get_all_ward_by_district_id();
            if (!empty($data)) {
                $out_put = '';
                foreach ($data as $ward) {
                    $out_put .= '<li onclick="action_ward(\'' . $ward['name'] . '\')">' . $ward['name'] . '</li>';
                }
                echo $out_put;
            }
        }
    }

    //User
    public function update_address()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user']['id'] ?? 0;
            $this->user_model->__sets([trim($_POST['name']), trim($_POST['phone']), trim($_POST['address']), trim($_POST['address_detail']), $user_id]);
            $check = $this->user_model->update_order_user($this->user_model);
            if ($check > 0) {
                $_SESSION['user']['name'] = $_POST['name'];
                $_SESSION['user']['phone'] = $_POST['phone'];
                $_SESSION['user']['address'] = $_POST['address'];
                $_SESSION['user']['address_detail'] = $_POST['address_detail'];
                echo $check;
            }
        }
    }
    public function check_email() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user_model->__set('email', trim($_POST['email']));
            $check = $this->user_model->get_user_login();
            if(!empty($check)) {
                echo 1;
            }
        }
    }
}
