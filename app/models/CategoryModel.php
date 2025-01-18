<?php
namespace app\models;
use app\core\Database;
use app\models\ModelSetup;
class CategoryModel extends Database {
    use ModelSetup;

    public function get_all_perent() {
        $sql = "SELECT id, name, url_image ";
        $sql .= "FROM categories ";
        $sql .= "WHERE 1 ";
        $sql .= "AND parent = 0 ";
        $sql .= "AND status = 0";
        return $this->getAll($sql);
    }
}