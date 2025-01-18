<?php 
namespace app\configs;

use app\core\Router as Router;
use app\controllers\Page;
use app\controllers\Product;
use app\controllers\Ajax;
use app\controllers\User;
use app\controllers\Cart;
class Routes {
    public static function setupRoutes(Router $router): void {
        //Home
        $router->create(path: '/', params: [Page::class, 'index']);
        //Product
        $router->create(path: '/.+-cat{/+d}', params: [Product::class, 'list']);
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
    }
}