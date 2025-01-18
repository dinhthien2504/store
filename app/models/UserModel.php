<?php 
namespace app\models;
use app\core\Database;
use app\models\ModelSetup;
class UserModel extends Database{
    use ModelSetup;

    public function get_user_login() {
        $sql = 'SELECT * FROM users ';
        $sql .= 'WHERE email = ? ';
        $sql .= 'AND status = 0 ';
        return $this->getOne($sql, [$this->__get('email')]);
    }
    public function insert_register() {
        $sql = 'INSERT INTO users(name, email, password) VALUES (?, ?, ?)';
        return $this->insert($sql, $this->__gets());
    }
    public function update_order_user() {
        $sql = 'UPDATE users SET name = ?,phone = ?, address = ?, address_detail = ? ';
        $sql .= 'WHERE id = ?';
        return $this->update($sql, $this->__gets());
    }
}