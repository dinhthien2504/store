<?php 
namespace app\configs;

use app\core\Router as Router;
//User
use app\controllers\Page;
use app\controllers\Product;
use app\controllers\Ajax;
use app\controllers\User;
use app\controllers\Cart;

//Admin
use app\controllers\admin\Dashboard;
use app\controllers\admin\Product as ProductAdmin;
use app\controllers\admin\Category as CategoryAdmin;
class Routes {
    public static function setupRoutes(Router $router): void {
        //Home
        $router->create(path: '/', params: [Page::class, 'index']);
        //Product
        $router->create(path: '/.+-cat{/+d}-cid{/+d}', params: [Product::class, 'list']);
        $router->create(path: '/search', params: [Product::class, 'search']);
        $router->create(path: '/.+-i{/+d}', params: [Product::class, 'detail']);
        
        //Auth 
        $router->create(path: '/handle_login', params: [User::class, 'handle_login']);
        $router->create(path: '/handle_register', params: [User::class, 'handle_register']);
        $router->create(path: '/logout', params: [User::class, 'logout']);
        
        //Cart
        $router->create(path: '/cart', params: [Cart::class, 'cart']);
        $router->create(path: '/save_cart', params: [Cart::class, 'save_cart']);
        $router->create(path: '/handle_del/{/+d}', params: [Cart::class, 'handle_del']);
        $router->create(path: '/handle_cart', params: [Cart::class, 'handle_cart']);
        $router->create(path: '/handle_checkout', params: [Cart::class, 'handle_checkout']);

        // Ajax
        $router->create(path: '/get_size', params: [Ajax::class, 'get_size']);  
        $router->create(path: '/get_quantity', params: [Ajax::class, 'get_quantity']);
        $router->create(path: '/check_email', params: [Ajax::class, 'check_email']);
        $router->create(path: '/update_quantity_cart', params: [Ajax::class, 'update_quantity_cart']);
        $router->create(path: '/get_province', params: [Ajax::class, 'get_province']);
        $router->create(path: '/get_district_province_id', params: [Ajax::class, 'get_district_province_id']);
        $router->create(path: '/get_ward_district_id', params: [Ajax::class, 'get_ward_district_id']);
        $router->create(path: '/update_address', params: [Ajax::class, 'update_address']);
        $router->create(path: '/admin/get_attri_val_by_attri_id', params: [Ajax::class, 'get_attri_val_by_attri_id']);

        //Ajax Admin
        $router->create(path: '/admin/get_cate_chirld_by_parent', params: [Ajax::class, 'get_cate_chirld_by_parent']);
        $router->create(path: '/admin/get_attri_val_select_2', params: [Ajax::class, 'get_attri_val_select_2']);


        //Admin
        $router->create(path: '/admin/', params: [Dashboard::class, 'index']);
        //Admin product
        $router->create(path: '/admin/product', params: [ProductAdmin::class, 'index']);
        $router->create(path: '/admin/add-product', params: [ProductAdmin::class, 'add']);
        $router->create(path: '/admin/product/handle_add', params: [ProductAdmin::class, 'handle_add']);
        $router->create(path: '/admin/edit-product-{/+d}', params: [ProductAdmin::class, 'edit']);
        $router->create(path: '/admin/product/handle_edit', params: [ProductAdmin::class, 'handle_edit']);
        $router->create(path: '/admin/product/handle-del-{/+d}', params: [ProductAdmin::class, 'handle_del']);
        $router->create(path: '/admin/product/handle_del_groups', params: [ProductAdmin::class, 'handle_del_groups']);

        //Admin category
        $router->create(path: '/admin/category', params: [CategoryAdmin::class, 'index']);
        $router->create(path: '/admin/category/handle_add', params: [CategoryAdmin::class, 'handle_add']);
        $router->create(path: '/admin/category/handle-del-{/+d}', params: [CategoryAdmin::class, 'handle_del']);
        $router->create(path: '/admin/category/handle_del_groups', params: [CategoryAdmin::class, 'handle_del_groups']);
    }
}