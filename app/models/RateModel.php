<?php
namespace app\models;

use app\core\Model;
use app\models\ModelSetup;
class RateModel extends Model
{
    use ModelSetup;
    protected $table = 'rates';
    public function insert_rate()
    {
        $data = $this->__gets();
        $columns = implode(',', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $data_insert = array_values($data);
        return $this->save($columns, $placeholders, $data_insert);
    }

    public function get_rate_by_pro_id(): array
    {
        $sql = "SELECT r.rating , r.review_text, u.name as name_user, r.name_variant, r.date_rate, GROUP_CONCAT(r_img.url_image) as url_images ";
        $sql .= "FROM rates r ";
        $sql .= "LEFT JOIN rate_images r_img ON r_img.rate_id = r.id ";
        $sql .= "LEFT JOIN users u ON u.id = r.user_id ";
        $sql .= "WHERE r.pro_id = ? ";
        $sql .= "GROUP BY r.rating ,  r.review_text, r.date_rate ";
        $sql .= "ORDER BY r.id DESC";
        return $this->getAll($sql, [$this->__get('pro_id')]);
    }
    public function get_avg_rate_by_pro_id()
    {
        $sql = "SELECT SUM(rating) AS totalStars, COUNT(*) AS totalReviews ";
        $sql .= "FROM rates WHERE pro_id = ?";
        return $this->getOne($sql, [$this->__get('pro_id')]);
    }
}