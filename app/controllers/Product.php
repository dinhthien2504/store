<?php
namespace app\controllers;

class Product extends Base
{
    public $data = [];
    private $category_model;
    private $product_model;
    private $pro_image_model;
    private $pro_variant_model;
    public function __construct()
    {
        $this->category_model = $this->model('CategoryModel');
        $this->product_model = $this->model('ProductModel');
        $this->pro_image_model = $this->model('ProImageModel');
        $this->pro_variant_model = $this->model('ProVariantModel');
    }
    public function list($parent_id, $cate_id = null)
    {
        $item_page = 12;
        $this->product_model->__set('item_page', $item_page);
        //Set điều kiện để lọc
        if (!empty($_GET)) {
            $filters = $this->handle_filter($_GET);
            $this->product_model->__set('filter', $filters);
        }

        //Gán id danh mục cha và con để lấy dữ liệu
        $this->product_model->__set('parent_id', $parent_id);
        if ($cate_id !== 'null') {
            $this->product_model->__set('cate_id', $cate_id);
        }
        //Đếm tất cả sản phẩm lấy được để tính số lượng trang
        $count_pro_cate_id = $this->product_model->count_all_pro_by_cate_id();

        //Lấy page hiện tại để tính vị trí lấy sản phẩm
        $page = $_GET['page'] ?? 1;
        $this->product_model->__set('current_page', $page);
        $total_page = ceil($count_pro_cate_id['total_pro'] / $item_page);

        //Xử lý đường dẫn cho phân trang
        if ($total_page > 1) {
            $links = $this->handle_url_page($total_page, $page);
            $this->data['sub_content']['links'] = $links;
        }

        //Xử lý đường dẫn cho next với prev
        $link_prev = $this->handle_prev_page($page);
        $this->data['sub_content']['prev'] = $link_prev;

        $link_next = $this->handle_next_page($page, $total_page);
        $this->data['sub_content']['next'] = $link_next;

        //Truyền total_page vào view
        $this->data['sub_content']['total_page'] = $total_page;

        //Gán giá trị tổng số page vào model để xử lý
        $this->product_model->__set('total_page', $total_page);
        
        //Lấy dữ liệu nếu có filter
        $data_pro_cate_id = $this->product_model->get_all_pro_by_cate_id();
        $this->data['sub_content']['pro_cate_id'] = $data_pro_cate_id;

        //Dữ liệu danh mục 
        $this->category_model->__set('parent_id', $parent_id);
        $data_cate_parent_id = $this->category_model->get_all_cate_by_parent_id();
        $this->data['sub_content']['cate_id'] = $cate_id;
        $this->data['sub_content']['cate_by_parent_id'] = $data_cate_parent_id;

        $this->data['title_page'] = 'Danh Sách Sản Phẩm';
        $this->data['content'] = 'products/list';
        $this->render('layouts/main', $this->data);
    }

    public function detail($id)
    {
        //Lấy sản phẩm theo id
        $this->product_model->__set('id', $id);
        $data_pro_id = $this->product_model->get_one_pro_by_id();

        //Kiểm tra có dữ liệu của sản phẩm đó hay không
        if (empty($data_pro_id)) {
            exit('ID does not exits!');
        }
        $this->data['sub_content']['pro_id'] = $data_pro_id;

        //Lấy danh mục cha theo danh mục con
        $this->category_model->__set('cate_id', $data_pro_id['cate_id']);
        $data_cate_parent_id = $this->category_model->get_one_cate_parent();
        $this->data['sub_content']['data_cate'] = $data_cate_parent_id;
        
        //Lấy ảnh sản phẩm theo id
        $this->pro_image_model->__set('pro_id', $id);
        $data_imgs_pro = $this->pro_image_model->get_all_img_by_pro_id();
        $this->data['sub_content']['pros_image'] = $data_imgs_pro;

        //Dữ liệu có cả màu và size
        $this->pro_variant_model->__set('pro_id', $id);
        $data_cor_size_pro_id = $this->pro_variant_model->get_cor_size_by_pro_id();
        if (!empty($data_cor_size_pro_id)) {
            $this->data['sub_content']['cor_size_pro_id'] = $data_cor_size_pro_id;
            $this->pro_variant_model->__set('cor_id', $data_cor_size_pro_id[0]['cor_id']);
            $data_size_cor_id = $this->pro_variant_model->get_size_by_cor_id();
            $this->data['sub_content']['size_cor_id'] = $data_size_cor_id;
        }
        //Dữ liệu khi chỉ có màu
        $data_color_pro_id = $this->pro_variant_model->get_color_by_pro_id();
        if (!empty($data_color_pro_id)) {
            $this->data['sub_content']['color_pro_id'] = $data_color_pro_id;
        }
        //Dữ liệu khi chỉ có size
        $data_size_pro_id = $this->pro_variant_model->get_size_by_pro_id();
        if (!empty($data_size_pro_id)) {
            $this->data['sub_content']['size_pro_id'] = $data_size_pro_id;
        }

        //Lấy sản phẩm theo danh mục
        $this->product_model->__set('cate_id', $data_pro_id['cate_id']);
        $data_pro_cate_id = $this->product_model->get_pro_relate_by_cate_id();
        $this->data['sub_content']['pro_cate_id'] = $data_pro_cate_id;
        $this->data['title_page'] = $data_pro_id['name'];
        $this->data['content'] = 'products/detail';
        $this->render('layouts/main', $this->data);
    }

    private function handle_filter($data)
    {
        $filters = [];
        $minPrice = $data['minPrice'] ?? '';
        if ($minPrice) {
            $filters[] = ' AND pro.price >= ' . $minPrice;
        }
        $maxPrice = $data['maxPrice'] ?? '';
        if ($maxPrice) {
            $filters[] = ' AND pro.price <= ' . $maxPrice;
        }
        $sortBy = $data['sortBy'] ?? '';
        $order = $data['order'] ?? 'DESC';
        if ($sortBy) {
            $filters[] = ' ORDER BY pro.' . $sortBy . ' ' . $order . ' ';
        }
        return $filters;
    }               
}