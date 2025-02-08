<?php
namespace app\models;
use app\core\Database;
use app\models\ModelSetup;
class CategoryModel extends Database {
    use ModelSetup;

    public function get_all_parent() {
        $sql = "SELECT id, name, url_image ";
        $sql .= "FROM categories ";
        $sql .= "WHERE 1 ";
        $sql .= "AND parent = 0 ";
        $sql .= "AND status = 0";
        return $this->getAll($sql);
    }

    public function get_all_cate_by_parent_id() {
        $sql = "SELECT id, name, parent ";
        $sql .= "FROM categories ";
        $sql .= "WHERE 1 ";
        $sql .= "AND parent = ? ";
        $sql .= "AND status = 0";
        return $this->getAll($sql, [$this->__get('parent_id')]);
    }

    public function get_one_cate_parent() {
        $sql = "SELECT cate.id as cate_id ,cate.name as chirld_name, cate.parent as parent_id, ";
        $sql .= "(SELECT name FROM categories WHERE id = cate.parent) as parent_name ";
        $sql .= "FROM categories cate ";
        $sql .= "WHERE 1 ";
        $sql .= "AND cate.id = ? ";
        $sql .= "AND cate.status = 0";
        return $this->getOne($sql, [$this->__get('cate_id')]);
    }

    //Xử lý bên admin
    public function get_all_cate_parent_admin() {
        $sql = 'SELECT id, name ';
        $sql .= 'FROM categories ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND parent = 0';
        return $this->getAll($sql);
    }
    public function get_cate_by_cate_id(category_model $cate) {
        $sql = 'SELECT c.parent as parent_id, c.id as chirld_id, c.name as chirld_name, ';
        $sql .= '(SELECT name FROM categories WHERE id = c.parent ) as parent_name ';
        $sql .= 'FROM categories c ';
        $sql .= 'WHERE c.id = ?';
        return $this->__db->getOne($sql, [$cate->get__id()]);
    }
}