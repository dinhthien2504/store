<div class="custom-admin__content">
    <div class="custom-content__title">
        <h3>Quản Lý Đơn Hàng</h3>
    </div>
    <div class="custom-content__show p-3">
        <div class="custom-content__show--top">
            <p><?php
            // $total_pro['total'] 
            ?> đơn hàng</p>
            <form method="GET">
                <input type="hidden" name="page" value="1">
                <?php if (isset($_GET['status']) && $_GET['status'] != ''): ?>
                    <input type="hidden" name="status" value="<?= isset($_GET['status']) ? $_GET['status'] : ''; ?>">
                <?php endif ?>
                <input type="text" name="code" value="<?= isset($_GET['code']) ? $_GET['code'] : ''; ?>"
                    placeholder="Tìm kiếm theo mã đơn...">
                <button type="submit">Tìm</button>
            </form>
        </div>
        <form class="w-25 mb-2" method="GET">
            <div class="d-flex align-items-center gap-2">
                <select name="status" class="form-select fs-15">
                    <option <?= (isset($_GET['status']) && $_GET['status'] == 0) ? 'selected' : ''; ?> value="0">Tất cả
                    </option>
                    <option <?= (isset($_GET['status']) && $_GET['status'] == 1) ? 'selected' : ''; ?> value="1">Chờ xác
                        nhận</option>
                    <option <?= (isset($_GET['status']) && $_GET['status'] == 2) ? 'selected' : ''; ?> value="2">Đã xác nhận
                    </option>
                    <option <?= (isset($_GET['status']) && $_GET['status'] == 3) ? 'selected' : ''; ?> value="3">Đang giao
                    </option>
                    <option <?= (isset($_GET['status']) && $_GET['status'] == 4) ? 'selected' : ''; ?> value="4">Đã giao
                    </option>
                    <option <?= (isset($_GET['status']) && $_GET['status'] == 5) ? 'selected' : ''; ?> value="5">Đã hủy
                    </option>
                </select>
                <button type="submit" class="btn btn-primary fs-15">Lọc</button>
            </div>
        </form>
        <form action="<?= _WEB_ROOT_ ?>/admin/product/handle_del_groups" method="POST"
            onsubmit="return confirm('Bạn có chắc muốn xóa danh sách sản phẩm!')">
            <div class="custom-content__show--main">
                <div class="custom-content__show--main--top bg-light">
                    <div class="row ">
                        <div class="col-1">
                            <div class="text-center">
                                <input class="custom-table__check--all " id="check_all" type="checkbox">
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-2">
                                    <p class="m-0 text-center no-drop">Mã Đơn</p>
                                </div>
                                <div class="col-2">
                                    <p class="m-0 text-center">Tên</p>
                                </div>
                                <div class="col-2 p-0">
                                    <p class="m-0 text-center">Ngày Đặt</p>
                                </div>
                                <div class="col-2 p-0">
                                    <p class="m-0 text-center">Tổng</p>
                                </div>
                                <div class="col-2">
                                    <p class="m-0 text-center">Trạng Thái</p>
                                </div>
                                <div class="col-2">
                                    <p class="m-0 text-center">Thao tác</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item pro -->
                <?php foreach ($orders as $order):
                    $role = [
                        '2' => 'Quản trị',
                        '0' => 'Khách hàng'
                    ];
                    ?>
                    <div class="custom-table__item">
                        <div class="row my-4 g-0">
                            <!-- Checkbox Column -->
                            <div class="col-1">
                                <div class="text-center">
                                    <input type="checkbox" value="<?= $order['id'] ?>" name="order_del_groups[]"
                                        class="custom-table__check check-item" type="checkbox">
                                </div>
                            </div>
                            <!-- Product Details -->
                            <div class="col-11">
                                <div class="row g-0">
                                    <div class="col-lg-2 col-3">
                                        <p class="m-0 fs-12 text-center"><?= $order['code_order'] ?></p>
                                    </div>
                                    <div class="col-lg-2 col-3">
                                        <p class="m-0 fs-12 text-center"><?= $order['name'] ?></p>
                                    </div>
                                    <div class="col-lg-2 col-4">
                                        <p class="m-0 fs-12 text-center"><?= $order['by_date'] ?></p>
                                    </div>
                                    <div class="col-lg-2 col-3">
                                        <p class="m-0 text-black fs-12 text-center">
                                            <?= number_format($order['total']) ?> đ
                                        </p>
                                    </div>
                                    <div class="col-lg-2 col-3">
                                        <select onchange="update_status_order(this, '<?= $order['id'] ?>')"
                                            class="form-select form-select-md fs-15">
                                            <option <?= ($order['status'] == 1 ? 'selected' : 'disabled') ?> value="1">Chờ xác
                                                nhận</option>
                                            <option <?= ($order['status'] == 2 ? 'selected' : ($order['status'] == 1 ? '' : 'disabled')) ?> value="2">Đã xác nhận</option>
                                            <option <?= ($order['status'] == 3 ? 'selected' : ($order['status'] == 2 ? '' : 'disabled')) ?> value="3">Đang giao</option>
                                            <option <?= ($order['status'] == 4 ? 'selected' : ($order['status'] == 3 ? '' : 'disabled')) ?> value="4">Đã giao</option>
                                            <option <?= ($order['status'] == 5 ? 'selected' : ($order['status'] == 1 ? '' : 'disabled')) ?> value="5">Đã hủy</option>
                                        </select>

                                    </div>
                                    <div class="col-lg-2 col-2 ">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" onclick="get_user_by_id(this)" data-bs-toggle="modal"
                                                data-bs-target="#myModelEditUser" style="width: 50px;"
                                                data-id="<?= $user['id'] ?>" class="btn btn-outline-warning btn-sm "><i
                                                    class="ph ph-pen"></i></button>
                                            <a href="<?= _WEB_ROOT_ ?>/admin/user/handle_del-<?= $user['id'] ?>"
                                                style="width: 50px;" data-bs-toggle="tooltip" title="Xóa!"
                                                onclick="return confirm('Bạn có chắc muốn xóa thành viên này không!')"
                                                class="btn btn-outline-danger btn-sm "><i class="ph ph-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endforeach ?>
                <ul class="pagination">
                    <?php if (isset($links))
                        echo $links; ?>
                </ul>
                <!-- End item user -->
                <div class="custom-content__button bg-light p-4 mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-center d-flex align-items-center gap-2">
                                <input class="custom-table__check--all check-all" id="check_all" type="checkbox">
                                <label class="fs-17 cursor-pointer" for="check_all">Tất cả</label>
                            </div>
                        </div>
                        <button type="submit" name="submit_del_groups" style="width: 50px;"
                            class="btn btn-outline-danger btn-sm "><i class="ph ph-trash"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Main Content -->
<!-- The Modal -->
<div class="modal" id="showOrderModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thông Tin Đơn Hàng</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Trạng thái: <span class="fw-bold">{{ status[dataOrderById.status] }}</span></p>
                        <div v-for="Dorder in dataDorderByOrderId" class="box-pros d-flex my-3">
                            <img :src="`/img/${Dorder.img}`" alt="lỗi" width="70px" height="70px">
                            <div class="mx-3">
                                <p class="my-0"></p>
                                <p class="my-1 text-danger">{{ (Dorder.priceSale).toLocaleString() }} đ<span> x {{
                                        Dorder.quantity }}</span></p>
                                <p class="my-1 text-danger"><span>{{ Dorder.nameColor }} : {{ Dorder.nameSize
                                        }}</span></p>
                            </div>
                            <hr class="text-black">
                        </div>
                    </div>
                    <div class="col-sm-6 my-3">
                        <p>Khách hàng: <span class="fw-bold">{{ dataOrderById.name }}</span></p>
                        <p>Số điện thoại: <span class="fw-bold">{{ dataOrderById.phone }}</span></p>
                        <p>Địa chỉ giao hàng: <span class="fw-bold">{{ dataOrderById.address }}</span>
                        </p>
                        <p>Thời gian: <span class="fw-bold">{{ dataOrderById.by_date }}</span></p>
                        <p>Phí vận chuyển: <span class="fw-bold">Miễn ship</span></p>
                        <p>Thanh toán: <span class="fw-bold">Thanh toán khi nhận hàng</span></p>
                        <p>Ghi chú: <span class="fw-bold">{{ dataOrderById.note }}</span></p>
                        <p>Tổng tiền: <span class="text-danger fw-bold">{{ (dataOrderById.total) }} đ</span></p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>