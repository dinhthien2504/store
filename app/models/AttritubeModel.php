<?php 
namespace app\models;

use app\core\Database;
use app\models\ModelSetup;
class AttritubeModel extends Database{
    use ModelSetup;
    public function get_all_attri() {
        $sql = 'SELECT * FROM attritubes ';
        $sql .= 'WHERE 1 ';
        $sql .= 'ORDER BY id ASC';
        return $this->getAll($sql);
    }
}