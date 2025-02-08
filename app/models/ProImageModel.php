<?php
namespace app\models;
use app\core\Database;
use app\models\ModelSetup;

class ProImageModel extends Database{
    use ModelSetup;
    
    public function get_all_img_by_pro_id() {
        $sql = "SELECT pro_img.id ,pro_img.url_image FROM pro_images pro_img ";
        $sql .= "WHERE 1 ";
        $sql .= "AND pro_img.pro_id = ?";
        return $this->getAll($sql, [$this->__get('pro_id')]);
    }

    //Xử lý bên admin
    public function insert_image_pro() {
        $sql = "INSERT INTO pro_images (pro_id, url_image) VALUES (?,?)";
        return $this->insert($sql, $this->__gets());
    }
    // public function delete_img_pro(pro_image_model $pro_img) {
    //     $sql = "DELETE FROM pro_images WHERE pro_id = ?";
    //     return $this->__db->delete($sql, [$pro_img->get__pro_id()]);
    // }
}