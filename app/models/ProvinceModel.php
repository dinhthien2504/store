<?php 
namespace app\models;
use app\core\Database;
use app\models\ModelSetup;
class ProvinceModel extends Database{
    use ModelSetup;

    public function get_all_province() {
        $sql = "SELECT * FROM provinces";
        return $this->getAll($sql);
    }
}