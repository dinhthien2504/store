<?php
namespace app\controllers;
use app\controllers\Base;

class Ajax extends Base
{
    public $data;
    private $ProVariantModel, $CategoryModel, $AttriValueModel, $CartModel, $ProvinceModel, $DistrictModel, $WardModel, $UserModel;
    public function __construct()
    {
        $this->ProVariantModel = $this->model('ProVariantModel');
        $this->CategoryModel = $this->model('CategoryModel');
        $this->AttriValueModel = $this->model('AttriValueModel');
        $this->CartModel = $this->model('CartModel');
        $this->ProvinceModel = $this->model('ProvinceModel');
        $this->DistrictModel = $this->model('DistrictModel');
        $this->WardModel = $this->model('WardModel');
        $this->UserModel = $this->model('UserModel');
    }
    //Các hàm trang sản phẩm
    public function get_size()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ProVariantModel->__set('pro_id', $_POST['pro_id']);
            $this->ProVariantModel->__set('cor_id', $_POST['cor_id']);
            $data = $this->ProVariantModel->get_size_by_cor_id();
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
            $this->ProVariantModel->__set('pro_id', $_POST['pro_id']);
            if (isset($_POST['cor_id']) && isset($_POST['size_id'])) {
                $this->ProVariantModel->__set('cor_id', $_POST['cor_id']);
                $this->ProVariantModel->__set('size_id', $_POST['size_id']);
            }
            if (isset($_POST['cor_id']) && !isset($_POST['size_id'])) {
                $this->ProVariantModel->__set('cor_id', $_POST['cor_id']);
            }
            if (isset($_POST['size_id']) && !isset($_POST['cor_id'])) {
                $this->ProVariantModel->__set('size_id', $_POST['size_id']);
            }
            $data = $this->ProVariantModel->get_quantity();
            echo json_encode($data);
        }
    }

    //cart
    public function update_quantity_cart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id']) && isset($_POST['quantity'])) {
            $this->CartModel->__sets(['quantity_new' => $_POST['quantity'], 'id' => $_POST['cart_id']]);
            $check = $this->CartModel->update_cart();
            if ($check > 0) {
                echo 1;
            }
        }
    }

    // order
    public function get_province()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = $this->ProvinceModel->get_all_province();
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
            $this->DistrictModel->__set('province_id', $_POST['province_id']);
            $data = $this->DistrictModel->get_all_district_by_province_id();
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
            $this->WardModel->__set('district_id', $_POST['district_id']);
            $data = $this->WardModel->get_all_ward_by_district_id();
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
            $this->UserModel->__sets([trim($_POST['name']), trim($_POST['phone']), trim($_POST['address']), trim($_POST['address_detail']), $user_id]);
            $check = $this->UserModel->update_order_user($this->usemodel);
            if ($check > 0) {
                $_SESSION['user']['name'] = $_POST['name'];
                $_SESSION['user']['phone'] = $_POST['phone'];
                $_SESSION['user']['address'] = $_POST['address'];
                $_SESSION['user']['address_detail'] = $_POST['address_detail'];
                echo $check;
            }
        }
    }
    public function check_email()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->UserModel->__set('email', trim($_POST['email']));
            $check = $this->UserModel->get_user_login();
            if (!empty($check)) {
                echo 1;
            }
        }
    }

    //Các hàm trang thêm sản phẩm admin
    public function get_cate_chirld_by_parent()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->CategoryModel->__set('parent_id', $_POST['parent_id']);
            $data = $this->CategoryModel->get_all_cate_by_parent_id();
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
            $this->AttriValueModel->__set('attri_id',$_POST['attri_id']);
            $data = $this->AttriValueModel->get_all_attri_val_by_attri_id();
            if (!empty($data)) {
                $out_put = '<option value="">Chọn</option>';
                foreach ($data as $attri_val) {
                    $out_put .= '<option data-type="' . $attri_val['id'] . '" value="' . $attri_val['id'] . '">' . $attri_val['name'] . '</option>';
                }
                echo $out_put;
            }
        }
    }
    public function get_attri_val_select_2()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->AttriValueModel->__set('attri_id', 2);
            $data = $this->AttriValueModel->get_all_attri_val_by_attri_id();
            if (!empty($data)) {
                $__out_put = '
                 <div class="row g-2 container__option">
                    <div class="col-2">
                        <p class="fs-15">Phân loại 2</p>
                    </div>
                    <div class="col-10">
                        <div class="d-flex align-items-center justify-content-between">
                        <select class="custom-form__select w-50 main-select" id="check_show_option2">
                            <option value="2">Size</option>
                        </select>
                        <button type="button" onclick="del_select__2()" class="btn text-secondary fs-5"><i class="fa-solid fa-delete-left"></i></button>
                        </div>
                    </div>
                    <div class="col-2">
                        <p class="fs-15">Tùy chọn</p>
                    </div>
                    <div class="col-10">
                        <div class="row g-2 select-group">
                            <div class="col-6 select-template">
                                <div class="d-flex align-items-center justify-content-between gap-1">
                                    <select name="pro_two_option[]" class="custom-form__select w-100 option-select show_select show_option_select2">
                                        <option value="">Chọn</option>';
                foreach ($data as $attri_val) {
                    $__out_put .= '<option value="' . $attri_val['id'] . '">' . $attri_val['name'] . '</option>';
                }
                $__out_put .= '</select>
                                                    <div class="text-secondary del_option" style="cursor: pointer;">
                                                        <i class="ph ph-trash-simple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                ';
                echo $__out_put;
            }
        }
    }

    //Các hàm xử lý danh mục admin
    public function get_cate_by_cate_id()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->CategoryModel->__set('id', $_POST['cate_id']);
            $data = $this->CategoryModel->get_one_cate_by_id();
            if (!empty($data)) {
                $data_cate_parent = $this->CategoryModel->get_all_cate_parent_edit();
                $url_main = 'https://static.vecteezy.com/system/resources/thumbnails/014/440/983/small_2x/image-icon-design-in-blue-circle-png.png';
                $url_img = ($data['url_image'] == null) ? $url_main : ''._WEB_ROOT_.'/public/assets/img/cate/'.$data['url_image'];
                $output = '';
                $output .= '<div class="mb-3">
                    <label class="fs-15" for="name_cate">Tên danh mục <span class="star">*</span></label>
                    <input type="text" class="form-control fs-15" value="'.$data['name'].'" id="name_cate_edit" name="name_cate">
                    </div>                                                                  
                    <div class="mb-3">  
                        <label class="fs-15" for="parent_id">Danh mục cha</label>
                        <select class="form-select fs-15" id="parent_id" name="parent_id">  
                            <option value="0">None</option>';
                            foreach($data_cate_parent as $cate) {
                                $selected = ($data['parent'] == $cate['id']) ? 'selected' : '';
                                $output .= '<option value="'.$cate['id'].'" '.$selected.'>'.$cate['name'].'</option>';
                            }
                        $output .= '</select>
                    </div>
                    <div class="mb-3">
                        <label class="fs-15" for="img_cate">Hình ảnh</label>
                        <div onclick="action_input(this)"
                            class="custom-content__box--img--basic custom--flex__column">
                            <input type="hidden" name="cate_id" value="'.$data['id'].'">
                            <input type="hidden" name="parent_old" value="'.$data['parent'].'">
                            <p class="m-0 fs-12 text-center">Chọn ảnh</p>
                            <input type="file" hidden name="img_cate" class="input_file" onchange="handle_img__cor_change(this)">
                            <div class="d-flex flex-column align-items-center justify-content-center text-center custom-text-primary w-100">
                                <img src="'.$url_img.'" class="w-50 h-50" alt="hinh-anh">
                            </div>
                        </div>
                    </div>';
                    echo $output;
            }
        }
    }
}
