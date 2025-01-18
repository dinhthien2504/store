<?php 
namespace app\models;

use app\core\Database;
use app\models\ModelSetup;

class DistrictModel extends Database {
    use ModelSetup;

    public function get_all_district_by_province_id() {
        $sql = "SELECT * FROM districts WHERE province_id = ?";
        return $this->getAll($sql, [$this->__get('province_id')]);
    }
}