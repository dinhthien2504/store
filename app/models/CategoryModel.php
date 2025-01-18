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
        $sql = "SELECT id, name ";
        $sql .= "FROM categories ";
        $sql .= "WHERE 1 ";
        $sql .= "AND parent = ? ";
        $sql .= "AND status = 0";
        return $this->getAll($sql, [$this->__get('parent_id')]);
    }
}