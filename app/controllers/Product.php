<?php
namespace app\controllers;

class Product extends Base{
    public $data = [];
    private $product_model;
    private $pro_image_model;
    private $pro_variant_model;
    public function __construct() {
        $this->product_model = $this->model('ProductModel');
        $this->pro_image_model = $this->model('ProImageModel');
        $this->pro_variant_model = $this->model('ProVariantModel');
    }
    public function index() {
        echo 'Trang sản phẩm';
    }

    public function detail($id) { 
        //Lấy sản phẩm theo id
        $this->product_model->__set('id', $id);
        $data_pro_id = $this->product_model->get_one_pro_by_id();
        
        //Kiểm tra có dữ liệu của sản phẩm đó hay không
        if(empty($data_pro_id)) {
            exit('ID does not exits!');
        }

        $this->data['sub_content']['pro_id'] = $data_pro_id;
        //Lấy ảnh sản phẩm theo id
        $this->pro_image_model->__set('pro_id', $id);
        $data_imgs_pro = $this->pro_image_model->get_all_img_by_pro_id();
        $this->data['sub_content']['pros_image'] = $data_imgs_pro;

        //Dữ liệu có cả màu và size
        $this->pro_variant_model->__set('pro_id', $id);
        $data_cor_size_pro_id = $this->pro_variant_model->get_cor_size_by_pro_id();
        if(!empty($data_cor_size_pro_id)) {
            $this->data['sub_content']['cor_size_pro_id'] = $data_cor_size_pro_id;
            $this->pro_variant_model->__set('cor_id',$data_cor_size_pro_id[0]['cor_id']);
            $data_size_cor_id = $this->pro_variant_model->get_size_by_cor_id();
            $this->data['sub_content']['size_cor_id'] = $data_size_cor_id;
        }
        //Dữ liệu khi chỉ có màu
        $data_color_pro_id = $this->pro_variant_model->get_color_by_pro_id();
        if(!empty($data_color_pro_id)) {
            $this->data['sub_content']['color_pro_id'] = $data_color_pro_id;
        }
        //Dữ liệu khi chỉ có size
        $data_size_pro_id = $this->pro_variant_model->get_size_by_pro_id();
        if(!empty($data_size_pro_id)) {
            $this->data['sub_content']['size_pro_id'] = $data_size_pro_id;
        }
        $this->data['title_page'] = $data_pro_id['name'];
        $this->data['content'] = 'products/detail';
        $this->render('layouts/main', $this->data);
    }
}