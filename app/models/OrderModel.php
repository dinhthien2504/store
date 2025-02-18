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
        $code = "'" . $this->__get('code') . "' ";
        $sql = "SELECT COUNT(*) as total FROM orders WHERE 1 ";
        if ($status > 0) {
            $sql .= "AND status = {$status} ";
        }
        if ($this->__get('code')) {
            $sql .= "AND code_order = {$code} ";
        }
        return $this->getOne($sql);
    }
    public function get_order_by_id()
    {
        $id = $this->__get('id');
        $sql = "SELECT o.id, o.code_order, o.total, o.by_date, o.status, ";
        $sql .= "u.name, u.phone, u.address, u.address_detail ";
        $sql .= "FROM orders o ";
        $sql .= "LEFT JOIN users u ON u.id = o.user_id ";
        $sql .= "WHERE o.id =? ";
        return $this->getOne($sql, [$id]);
    }

    public function update_order_groups()
    {
        $data = $this->__get('groups');
        $status = $this->__get('status');
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        array_unshift($data, $status);
        $sql = "UPDATE orders SET status =? WHERE id IN (" . $placeholders . ")";
        return $this->update($sql, $data);
    }

    public function total_order_by_status()
    {
        $status = $this->__get('status');
        $sql = "SELECT COUNT(*) as total FROM orders WHERE status =?";
        return $this->getOne($sql, [$status]);
    }

    public function get_revenue()
    {
        $sql = "SELECT DATE_FORMAT(by_date, '%Y-%m') AS month, SUM(total) AS monthly_total ";
        $sql .= "FROM orders ";
        $sql .= "WHERE by_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND status = 4 ";
        $sql .= "GROUP BY month ORDER BY month";
        return $this->getAll($sql);
    }
}