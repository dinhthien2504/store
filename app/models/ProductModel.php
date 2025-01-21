<?php
namespace app\models;
use app\core\Database;
use app\models\ModelSetup;

class ProductModel extends Database{
    use ModelSetup;
    public function get_all_home($key = 'id', $method = 'DESC'){
        $sql = "SELECT pro.id, pro.name, pro.cate_id, ";
        $sql .= "pro.price, pro.discount_percent, pro.sell, ";
        $sql .= "(SELECT pro_img.url_image FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS url_image ";
        $sql .= "FROM products pro ";
        $sql .= "WHERE 1 ";
        $sql .= "AND pro.status = 0 ";
        $sql .= "ORDER BY pro.{$key} {$method} ";
        $sql .= "LIMIT 10 ";
        return $this->getAll($sql);
    }

    public function get_one_pro_by_id(){
        $sql = "SELECT pro.id as id, pro.name as name, pro.cate_id as cate_id, ";
        $sql .= "pro.price as price, pro.discount_percent as discount_percent, ";
        $sql .= "pro.sell as sell, pro.description as description, ";
        $sql .= "(SELECT pro_img.url_image FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS url_image ";
        $sql .= "FROM products pro ";
        $sql .= "WHERE pro.id = ? ";
        $sql .= "AND pro.status = 0 ";
        return $this->getOne($sql, [$this->__get('id')]);
    }

    public function get_pro_relate_by_cate_id() {
        $sql = "SELECT pro.id, pro.name, pro.cate_id, ";
        $sql .= "pro.price, pro.discount_percent, pro.sell, ";
        $sql .= "(SELECT pro_img.url_image FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS url_image ";
        $sql .= "FROM products pro ";
        $sql .= "WHERE pro.cate_id = ? ";
        $sql .= "AND pro.status = 0 ";
        $sql .= "AND pro.id != ? ";
        $sql .= "ORDER BY pro.id DESC ";
        $sql .= "LIMIT 6";
        return $this->getAll($sql, [$this->__get('cate_id'), $this->__get('id')]);
    }
    public function count_all_pro_by_cate_id() {
        $cate_id = $this->__get('cate_id');
        $query = [$this->__get('parent_id')];
        
        $sql = "SELECT count(pro.id) as total_pro ";
        $sql .= "FROM products pro "; 
        $sql .= "LEFT JOIN categories cate ON pro.cate_id = cate.id ";
        $sql .= "WHERE cate.parent = ? ";
        if(!empty($cate_id)){
            $sql .= "AND pro.cate_id = ? ";
            $query[] = $cate_id;
        }
        $sql .= "AND pro.status = 0 ";
        if(!empty($this->__get('filter'))) {
            $sql .=  implode(' ', $this->__get('filter'), );
        }
        return $this->getOne($sql, $query);
    }
    public function get_all_pro_by_cate_id() {
        $item_page = $this->__get('item_page');
        $offset = ($this->__get('current_page') - 1) * $item_page;
        $cate_id = $this->__get('cate_id');
        $query = [$this->__get('parent_id')];

        $sql = "SELECT pro.id, pro.name, pro.cate_id, ";
        $sql .= "pro.price, pro.discount_percent, pro.sell, ";
        $sql .= "(SELECT pro_img.url_image FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS url_image ";
        $sql .= "FROM products pro "; 
        $sql .= "LEFT JOIN categories cate ON pro.cate_id = cate.id ";
        $sql .= "WHERE cate.parent = ? ";
        if(!empty($cate_id)){
            $sql .= "AND pro.cate_id = ? ";
            $query[] = $cate_id;
        }
        $sql .= "AND pro.status = 0 ";
        if(!empty($this->__get('filter'))) {
            $sql .=  implode(' ', $this->__get('filter'), );
        }
        if($this->__get('total_page') > 1) {
            $sql .= "LIMIT ".$item_page." ";
            if($offset >= 0) {
                $sql .= " OFFSET ". $offset ;
            }
        }
        return $this->getAll($sql, $query);
    }

    public function get_all_pro_by_keyword() {
        $item_page = $this->__get('item_page');
        $offset = ($this->__get('current_page') - 1) * $item_page;
        $keyword = '%'.$this->__get('keyword').'%';
        $sql = "SELECT pro.id, pro.name, pro.cate_id, ";
        $sql .= "pro.price, pro.discount_percent, pro.sell, ";
        $sql .= "(SELECT pro_img.url_image FROM pro_images pro_img WHERE pro_img.pro_id = pro.id LIMIT 1) AS url_image ";
        $sql .= "FROM products pro "; 
        $sql .= "WHERE pro.name like ? ";
        $sql .= "AND pro.status = 0 ";
        if(!empty($this->__get('filter'))) {
            $sql .=  implode(' ', $this->__get('filter'), );
        }
        if($this->__get('total_page') > 1) {
            $sql .= "LIMIT ".$item_page." ";
            if($offset >= 0) {
                $sql .= " OFFSET ". $offset ;
            }
        }
        echo $sql;
        echo $keyword;
        return $this->getAll($sql, [$keyword]);
    }

    public function count_all_pro_by_keyword() {
        $keyword = '%'.$this->__get('keyword').'%';
        $sql = "SELECT count(pro.id) as total_pro ";
        $sql .= "FROM products pro "; 
        $sql .= "WHERE pro.name like ? ";
        $sql .= "AND pro.status = 0 ";
        if(!empty($this->__get('filter'))) {
            $sql .=  implode(' ', $this->__get('filter'), );
        }
        return $this->getOne($sql, [$keyword]);
    }
}