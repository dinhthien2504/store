<?php
namespace app\models;
use app\core\Model;
use app\models\ModelSetup;

class OrderModel extends Model
{
    use ModelSetup;
    protected $table = 'orders';
    public function insert_order()
    {
        $sql = "INSERT INTO orders(user_id, voucher_id, staff_id, code_order, total) VALUES (?, ?, ?, ?, ?)";
        return $this->insert($sql, $this->__gets());
    }

    //Admin
    public function get_order_admin()
    {
        $item_page = $this->__get('item_page');
        $offset = ($this->__get('current_page') - 1) * $item_page;
        $code = "'" . $this->__get('code') . "' ";
        $status = $this->__get('status');
        $sql = "SELECT o.id, o.code_order, u.name, o.by_date, o.total, o.status ";
        $sql .= "FROM orders o ";
        $sql .= "LEFT JOIN users u ON o.user_id = u.id ";
        $sql .= "WHERE 1 ";
        if ($status > 0) {
            $sql .= "AND o.status = {$status} ";
        }
        if ($this->__get('code')) {
            $sql .= "AND o.code_order = {$code} ";
        }
        $sql .= "ORDER BY o.id DESC ";
        $sql .= "LIMIT {$item_page} OFFSET {$offset}";
        return $this->getAll($sql);
    }

    public function update_order()
    {
        $data = $this->__gets();
        $data_update = array_values($data);
        unset($data['id']);
        $assignments = array_keys($data);
        // array_walk() dùng để thay đổi giá trị từng phần tử trong mảng.
        // &$value có dấu & (tham chiếu), giúp thay đổi giá trị gốc trong $assignments.
        // Mỗi phần tử sẽ được gán lại thành "column =?".
        array_walk($assignments, function (&$value) {
            $value = "$value =?";
        });
        $assignments = implode(',', $assignments);
        return $this->saveUpdate($assignments, $data_update);
    }
    public function total_order_handle_page()
    {
        $status = $this->__get('status');
        $sql = "SELECT COUNT(*) as total FROM orders WHERE 1 ";
        if ($status > 0) {
            $sql .= "AND status = {$status} ";
        }
        return $this->getOne($sql);
    }
}