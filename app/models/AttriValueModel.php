<?php 
namespace app\models;

use app\core\Database;
use app\models\ModelSetup;
class AttriValueModel extends Database{
    use ModelSetup;

    public function get_all_attri_val_by_attri_id() {
        $sql = 'SELECT * FROM attri_values ';
        $sql.= 'WHERE attri_id = ? ';
        $sql.= 'ORDER BY id ASC';
        return $this->getAll($sql, [$this->__get('attri_id')]);
    }
}