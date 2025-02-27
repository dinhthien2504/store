DELIMITER $$
CREATE TRIGGER `trg_ud_quantity_Dsizes` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
    IF NEW.status = 0 AND OLD.status <> 0 THEN
        UPDATE size_details Dsizes
        JOIN orderdetails Dod ON Dsizes.product_id = Dod.product_id
        SET Dsizes.quantity = Dsizes.quantity + Dod.quantity
        WHERE Dod.order_id = NEW.id
        AND Dod.size = Dsizes.size_id;
    END IF;
END
$$
DELIMITER ;
-- Sau khi insert dữ liệu vào bảnh order_detials thì cập nhật số lượng bên bảng Pvariants
DELIMITER $$  
CREATE TRIGGER `after_insert_Dorder`  
AFTER INSERT ON `order_details`  
FOR EACH ROW  
BEGIN  
    UPDATE pro_variants  
    SET quantity = quantity - NEW.quantity,  
        reserved_quantity = reserved_quantity + NEW.quantity  
    WHERE id = NEW.pro_variant_id;  
END $$  
DELIMITER ;

--Sau khi update đơn hàng có status = 4 thì cập nhật số lượt bán cho products và pro_variants 
DELIMITER $$  
CREATE TRIGGER `after_update_order_success`  
AFTER UPDATE ON `orders`  
FOR EACH ROW  
BEGIN  
    -- Nếu đơn hàng bị hủy (status = 5), cộng lại số lượng tồn kho  
    IF NEW.status = 5 THEN  
        UPDATE pro_variants pv  
        JOIN order_details od ON od.pro_variant_id = pv.id  
        SET pv.quantity = pv.quantity + od.quantity,  
            pv.reserved_quantity = pv.reserved_quantity - od.quantity  
        WHERE od.order_id = NEW.id;  

    -- Nếu đơn hàng thành công (status = 4), cập nhật lượt bán  
    ELSEIF NEW.status = 4 AND OLD.status < 4 THEN  
        -- Cập nhật số lượng đã bán cho bảng pro_variants  
        UPDATE pro_variants pv  
        JOIN order_details od ON od.pro_variant_id = pv.id  
        SET pv.sell = pv.sell + od.quantity,  
            pv.reserved_quantity = pv.reserved_quantity - od.quantity  
        WHERE od.order_id = NEW.id;  

        -- Cập nhật số lượng đã bán cho bảng products  
        UPDATE products p  
        JOIN (  
            SELECT pv.pro_id, SUM(od.quantity) AS total_sold  
            FROM pro_variants pv  
            JOIN order_details od ON od.pro_variant_id = pv.id  
            WHERE od.order_id = NEW.id  
            GROUP BY pv.pro_id  
        ) AS sold_data ON sold_data.pro_id = p.id  
        SET p.sell = p.sell + sold_data.total_sold;  
    END IF;  
END $$  
DELIMITER ;


--Câp nhật lại trạng thái đơn hàng là hoàn thành sau 7 ngày nếu người dùng không xác nhận đã nhận được hàng
DELIMITER $$

CREATE TRIGGER update_payment_after_7_days
AFTER UPDATE ON orders
FOR EACH ROW
BEGIN
    -- Kiểm tra nếu đơn hàng đã giao nhưng chưa thanh toán và đã quá 7 ngày
    IF NEW.status = 4 AND NEW.delivery_date <= NOW() - INTERVAL 7 DAY THEN
        -- Cập nhật trạng thái thanh toán
        UPDATE payments 
        SET status = 'Đã thanh toán'
        WHERE order_id = NEW.id AND status = 'Chưa thanh toán';

        -- Cập nhật trạng thái đơn hàng thành "Hoàn thành"
        UPDATE orders 
        SET status = 6 
        WHERE id = NEW.id;
    END IF;
END $$

DELIMITER ;


