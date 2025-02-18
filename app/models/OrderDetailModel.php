<?php
namespace app\models;
use app\core\Model;
use app\models\ModelSetup;

class OrderDetailModel extends Model
{
    use ModelSetup;


    public function insert_order_detail()
    {
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
    public function get_order_detail_by_order_id()
    {
        $sql = "SELECT D_o.id, D_o.name_variant, D_o.quantity, D_o.price, p.name, ";
        $sql .= "(SELECT url_image FROM pro_images WHERE pro_id = p.id LIMIT 1) as url_image ";
        $sql .= "FROM order_details D_o ";
        $sql .= "LEFT JOIN products p ON p.id = D_o.pro_id ";
        $sql .= "WHERE order_id = ? ";
        return $this->getAll($sql, [$this->__get('order_id')]);
    }
}