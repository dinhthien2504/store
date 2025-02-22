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
                        <a class="nav-link active text-black" href="<?= _WEB_ROOT_ ?>/user/profile">Tài Khoản Của
                            Tôi</a>
                    </li>
                    <li class="nav-item d-flex align-items-center fs-17">
                        <i class="fas fa-clipboard-list"></i>
                        <a class="nav-link text-black" href="<?= _WEB_ROOT_ ?>/user/purchase">Đơn Mua</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-10 col-md-12 col-12 bg-white py-3 rounded">

            <!-- <div class="container my-3" id="result">
                    <div class="profile-title">
                        <h5>Đổi Mật Khẩu</h5>
                        <p class="border-bottom pb-3">Quản lý mật khẩu để bảo mật tài khoản</p>
                    </div>
                    <div class="container-form m-auto">
                        <form action="<?= $base_url ?>/postChangePass" method="post" class="form"
                            onsubmit="return cf_change()">
                            <?php if (isset($error)) {
                                echo '<p class="text-center text-danger">' . $error . '</p>';
                            } ?>
                            <?php if (isset($_COOKIE['success_message'])) {
                                echo '<p class="text-center text-success">' . $_COOKIE['success_message'] . '</p>';
                                setcookie('success_message', '', time() - 3600);
                            } ?>
                            <?php if (isset($_COOKIE['error_message'])) {
                                echo '<p class="text-center text-danger">' . $_COOKIE['error_message'] . '</p>';
                                setcookie('error_message', '', time() - 3600);
                            } ?>
                            <p class="text-center fs-16" id="message"></p>
                            <div class="form-control-br">
                                <input type="password" name="old_pass" id="password_old" placeholder="">
                                <i class="ri-lock-fill icons"></i>
                                <label for="password_old" class="form-control-label">
                                    Mật khẩu cũ<span>*</span>
                                </label>
                            </div>
                            <div class="form-control-br">
                                <input type="password" name="new_pass" id="password_new" placeholder="">
                                <i class="ri-lock-fill icons"></i>
                                <label for="password_new" class="form-control-label">
                                    Mật khẩu mới<span>*</span>
                                </label>
                            </div>
                            <div class="form-control-br">
                                <input type="password" name="re_new_pass" id="password_new_cf" placeholder="">
                                <i class="ri-lock-fill icons"></i>
                                <label for="password_new_cf" class="form-control-label">
                                    Nhập lại mật khẩu mới<span>*</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check" onclick="showPassChange();"
                                    value="something">
                                <label for="check" class="form-check-label">Hiện mật khẩu</label>
                            </div>
                            <div class="d-flex justify-content-between mt-2 align-items-center">
                                <button type="submit" class="btn-form btn-brand  fw-bold" name="submit_change">Đổi Mật
                                    Khẩu</button>
                                <a href="<?= $base_url ?>/profile/forgotPass" class="cl-brand underline-a fs-6">Quên mật
                                    khẩu?</a>
                            </div>
                        </form>
                    </div>
                    <a href="<?= $base_url ?>/profile">Quay lại</a>
                </div> -->

            <!-- <div class="container my-3" id="result">
                        <div class="profile-title">
                            <h5 class="border-bottom pb-3">Quên Mật Khẩu</h5>
                        </div>
                        <div class="container-form m-auto">
                            <form action="<?= $base_url ?>/postForgotPass" method="POST" class="form">
                                <div class="form-control-br">
                                    <input type="email" name="emailForgot" id="emailForgot" placeholder="" value="<?php if (isset($_SESSION['user'])) {
                                        echo $_SESSION['user']['email'];
                                    } else {
                                        echo '';
                                    } ?>" readonly>
                                    <i class="ri-lock-fill icons"></i>
                                    <label for="emailForgot" class="form-control-label">
                                        Email lấy lại mật khẩu <span>*</span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between mt-2 align-items-center">
                                    <a href="<?= $base_url ?>/profile/changePass" class="cl-brand underline-a fs-6">Đổi mật khẩu
                                        ?</a>
                                    <button type="submit" class="btn-form btn-brand  fw-bold" name="submit_forgotPass">Lấy lại mật khẩu</button>
                                </div>
                            </form>
                        </div>
                        <a href="<?= $base_url ?>/profile">Quay lại</a>
                    </div> -->
            <!--   
                <div class="container my-3" id="result">
                        <div class="profile-title">
                            <h5 class="border-bottom pb-3">Xác Thực Code</h5>
                        </div>
                        <?php if (isset($_COOKIE['error_message'])) {
                            echo '<p class="ml-3 mt-2 text-danger">' . $_COOKIE['error_message'] . '</p>';
                            // Xóa cookie bằng cách đặt thời gian hết hạn trong quá khứ
                            setcookie("error_message", "", time() - 3600, "/");
                        } ?>
                            <?php if (isset($_COOKIE['success_message'])) {
                                echo '<p class="ml-3 mt-2 text-success">' . $_COOKIE['success_message'] . '</p>';
                                // Xóa cookie bằng cách đặt thời gian hết hạn trong quá khứ
                                setcookie("success_message", "", time() - 3600, "/");
                            } ?>
                        <div class="container-form m-auto">
                            <form action="<?= $base_url ?>/postCheckCode" method="post" class="form">
                                <div class="form-control-br">
                                    <input type="text" name="code" required placeholder="">
                                    <i class="ri-lock-fill icons"></i>
                                    <label for="emailForgot" class="form-control-label">
                                        Nhập mã xác thực <span>*</span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between mt-2 align-items-center">
                                    <button type="submit" class="btn-form btn-brand  fw-bold" name="submit_checkCode">Xác nhận</button>
                                </div>
                            </form>
                        </div>
                    </div> -->
            <!-- <div class="container mt-4">
                            <div class="profile-title">
                                <h5 class="border-bottom pb-3">Đơn Hàng Của Bạn</h5>     
                            </div>
                            <?php if (isset($_COOKIE['error_message'])) {
                                echo '<p class="ml-3 mt-2 text-danger">' . $_COOKIE['error_message'] . '</p>';
                                // Xóa cookie bằng cách đặt thời gian hết hạn trong quá khứ
                                setcookie("error_message", "", time() - 3600, "/");
                            } ?>
                            <?php if (isset($_COOKIE['success_message'])) {
                                echo '<p class="ml-3 mt-2 text-success">' . $_COOKIE['success_message'] . '</p>';
                                // Xóa cookie bằng cách đặt thời gian hết hạn trong quá khứ
                                setcookie("success_message", "", time() - 3600, "/");
                            } ?>
                            <div class="position-relative">
                                <div class="row gap-clm overflow-hidden-brand lg-nowrap my-2 horizontal-scroll"
                                    data-scroll="menu-order">
                                    <div
                                        class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-6 d-flex justify-content-center item mt-2 p-0">
                                        <a class="text-btn-a fs-16" href="<?= $base_url ?>/profile/orderCurrent/0">Tất cả
                                    <?= isset($count_0) > 0 ? '<span class="badge bg-danger">' . $count_0['count'] . '</span>' : '' ?>
                                        </a>
                                    </div>
                                    <div
                                        class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-6 d-flex justify-content-center item mt-2 p-0">
                                        <a class="text-btn-a fs-16" href="<?= $base_url ?>/profile/orderCurrent/1">Chờ xác nhận
                                    <?= isset($count_1) > 0 ? '<span class="badge bg-danger">' . $count_1['count'] . '</span>' : '' ?></span></a>
                                    </div>
                                    <div
                                        class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-6 d-flex justify-content-center item mt-2 p-0">
                                        <a class="text-btn-a fs-16" href="<?= $base_url ?>/profile/orderCurrent/2">Đã xác nhận
                                    <?= isset($count_2) > 0 ? '<span class="badge bg-danger">' . $count_2['count'] . '</span>' : '' ?></span></a>
                                    </div>
                                    <div
                                        class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-6 d-flex justify-content-center item mt-2 p-0">
                                        <a class="text-btn-a fs-16" href="<?= $base_url ?>/profile/orderCurrent/3">Trên đường giao
                                    <?= isset($count_3) > 0 ? '<span class="badge bg-danger">' . $count_3['count'] . '</span>' : '' ?></span></a>
                                    </div>
                                    <div
                                        class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-6 d-flex justify-content-center item mt-2 p-0">
                                        <a class="text-btn-a fs-16" href="<?= $base_url ?>/profile/orderCurrent/4">Đã giao
                                    <?= isset($count_4) > 0 ? '<span class="badge bg-danger">' . $count_4['count'] . '</span>' : '' ?></span></a>
                                    </div>
                                    <div
                                        class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-6 d-flex justify-content-center item mt-2 p-0">
                                        <a class="text-btn-a fs-16" href="<?= $base_url ?>/profile/orderCurrent/5">Đã hủy
                                    <?= isset($count_5) > 0 ? '<span class="badge bg-danger">' . $count_5['count'] . '</span>' : '' ?></span></a>
                                    </div>
                                    <button class="scroll-button lg-block left-30" onclick="scrollLeftFunction('menu-order')"><i
                                            class="ri-arrow-left-s-line"></i></button>
                                    <button class="scroll-button lg-block right-30" onclick="scrollRightFunction('menu-order')"><i
                                            class="ri-arrow-right-s-line"></i></button>
                                </div>
                            </div>
                            <div class="row">
                        <?php if (isset($data_orders) && count($data_orders) > 0) { ?>
                            <?php foreach ($data_orders as $item) {
                                extract($item) ?>
                                <?php
                                if ($status == 1) {
                                    $statusCurrent = '<span class="text-primary fw-bold">Chờ xác nhận</span>';
                                } else if ($status == 2) {
                                    $statusCurrent = '<span class="text-info fw-bold">Đã xác nhận</span>';
                                } else if ($status == 3) {
                                    $statusCurrent = '<span class="text-warning fw-bold">Trên đường giao</span>';
                                } else if ($status == 4) {
                                    $statusCurrent = '<span class="text-success fw-bold">Đã giao</span>';
                                } else if ($status == 5) {
                                    $statusCurrent = '<span class="text-danger fw-bold">Đã hủy</span>';
                                }
                                ?>
                                        <div class="col-12 border p-2 mb-3">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <p class="mb-1 fs-18"><strong>Trạng thái: </strong><?= $statusCurrent ?></p>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <p class="text-primary fs-16"><strong class="text-dark">Thời gian:</strong><?= $by_date ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                        <?php
                                        $orderDetail = new orderDetail();
                                        $data_details = $orderDetail->get_orderDetail_by_id_order($status, $id);

                                        foreach ($data_details as $item) { ?>
                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                                        <div class="d-flex align-items-center p-2">
                                                            <img style="width: 80px; height: 80px;"
                                                                src="<?= $base_url ?>/public/img/<?= $item['img'] ?>" alt="<?= $item['title'] ?>"
                                                                class="me-3" />
                                                            <div>
                                                            <p class="mt-2 fs-16">
                                                                <?php
                                                                $maxLength = 15; // Số lượng ký tự bạn muốn hiển thị
                                                                $title = $item['title'];

                                                                // Cắt chuỗi nếu vượt quá độ dài cho phép và thêm "..."
                                                                if (mb_strlen($title) > $maxLength) {
                                                                    $title = mb_substr($title, 0, $maxLength - 3) . '...';
                                                                }
                                                                echo htmlspecialchars($title); // In chuỗi đã xử lý ra trang web
                                                                ?>
                                                                        </p>
                                                                <p class="mb-0 fs-18"><?= number_format($item['price']) ?> VND </p>
                                                                <span class="fw-bold">x <?= $item['quantity'] ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                        <?php } ?>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <p class="mb-0 fs-18"><strong>Tổng thanh toán:</strong> <span
                                                            class="text-danger fw-bold"><?= number_format($total) ?> VND</span></p>
                                                </div>
                                                <div class="col-12 col-md-4 text-end">
                                                    <a href="<?= $base_url ?>/profile/orderDetail/<?= $id ?>"
                                                        class="btn btn-outline-secondary">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                            <?php } ?>
                        <?php } else { ?>
                                    <div class="col-12 text-center">
                                        <p class="fs-20 mt-4 text-danger">Bạn chưa có đơn hàng nào.</p>
                                    </div>
                        <?php } ?>
                            </div>
                        </div> -->

            <!-- <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                <?php foreach ($data_detail_orders as $item) { ?>
                                                <div class="col-sm-12 col-md-4 col-lg-4 text-center">
                                                    <div class="d-flex">
                                                        <img src="<?= $base_url ?>/public/img/<?= $item['img'] ?>"
                                                            style="width: 80px; height: 80px;" class="img-fluid" alt="<?= $item['title'] ?>">
                                                        <div class="ml-3">
                                                            <p class="mt-2 fs-16">
                                                    <?php
                                                    $maxLength = 15; // Số lượng ký tự bạn muốn hiển thị
                                                    $title = $item['title'];

                                                    // Cắt chuỗi nếu vượt quá độ dài cho phép và thêm "..."
                                                    if (mb_strlen($title) > $maxLength) {
                                                        $title = mb_substr($title, 0, $maxLength - 3) . '...';
                                                    }
                                                    echo htmlspecialchars($title); // In chuỗi đã xử lý ra trang web
                                                    ?>
                                                            </p>
                                                            <p class="text-danger"><?= number_format($item['price']) ?> x <?= $item['quantity'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                <?php } ?>
                                        </div>
                                <?php
                                if ($data_orders['status'] == 1) {
                                    $statusCurrent = '<span class="text-primary fw-bold">Chờ xác nhận</span>';
                                } else if ($data_orders['status'] == 2) {
                                    $statusCurrent = '<span class="text-info fw-bold">Đã xác nhận</span>';
                                } else if ($data_orders['status'] == 3) {
                                    $statusCurrent = '<span class="text-warning fw-bold">Trên đường giao</span>';
                                } else if ($data_orders['status'] == 4) {
                                    $statusCurrent = '<span class="text-success fw-bold">Đã giao</span>';
                                } else if ($data_orders['status'] == 5) {
                                    $statusCurrent = '<span class="text-danger fw-bold">Đã hủy</span>';
                                } ?>
                                        <div class="row">
                                            <div class="col-md-6 border">
                                                <form action="<?= $base_url ?>/updateOrder" method="POST">
                                                    <input type="hidden" name="id_order" value="<?= $data_orders['id'] ?>">
                                                    <p class="fs-18 mt-3">Trạng thái đơn hàng: <?= $statusCurrent ?></p>
                                                    <div class="form-group">
                                                        <p class="fs-18 mt-3">Mã đơn hàng: <?= $data_orders['madh'] ?></p>
                                            <?php if ($data_orders['status'] == 1) { ?>
                                                <input type="hidden" name="status" value="5">
                                                            <button type="submit" class="btn btn-danger mt-3" name="submit_update">Hủy
                                                                đơn</button>
                                            <?php } ?>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-6 border ">
                                                <div class="mt-2">
                                                    <p class="fs-18"><strong>Tên khách hàng:</strong> <?= $data_orders['name'] ?></p>
                                                    <p class="fs-18"><strong>Số điện thoại:</strong> <?= $data_orders['phone'] ?></p>
                                                    <p class="fs-18"><strong>Địa chỉ giao hàng:</strong> <?= $data_orders['address'] ?></p>
                                                    <p class="fs-18"><strong>Thời gian:</strong> <?= $data_orders['by_date'] ?></p>
                                                    <p class="fs-18"><strong>Phí vận chuyển:</strong> Miễn phí</p>
                                                    <p class="fs-18"><strong>Thanh toán:</strong> Thanh toán khi nhận hàng</p>
                                                    <p class="fs-18"><strong>Ghi chú:</strong></p>
                                                    <h5 class="text-right text-danger">Tổng Tiền: <?= number_format($data_orders['total']) ?>
                                                        VND</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= $base_url ?>/profile/orderCurrent">Quay lại</a> -->

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="profile-title">
                        <h5 class="fs-3">Hồ Sơ Của Tôi</h5>
                        <p class="border-bottom fs-17">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    </div>
                    <div class="col-lg-8 col-md-12 col-12 order-sm-2 order-md-2 order-lg-1 order-2">
                        <div class="profile-content">
                            <div class="mb-3">
                                <label for="profileEmail" class="form-label fs-17">Email đăng nhập:</label>
                                <input type="text" class="form-control fs-17" id="profileEmail"
                                    value="<?= $_SESSION['user']['email'] ?? ""; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="profileName" class="form-label fs-17">Tên</label>
                                <input type="text" class="form-control fs-17" id="profileName" name="profileName"
                                    value="<?= $_SESSION['user']['name'] ?? ""; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="profilePhone" class="form-label fs-17">Số điện thoại</label>
                                <input type="text" class="form-control fs-17" name="profilePhone"
                                    value="<?= $_SESSION['user']['phone'] ?? ""; ?>" id="profilePhone">
                            </div>
                            <div class="mb-3">
                                <label for="profileAddress" class="form-label fs-17">Địa chỉ</label>
                                <textarea class="form-control fs-17" name="profileAddress"
                                    id="profileAddress"><?= $_SESSION['user']['address'] ?? ""; ?></textarea>
                            </div>
                            <button type="submit" class="custom-btn custom-btn__primary" name="submit_profile">Lưu</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12 order-sm-1 order-md-1 order-lg-2 order-1">
                        <div class="profile text-center">
                            <div class="custom-profile-img__main-right">
                                <?php if ($_SESSION['user']['url_image'] == '') {
                                    echo '<img src="https://m.yodycdn.com/blog/avatar-dep-cho-nam-yody-vn33.jpg">';
                                } else {
                                    echo '<img src="' . $base_url . '/public/img/' . $_SESSION['user']['url_image'] . '" alt="Profile Image">';
                                } ?>
                            </div>
                            <div class=" text-center">
                                <input type="file" id="profile_img" name="profileImage" class="d-none">
                                <label for="profile_img" class="custom-file-label"></label>
                                <label class="text-center my-3 fs-17" for="profile_img">Chọn Ảnh</label>
                                <p class="text-color fs-17">Dụng lượng file tối đa 1 MB<br>Định dạng:.JPEG, .PNG</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>