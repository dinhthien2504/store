<section class="container bg-eee">
    <div class="row p-3 gap-clm">
        <div class="col-lg-2 col-md-12 col-12">
            <div class="custom-profile py-3">
                <div class="d-flex align-items-center justify-content-start gap-3">
                    <?php if ($_SESSION['user']['url_image'] == '') {
                        echo '<img class="custom-profile-img__main" src="https://m.yodycdn.com/blog/avatar-dep-cho-nam-yody-vn33.jpg">';
                    } else {
                        echo '<img src="' . $base_url . '/public/img/' . $_SESSION['user']['url_image'] . '" alt="Profile Image">';
                    } ?>
                    <h5 class="mt-2 text-color fs-5 fw-bold"><?= $_SESSION['user']['name'] ?? ""; ?></h5>
                </div>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item d-flex align-items-center fs-17 ">
                        <i class="far fa-user"></i>
                        <a class="nav-link active text-black" href="<?= $base_url ?>/profile">Tài Khoản Của
                            Tôi</a>
                    </li>
                    <li class="nav-item d-flex align-items-center fs-17">
                        <i class="fas fa-clipboard-list"></i>
                        <a class="nav-link text-black" href="<?= _WEB_ROOT_ ?>/user/purchase">Đơn Mua</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-10 col-md-12 col-12 py-3 rounded">
            <!-- Thông tin đơn hàng -->
            <div >
                <!-- header cart -->
                <div class="custom-profile__top-nav my-3">
                    <div class="px-2 py-3 bg-while">
                        <div class="row scroll flex-nowrap">
                            <div class="col-md-2 col-sm-3 col-4">
                                <p class="m-0 text-center no-wrap">Tất cả</p>
                            </div>
                            <div class="col-md-2 col-sm-3 col-4">
                                <p class="m-0 text-center no-wrap">Chờ xác nhận</p>
                            </div>
                            <div class="col-md-2 col-sm-3 col-4">
                                <p class="m-0 text-center no-wrap">Đã xác nhận</p>
                            </div>
                            <div class="col-md-2 col-sm-3 col-4">
                                <p class="m-0 text-center no-wrap">Đang giao hàng</p>
                            </div>
                            <div class="col-md-2 col-sm-3 col-4">
                                <p class="m-0 text-center no-wrap">Đã giao hàng</p>
                            </div>
                            <div class="col-md-2 col-sm-3 col-4">
                                <p class="m-0 text-center no-wrap">Đã hủy</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                // foreach ($data_carts as $cart) :
                //     $cart['variants'] = json_decode("[" . $cart['variants'] . "]", true);
                //     $price_sales = $cart['price'] - ($cart['price'] * $cart['discount_percent'] / 100); 
                ?>
                <!-- item cart -->
                <div class="custom-cart__item my-3 ">
                    <div class="d-flex align-items-center justify-content-between border-bottom">
                        <div class="p-3">
                            <h4 class="m-0">Tên sản phẩm ao-khoac-nu-biggsize-ao-khoac-ni-co-tron-dang-crop-den.jpg</h4>
                        </div>
                        <p class="text-success m-0 me-2 no-wrap">
                            <i class="fas fa-caravan"></i>
                            Đã giao hàng
                        </p>
                    </div>
                    <!-- content -->
                    <?php
                    // if (!empty($cart['variants'])) : 
                    ?>
                    <?php
                    // foreach ($cart['variants'] as $pro_variant) : 
                    ?>
                    <div class="custom-cart__item--content">
                        <div class="row g-0 align-items-center custom-cart__container--handle">
                            <div class="col-xl-1 col-md-2 col-sm-2 col-3">
                                <?php if (!empty($pro_variant['url_image'])): ?>
                                    <img style="width: 80px; height: 80px; object-fit: cover;"
                                        alt="<?= $cart['name_pro'] ?>"
                                        src="<?= _WEB_ROOT_ ?>/public/assets/img/pro/<?= $pro_variant['url_image'] ?>">
                                <?php else: ?>
                                    <img style="width: 80px; height: 80px; object-fit: cover;"
                                        alt="Hình ảnh"
                                        src="<?= _WEB_ROOT_ ?>/public/assets/img/pro/ao-khoac-nu-biggsize-ao-khoac-ni-co-tron-dang-crop-den.jpg">
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-9 col-md-8 col-sm-8 col-6">
                                <p class="m-0 text-black custom-cart__name">Tên sản phẩm ao-khoac-nu-biggsize-ao-khoac-ni-co-tron-dang-crop-den.jpg</p>
                                <div class="d-flex gap-1">
                                    <p class="m-0">Phân loại hàng:</p>
                                    <p class="m-0">Màu Đỏ - M</p>
                                </div>
                                <p class="m-0 text-black custom-cart__name">x1</p>
                            </div>
                            <div class="col-xl-2 col-md-2 col-sm-2 col-3">
                                <div class="text-center">
                                    <del class="fs-6 fw-normal"><?= number_format(120000) ?>
                                    đ</del>
                                    <span class="m-0 custom-text-primary fw-normal">
                                        <?= number_format(1000000) ?> đ
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="custom-cart__hr">
                    <?php
                    // endforeach 
                    ?>
                    <?php
                    // foreach ($cart['variants'] as $pro_variant) : 
                    ?>
                    <div class="custom-cart__item--content">
                        <div class="row g-0 align-items-center custom-cart__container--handle">
                            <div class="col-xl-1 col-md-2 col-sm-2 col-3">
                                <?php if (!empty($pro_variant['url_image'])): ?>
                                    <img style="width: 80px; height: 80px; object-fit: cover;"
                                        alt="<?= $cart['name_pro'] ?>"
                                        src="<?= _WEB_ROOT_ ?>/public/assets/img/pro/<?= $pro_variant['url_image'] ?>">
                                <?php else: ?>
                                    <img style="width: 80px; height: 80px; object-fit: cover;"
                                        alt="Hình ảnh"
                                        src="<?= _WEB_ROOT_ ?>/public/assets/img/pro/ao-khoac-nu-biggsize-ao-khoac-ni-co-tron-dang-crop-den.jpg">
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-9 col-md-8 col-sm-8 col-6">
                                <p class="m-0 text-black custom-cart__name">Tên sản phẩm ao-khoac-nu-biggsize-ao-khoac-ni-co-tron-dang-crop-den.jpg</p>
                                <div class="d-flex gap-1">
                                    <p class="m-0">Phân loại hàng:</p>
                                    <p class="m-0">Màu Đỏ - M</p>
                                </div>
                                <p class="m-0 text-black custom-cart__name">x1</p>
                            </div>
                            <div class="col-xl-2 col-md-2 col-sm-2 col-3">
                                <div class="text-center">
                                    <del class="fs-6 fw-normal"><?= number_format(120000) ?>
                                    đ</del>
                                    <span class="m-0 custom-text-primary fw-normal">
                                        <?= number_format(1000000) ?> đ
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="custom-cart__hr">
                    <?php
                    // endforeach 
                    ?>
                     <div class="custom-profile__btn--footer">
                        <div class="d-flex align-items-center justify-content-between gap-4">
                            <p class="m-0 custom-cart__total">Tổng: 10000000 đ</p>
                            <button type="submit" name="submit_handle__buy" class="custom-btn custom-btn__primary">Mua lại</button>
                        </div>
                    </div>
                    <?php
                    // endif 
                    ?>
                </div>
                <?php
                // endforeach
                ?>
            </div>
        </div>
    </div>
</section>