<?php 
namespace app\controllers\admin;
use app\controllers\Base;
class Product extends Base{
    public $data;
    private $ProductModel, $CategoryModel, $AttritubeModel, $AttriValueModel, $ProImageModel, $ProVariantModel;
    public function __construct() {
        $this->ProductModel = $this->model('ProductModel');
        $this->CategoryModel = $this->model('CategoryModel');
        $this->AttritubeModel = $this->model('AttritubeModel');
        $this->AttriValueModel = $this->model('AttriValueModel');
        $this->ProImageModel = $this->model('ProImageModel');
        $this->ProVariantModel = $this->model('ProVariantModel');
    }
    public function index() {
        $data_all_pro = $this->ProductModel->get_all_pro_admin();
        $this->data['sub_content']['data_all_pro'] = $data_all_pro;
        $this->data['title_page'] = 'Quản Lý Sản Phẩm';
        $this->data['content'] = 'admin/products/index';
        $this->render('layouts/main_admin', $this->data);
    }
    public function add() {
        //Dữ liệu danh mục cha
        $data_cate_parent = $this->CategoryModel->get_all_cate_parent_admin();
        $this->data['sub_content']['data_cate_parent'] = $data_cate_parent;
        //Dữ liệu thuộc tính
        $data_attri = $this->AttritubeModel->get_all_attri();
        $this->data['sub_content']['data_attri'] = $data_attri;
        //Dữ liệu giá trị thuộc tính
        $this->AttriValueModel->__set('attri_id', 1);
        $data_attri_val_by_attri_cor = $this->AttriValueModel->get_all_attri_val_by_attri_id();
        $this->data['sub_content']['data_attri_val_by_attri_cor'] = $data_attri_val_by_attri_cor;

        $this->data['title_page'] = 'Thêm Sản Phẩm';
        $this->data['content'] = 'admin/products/add';
        $this->render('layouts/main_admin', $this->data);
    }
    public function edit($__pro_id) {
        //Dữ liệu sản phẩm theo pro_id
        $this->__product_model->set__id($__pro_id);
        $__data_pro_id = $this->__product_model->get_pro_by_id($this->__product_model);
        $this->__data['sub_content']['data_pro_id'] = $__data_pro_id;
        //Dữ liệu ảnh sản phẩm theo pro_id
        $this->__pro_image_model->set__pro_id($__pro_id);
        $__data_img__main_pro_id = $this->__pro_image_model->get_all_img_by_pro__id($this->__pro_image_model);
        $this->__data['sub_content']['data_img_main_pro_id'] = $__data_img__main_pro_id;
        //Lấy dữ liệu cả danh mục cha và danh mục con
        $this->__category_model->set__id($__data_pro_id['cate_id']);
        $__data_cate_by_id = $this->__category_model->get_cate_by_cate_id($this->__category_model);
        $this->__data['sub_content']['data_cate_by_id'] = $__data_cate_by_id;
        //Dữ liệu danh mục cha và con
        $__data_cate_parent = $this->__category_model->get_all_cate_perent_admin();
        $this->__data['sub_content']['data_cate_parent'] = $__data_cate_parent;
        //Dữ liệu thông tin danh mục theo parent_id
        $this->__category_model->set__parent($__data_cate_by_id['parent_id']);
        $__data_cate_by_parent = $this->__category_model->get_all_cate_by_parent_id($this->__category_model);
        $this->__data['sub_content']['data_cate_by_parent'] = $__data_cate_by_parent;
        //Dữ liệu thuộc tính 
        $__data_attri = $this->__attri_model->get_all_attri();
        $this->__data['sub_content']['data_attri'] = $__data_attri;

        //Xử lý phân loại
        $this->__pro_variant_model->set__pro_id($__pro_id);

        //Nếu sản phẩm đó có cả màu và size
        $__data_variant_cor_and_size = $this->__pro_variant_model->get_cor_size_by_pro_id($this->__pro_variant_model);
        if(!empty($__data_variant_cor_and_size)) {
            $this->__data['sub_content']['data_variant_cor_and_size'] = $__data_variant_cor_and_size;
            //Dữ liệu giá trị thuộc tính màu
            $this->__attri_val_model->set__attri_id(1);
            $__data_attri_val_by_attri_cor = $this->__attri_val_model->get_all_attri_val_by_attri_id($this->__attri_val_model);
            $this->__data['sub_content']['data_attri_val_by_attri_cor'] = $__data_attri_val_by_attri_cor;
            //Lấy size
            $this->__pro_variant_model->set__cor_id($__data_variant_cor_and_size[0]['cor_id']);
            $__data_size_by_cor_id = $this->__pro_variant_model->get_size_by_cor_id($this->__pro_variant_model);
            $this->__data['sub_content']['data_size_by_cor_id'] = $__data_size_by_cor_id;
            //Dữ liệu giá trị thuộc tính size
            $this->__attri_val_model->set__attri_id(2);
            $__data_attri_val_by_attri_size = $this->__attri_val_model->get_all_attri_val_by_attri_id($this->__attri_val_model);
            $this->__data['sub_content']['data_attri_val_by_attri_size'] = $__data_attri_val_by_attri_size;
            
        }
        

        //Nếu sản phẩm đó chỉ có màu
        $__data_variant_cor = $this->__pro_variant_model->get_color_by_pro_id($this->__pro_variant_model);
        if(!empty($__data_variant_cor)) {
            $this->__data['sub_content']['data_variant_cor'] = $__data_variant_cor;
            //Dữ liệu giá trị thuộc tính màu
            $this->__attri_val_model->set__attri_id(1);
            $__data_attri_val_by_attri_cor = $this->__attri_val_model->get_all_attri_val_by_attri_id($this->__attri_val_model);
            $this->__data['sub_content']['data_attri_val_by_attri_cor'] = $__data_attri_val_by_attri_cor;
        }

        //Nếu sản phẩm chỉ có size
        $__data_variant_size = $this->__pro_variant_model->get_size_by_pro_id($this->__pro_variant_model);
        if(!empty($__data_variant_size)) {
            $this->__data['sub_content']['data_variant_size'] = $__data_variant_size;
            //Dữ liệu giá trị thuộc tính size
            $this->__attri_val_model->set__attri_id(2);
            $__data_attri_val_by_attri_size = $this->__attri_val_model->get_all_attri_val_by_attri_id($this->__attri_val_model);
            $this->__data['sub_content']['data_attri_val_by_attri_size'] = $__data_attri_val_by_attri_size;
        }


        //Dữ liệu tất cả thuộc tính của sản phẩm để chekk số lượng
        $__data_variant_pro_id = $this->__pro_variant_model->get_all_variant_pro_id($this->__pro_variant_model);
        $this->__data['sub_content']['data_variant_pro_id'] = $__data_variant_pro_id;
        $this->__data['title_page'] = 'Cập Nhật Sản Phẩm';
        $this->__data['content'] = 'admin/products/edit';
        $this->render('layouts/admin_layout', $this->__data);
    }
    public function handle_add() {
        if (isset($_POST['submit__pro']) && $this->validate_pro_data($_POST)) {
            $this->handle_pro_data($_POST);//$pro->get__cate_id(), $pro->get__name(), $pro->get__price(), $pro->get__discount_percent(), $pro->get__description()
            $pro_id = $this->ProductModel->insert_pro();
            if ($pro_id) {
                $target_dir = dirname(__DIR__, 3) . "/assets/img/pro/";
                // Xử lý ảnh chính
                if (!empty($_FILES['pro_img__main']['name'])) {
                    $this->handle_upload_img_main($_FILES['pro_img__main'], $pro_id, $target_dir);
                }
                // Xử lý các tùy chọn màu và size
                $pro_stock = $_POST['pro_stock'] ?? [];
                $files_cor = $_FILES['pro_img__cor'] ?? null;
                $__data_one = $_POST['pro_one_option'] ?? [];
                $__data_two = $_POST['pro_two_option'] ?? [];
        
                if (!empty($__data_one) && !empty($__data_two)) {
                    $this->handle_double_options($pro_id, $__data_one, $__data_two, $pro_stock, $files_cor, $target_dir);
                } elseif (!empty($files_cor)) {
                    $this->handle_single_option($pro_id, $__data_one, $pro_stock, $files_cor, 'color', $target_dir);
                } elseif ($files_cor == null) {
                    $this->handle_single_option($pro_id, $__data_one, $pro_stock, $files_cor, 'size', $target_dir);
                }
                $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Thêm sản phẩm thành công!', 'type' => 'success'];
                header('Location: '._WEB_ROOT_.'/admin/product');
            }
        }
    }

    public function handle_edit() {
        if (isset($_POST['submit__pro']) && $this->validate_pro_data($_POST)) {
            $this->__product_model->set__id($_POST['pro__id']);
            $this->handle_pro_data($_POST);
            $this->__product_model->update_pro($this->__product_model);
            //Xử lý ảnh chính xem có bị xóa ảnh nào không
            $target_dir = dirname(__DIR__, 3) . "/public/assets/img/pro/";
            //Lấy dữ liệu ảnh có sẳn của sản phẩm
            $check_img__mains = $_POST['check_img__mains'] ?? [];
            $this->handle_img_main($_POST['pro__id'], $check_img__mains , $_FILES['pro_img__main'] , $target_dir);
            // Xử lý các tùy chọn màu và size
            $pro_stock = $_POST['pro_stock'] ?? [];
            $files_cor = $_FILES['pro_img__cor'] ?? null;
            $__data_one = $_POST['pro_one_option'] ?? [];
            $__data_two = $_POST['pro_two_option'] ?? [];

            $this->__pro_variant_model->set__pro_id($_POST['pro__id']);

            //Lấy id variant có sẳn của sản phẩm
            $pro_variant_olds = $_POST['check_variant_olds'] ?? [];

            if(!empty($pro_variant_olds)) {
                $__data_variant_img_olds = $_POST['check_variant_img_olds'] ?? [];
                if (!empty($__data_one) && !empty($__data_two)) {
                    $this->handle_update_double_options($__data_one, $__data_two, $__data_variant_img_olds, $files_cor, $pro_variant_olds, $pro_stock, $target_dir);
                }else {
                    $this->handle_update_single_option($pro_variant_olds, $__data_one, $__data_variant_img_olds, $pro_stock, $files_cor, $target_dir);
                }
            }else {
                //Xóa tất cả thuộc tính trước đó
                $this->__pro_variant_model->delete_variant_pro($this->__pro_variant_model);
                if (!empty($__data_one) && !empty($__data_two)) {
                    $this->handle_double_options($_POST['pro__id'], $__data_one, $__data_two, $pro_stock, $files_cor, $target_dir);
                }else if($files_cor) {
                    $this->handle_single_option($_POST['pro__id'], $__data_one, $pro_stock, $files_cor, 'color', $target_dir);
                }else {
                    $this->handle_single_option($_POST['pro__id'], $__data_one, $pro_stock, $files_cor, 'size', $target_dir);
                }
            } 
            $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Cập nhật sản phẩm thành công!', 'type' => 'success'];
            header('Location: '._WEB_ROOT_.'/admin/san-pham');
        }
    }
    private function validate_pro_data($data) {
        return !empty($data['pro__cate']) && 
               !empty($data['pro__name']) && 
               !empty($data['pro__price']);
    }
    //$pro->get__cate_id(), $pro->get__name(), $pro->get__price(), $pro->get__discount_percent(), $pro->get__description()
    private function handle_pro_data($post_data) {
        $pro_cate = trim($post_data['pro__cate']);
        $pro_name = trim($post_data['pro__name']);
        $pro_price = $post_data['pro__price'] ?? 0;
        $pro_discount_percent = $post_data['pro__discount'] ?? 0;
        $pro_description = $post_data['pro__description'] ?? '';
        $pro_status = $post_data['submit__pro'] ?? 0;

        $this->ProductModel->__sets([$pro_cate, $pro_name, $pro_price, $pro_discount_percent, $pro_description, $pro_status]);
    }
    private function save_variant($pro_id, $cor_id, $size_id, $url_image, $quantity) {
        $this->ProVariantModel->__sets([$pro_id, $cor_id, $size_id, $url_image, $quantity]);
        $this->ProVariantModel->insert_variant_pro();
    }
    private function handle_upload_img_main($files, $pro_id, $target_dir) {
        foreach ($files['name'] as $index => $file) {
            if (empty($file)) continue;
            $this->ProImageModel->__sets([$pro_id, $file]);
            $this->ProImageModel->insert_image_pro();
    
            $tmp_name = $files['tmp_name'][$index];
            $address_img = $target_dir . $file;
            move_uploaded_file($tmp_name, $address_img);
        }
    }
    
    private function handle_double_options($pro_id, $data_cors, $data_sizes, $pro_stock, $files_cor, $target_dir) {
        $stok_index = 0;
        foreach ($data_cors as $index => $cor) {
            if (empty($cor)) continue;
            foreach ($data_sizes as $size) {
                if (empty($size)) continue;
                $this->save_variant($pro_id, $cor, $size, $files_cor['name'][$index] ?? null, $pro_stock[$stok_index] ?? 0);  
                if (!empty($files_cor['tmp_name'][$index])) {
                    $tmp_name = $files_cor['tmp_name'][$index];
                    $address_img = $target_dir . $files_cor['name'][$index];
                    move_uploaded_file($tmp_name, $address_img);
                }
    
                $stok_index++;
            }
        }
    }
    
    private function handle_single_option($pro_id, $data, $pro_stock, $files_cor, $type, $target_dir) {
        foreach ($data as $index => $value) {
            if (empty($value)) continue;
    
            $cor_id = $type === 'color' ? $value : null;
            $size_id = $type === 'size' ? $value : null;
            $url_image = $files_cor['name'][$index] ?? null;
            $quantity = $pro_stock[$index] ?? 0;
    
            $this->save_variant($pro_id, $cor_id, $size_id, $url_image, $quantity);
    
            if ($url_image != null) {
                $tmp_name = $files_cor['tmp_name'][$index];
                $address_img = $target_dir . $files_cor['name'][$index];
                move_uploaded_file($tmp_name, $address_img);
            }
        }
    }
    private function update_variant($id, $quantity, $url_image) {
        $this->__pro_variant_model->set__id($id);
        $this->__pro_variant_model->set__quantity($quantity);
        $this->__pro_variant_model->set__url_image($url_image);
        $this->__pro_variant_model->update_variant_pro($this->__pro_variant_model);
    }
    private function handle_update_double_options($__data_cors, $__data_size, $__data_variant_img_olds, $files_cor, $pro_variant_olds, $pro_stock, $target_dir) {
        $__index = 0;
        foreach ($__data_cors as $index => $cor) {
            if (empty($cor)) continue;
            $__handle_file = empty($files_cor['name'][$index]) ? $__data_variant_img_olds[$__index] :  $files_cor['name'][$index];
            foreach ($__data_size as $size) {
                if (empty($size)) continue; 
                echo $__handle_file;
                echo '<br>';
                $this->update_variant($pro_variant_olds[$__index], $pro_stock[$__index], $__handle_file);
                $__index++;
            }
            if (!empty($files_cor['tmp_name'][$index])) {
                $tmp_name = $files_cor['tmp_name'][$index];
                $address_img = $target_dir . $files_cor['name'][$index];
                move_uploaded_file($tmp_name, $address_img);
            }
        }
    }
    private function handle_img_main($__pro_id, $check_img__mains, $file_pro_main , $target_dir) {
        //Dữ liệu ảnh sản phẩm theo pro_id
        $this->__pro_image_model->set__pro_id($__pro_id);
        $__data_img__main_pro_id = $this->__pro_image_model->get_all_img_by_pro__id($this->__pro_image_model);
        //Lấy tất cả id ảnh sản phẩm
        $id_pro__img = array_column($__data_img__main_pro_id, 'id');
        //Kiểm tra xem ảnh nào bị xóa thì xóa trên cơ sở dữ liệu
        $img__mains_to_delete = array_diff($id_pro__img, $check_img__mains);
        if(!empty($img__mains_to_delete)){
            foreach ($img__mains_to_delete as $img_id) {
                $this->__pro_image_model->set__id($img_id);
                $this->__pro_image_model->delete_img_pro($this->__pro_image_model);
            }
        }
        //Xử lý hình ảnh
        if(!empty($file_pro_main['name'])) {
            //upload nếu có ảnh mới
            $this->handle_upload_img_main($file_pro_main, $__pro_id, $target_dir);
        }
    }
    private function handle_update_single_option($pro_variant_olds, $data, $__data_variant_img_olds, $pro_stock, $files_cor, $target_dir) {
        foreach ($data as $index => $value) {
            if (empty($value)) continue;
            $__handle_file = empty($files_cor['name'][$index]) ? $__data_variant_img_olds[$index] :  $files_cor['name'][$index];
            $quantity = $pro_stock[$index] ?? 0;
            $this->update_variant($pro_variant_olds[$index], $quantity, $__handle_file);
            if (!empty($files_cor['tmp_name'][$index])) {
                $tmp_name = $files_cor['tmp_name'][$index];
                $address_img = $target_dir . $files_cor['name'][$index];
                move_uploaded_file($tmp_name, $address_img);
            }
        }
    }

    //Xóa sản phẩm
    public function handle_del($__pro_id) {
        if($__pro_id > 0) {
            //Xóa tất cả ảnh sản phẩm
            $this->handle_del_img_main($__pro_id);
            //Xóa phân loại của sản phẩm
            $this->handle_del_variant_pro($__pro_id);

            //Xóa thông tin sản phẩm
            $this->__product_model->set__id($__pro_id);
            $__check_del_pro = $this->__product_model->delete_pro($this->__product_model);
            if($__check_del_pro > 0 ) {
                $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Xóa sản phẩm thành công!', 'type' => 'success'];
                header('Location: '._WEB_ROOT_.'/admin/san-pham');
            }
        }
    }
    private function handle_del_img_main($__pro_id) {
        $this->__pro_image_model->set__pro_id($__pro_id);
        $__link_img = $this->__pro_image_model->get_all_img_by_pro__id($this->__pro_image_model);
        if(!empty($__link_img)) {
            $this->handle_unlink_pro($__link_img);
        }
        return $this->__pro_image_model->delete_img_pro($this->__pro_image_model);
    }
    private function handle_del_variant_pro($__pro_id) {
        $this->__pro_variant_model->set__pro_id($__pro_id);
        $__link_img = $this->__pro_variant_model->get_all_img_variant_by_pro_id($this->__pro_variant_model);
        if(!empty($__link_img)) {
            $this->handle_unlink_pro($__link_img);
        }
        return $this->__pro_variant_model->delete_variant_pro($this->__pro_variant_model);
    }
    private function handle_unlink_pro($__link_img) {
        foreach ($__link_img as $img) {
            $file_path = dirname(__DIR__, 3) . '/public/assets/img/pro/' . $img['url_image'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }
    public function handle_del_groups() {
        if( isset($_POST['pro__del_groups'])) {
            $__pro_del_groups = $_POST['pro__del_groups'] ?? [];
            if(!empty($__pro_del_groups)) {
                foreach ($__pro_del_groups as $pro_id) {
                    $this->handle_del($pro_id);
                }
                $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Xóa nhóm sản phẩm thành công!', 'type' =>'success'];
            }
        }else {
            $_SESSION['messager'] = ['title' => 'Cảnh báo!', 'mess' => 'Vui lòng chọn sản phẩm để xóa!', 'type' => 'error'];
        }
        header('Location: '._WEB_ROOT_.'/admin/san-pham');
    }
}