<?php
namespace app\models;
use app\core\Database;
use app\models\ModelSetup;

class OrderModel extends Database {
    use ModelSetup;

    public function insert_order() {
        $sql = 'INSERT INTO orders(user_id, voucher_id, staff_id, code_order, total) VALUES (?, ?, ?, ?, ?) ';
        return $this->insert($sql, $this->__gets());
    }
}