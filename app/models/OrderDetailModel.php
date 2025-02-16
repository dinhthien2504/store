<?php
namespace app\models;
use app\core\Model;
use app\models\ModelSetup;

class OrderDetailModel extends Model {
    use ModelSetup;

    
    public function insert_order_detail() {
        $order_details = $this->__gets();
        if (empty($order_details)) {
            return false;
        }
        // Tạo placeholders và values từ mảng dữ liệu
        $placeholders = array_fill(0, count($order_details), '(?, ?, ?, ?, ?)');
        $values = array_merge(...$order_details);
        $placeholders_string = implode(', ', $placeholders);
        $sql = "INSERT INTO order_details (pro_id, order_id, name_variant, quantity, price) VALUES $placeholders_string";
        return $this->insert($sql, $values);
    }
    
}