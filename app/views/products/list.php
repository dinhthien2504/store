<div class="grid wide">
    <div class="row g-1 my-2">
        <div class="col-xxl-2 col-md-3 col-sm-4 col-0">
            <div class="category">
                <h3 class="category__heading"><i class="fas fa-list-ul me-2"></i>Tất Cả Danh mục</h3>
                <!-- category-item--active -->
                <ul class="category-list">
                    <?php if (!empty($cate_by_parent_id)): ?>
                        <?php foreach ($cate_by_parent_id as $cate): ?>
                            <li class="category-item ">
                                <a href="#" class="category-item__link"><?= $cate['name'] ?></a>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
            <div class="category">
                <h3 class="category__heading"><i class="fas fa-filter me-2"></i>Bộ Lọc Tìm Kiếm</h3>
                <div class="p-4">
                    <h5 class="mb-4">Khoảng Giá</h5>
                    <form>
                        <div class="row g-2 align-items-center mb-3">
                            <div class="col category-filter__price">
                                <input type="number" placeholder="Từ">
                            </div>
                            <div class="col-auto category-filter__price">
                                <span>-</span>
                            </div>
                            <div class="col category-filter__price">
                                <input type="number" placeholder="Đến">
                            </div>
                        </div>
                        <!-- Nút áp dụng -->
                        <button type="submit" class="custom-btn__primary w-100">ÁP DỤNG</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xxl-10 col-md-9 col-sm-8 col-12">
            <div class="category-filter ">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-2 col-4">
                        <span class="category-filter__lable">
                            <i class="fas fa-filter"></i>
                            Sắp xếp
                        </span>
                    </div>
                    <div class="col-lg-2 col-4">
                        <button class="category-filter__btn">
                            Mới nhất
                        </button>
                    </div>
                    <div class="col-lg-2 col-4">
                        <button class="category-filter__btn">
                            Bán chạy
                        </button>
                    </div>
                    <div class="col-lg-4 col-8">
                        <div class="select-input">
                            <span class="select-input__lable">Giá</span>
                            <i class="select-input__icon fa-solid fa-angle-down"></i>
                            <ul class="select-input__list">
                                <li class="select-input__item">
                                    <a href="#" class="select-input__link">Giá: Thấp đến cao</a>
                                </li>
                                <li class="select-input__item">
                                    <a href="#" class="select-input__link">Giá: Cao đến thấp</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-4">
                        <div class="category-filter__page">
                            <span class="category-filter__page-num">
                                <span class="category-filter__page-current">1</span>/14
                            </span>
                            <div class="category-filter__page-control">
                                <a href="#" class="category-filter__page-btn category-filter__page-btn--disable"><i
                                        class="category-filter__page-icon fa-solid fa-chevron-left"></i></a>
                                <a href="#" class="category-filter__page-btn"><i
                                        class="category-filter__page-icon fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="row g-2">
                    <div class="custom-col-lg-2-5 col-md-3 col-sm-4 col-6">
                        <a class="custom-pro__item">
                            <div class="custom-pro__item__img"
                                style="background-image: url(<?= _WEB_ROOT_ ?>/assets/img/pro/ao-khoac-be-mau-sac-tuong-phan-thoi-xuan-den.jpg);">
                            </div>
                            <h4 class="custom-pro__item__name">Aokong Đồng phục bóng chày Mỹ nam dáng rộng côn đồ đẹp trai đường phố cao cấp thường ngày áo khoác đại học gió chữ hàng đầu</h4>
                            <div class="custom-pro__item__price">
                                <span class="custom-pro__item__price-old">100.000 đ</span>
                                <span class="custom-pro__item__price-current">200.0000đ</span>
                            </div>
                            <div class="custom-pro__item__action">
                                <div class="custom-pro__item__rating">
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="custom-pro__item__sold">1 Đã bán</div>
                            </div>
                            <div class="custom-pro__item__origin">
                                <span class="custom-pro__item__origin-name">Việt Nam</span>
                            </div>

                            <div class="custom-pro__item__sale-off">
                                <span class="custom-pro__item__sale-off-percent">5%</span>
                                <span class="custom-pro__item__sale-off-label">GIẢM</span>
                            </div>

                        </a>
                    </div>
                    <div class="custom-col-lg-2-5 col-md-3 col-sm-4 col-6">
                        <a class="custom-pro__item">
                            <div class="custom-pro__item__img"
                                style="background-image: url(<?= _WEB_ROOT_ ?>/assets/img/pro/ao-khoac-be-mau-sac-tuong-phan-thoi-xuan-den.jpg);">
                            </div>
                            <h4 class="custom-pro__item__name">Aokong Đồng phục bóng chày Mỹ nam dáng rộng côn đồ đẹp trai đường phố cao cấp thường ngày áo khoác đại học gió chữ hàng đầu</h4>
                            <div class="custom-pro__item__price">
                                <span class="custom-pro__item__price-old">100.000 đ</span>
                                <span class="custom-pro__item__price-current">200.0000đ</span>
                            </div>
                            <div class="custom-pro__item__action">
                                <div class="custom-pro__item__rating">
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="custom-pro__item__sold">1 Đã bán</div>
                            </div>
                            <div class="custom-pro__item__origin">
                                <span class="custom-pro__item__origin-name">Việt Nam</span>
                            </div>

                            <div class="custom-pro__item__sale-off">
                                <span class="custom-pro__item__sale-off-percent">5%</span>
                                <span class="custom-pro__item__sale-off-label">GIẢM</span>
                            </div>

                        </a>
                    </div>
                    <div class="custom-col-lg-2-5 col-md-3 col-sm-4 col-6">
                        <a class="custom-pro__item">
                            <div class="custom-pro__item__img"
                                style="background-image: url(<?= _WEB_ROOT_ ?>/assets/img/pro/ao-khoac-be-mau-sac-tuong-phan-thoi-xuan-den.jpg);">
                            </div>
                            <h4 class="custom-pro__item__name">Aokong Đồng phục bóng chày Mỹ nam dáng rộng côn đồ đẹp trai đường phố cao cấp thường ngày áo khoác đại học gió chữ hàng đầu</h4>
                            <div class="custom-pro__item__price">
                                <span class="custom-pro__item__price-old">100.000 đ</span>
                                <span class="custom-pro__item__price-current">200.0000đ</span>
                            </div>
                            <div class="custom-pro__item__action">
                                <div class="custom-pro__item__rating">
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="custom-pro__item__sold">1 Đã bán</div>
                            </div>
                            <div class="custom-pro__item__origin">
                                <span class="custom-pro__item__origin-name">Việt Nam</span>
                            </div>

                            <div class="custom-pro__item__sale-off">
                                <span class="custom-pro__item__sale-off-percent">5%</span>
                                <span class="custom-pro__item__sale-off-label">GIẢM</span>
                            </div>

                        </a>
                    </div>
                    <div class="custom-col-lg-2-5 col-md-3 col-sm-4 col-6">
                        <a class="custom-pro__item">
                            <div class="custom-pro__item__img"
                                style="background-image: url(<?= _WEB_ROOT_ ?>/assets/img/pro/ao-khoac-be-mau-sac-tuong-phan-thoi-xuan-den.jpg);">
                            </div>
                            <h4 class="custom-pro__item__name">Aokong Đồng phục bóng chày Mỹ nam dáng rộng côn đồ đẹp trai đường phố cao cấp thường ngày áo khoác đại học gió chữ hàng đầu</h4>
                            <div class="custom-pro__item__price">
                                <span class="custom-pro__item__price-old">100.000 đ</span>
                                <span class="custom-pro__item__price-current">200.0000đ</span>
                            </div>
                            <div class="custom-pro__item__action">
                                <div class="custom-pro__item__rating">
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="custom-pro__item__sold">1 Đã bán</div>
                            </div>
                            <div class="custom-pro__item__origin">
                                <span class="custom-pro__item__origin-name">Việt Nam</span>
                            </div>

                            <div class="custom-pro__item__sale-off">
                                <span class="custom-pro__item__sale-off-percent">5%</span>
                                <span class="custom-pro__item__sale-off-label">GIẢM</span>
                            </div>

                        </a>
                    </div>
                    <div class="custom-col-lg-2-5 col-md-3 col-sm-4 col-6">
                        <a class="custom-pro__item">
                            <div class="custom-pro__item__img"
                                style="background-image: url(<?= _WEB_ROOT_ ?>/assets/img/pro/ao-khoac-be-mau-sac-tuong-phan-thoi-xuan-den.jpg);">
                            </div>
                            <h4 class="custom-pro__item__name">Aokong Đồng phục bóng chày Mỹ nam dáng rộng côn đồ đẹp trai đường phố cao cấp thường ngày áo khoác đại học gió chữ hàng đầu</h4>
                            <div class="custom-pro__item__price">
                                <span class="custom-pro__item__price-old">100.000 đ</span>
                                <span class="custom-pro__item__price-current">200.0000đ</span>
                            </div>
                            <div class="custom-pro__item__action">
                                <div class="custom-pro__item__rating">
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="custom-pro__item__sold">1 Đã bán</div>
                            </div>
                            <div class="custom-pro__item__origin">
                                <span class="custom-pro__item__origin-name">Việt Nam</span>
                            </div>

                            <div class="custom-pro__item__sale-off">
                                <span class="custom-pro__item__sale-off-percent">5%</span>
                                <span class="custom-pro__item__sale-off-label">GIẢM</span>
                            </div>

                        </a>
                    </div>
                    <div class="custom-col-lg-2-5 col-md-3 col-sm-4 col-6">
                        <a class="custom-pro__item">
                            <div class="custom-pro__item__img"
                                style="background-image: url(<?= _WEB_ROOT_ ?>/assets/img/pro/ao-khoac-be-mau-sac-tuong-phan-thoi-xuan-den.jpg);">
                            </div>
                            <h4 class="custom-pro__item__name">Aokong Đồng phục bóng chày Mỹ nam dáng rộng côn đồ đẹp trai đường phố cao cấp thường ngày áo khoác đại học gió chữ hàng đầu</h4>
                            <div class="custom-pro__item__price">
                                <span class="custom-pro__item__price-old">100.000 đ</span>
                                <span class="custom-pro__item__price-current">200.0000đ</span>
                            </div>
                            <div class="custom-pro__item__action">
                                <div class="custom-pro__item__rating">
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="custom-pro__item__star--gold fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="custom-pro__item__sold">1 Đã bán</div>
                            </div>
                            <div class="custom-pro__item__origin">
                                <span class="custom-pro__item__origin-name">Việt Nam</span>
                            </div>

                            <div class="custom-pro__item__sale-off">
                                <span class="custom-pro__item__sale-off-percent">5%</span>
                                <span class="custom-pro__item__sale-off-label">GIẢM</span>
                            </div>

                        </a>
                    </div>
                </div>
            </div>
            <ul class="pagination home-product-pagination">
                <li class="pagination-item">
                    <a href="#" class="pagination-item__link"><i
                            class="pagination-item__link-icon fa-solid fa-chevron-left"></i></a>
                </li>
                <li class="pagination-item pagination-item--active">
                    <a href="#" class="pagination-item__link">1</a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="pagination-item__link">2</a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="pagination-item__link">3</a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="pagination-item__link">4</a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="pagination-item__link">5</a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="pagination-item__link">...</a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="pagination-item__link">14</a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="pagination-item__link"><i
                            class="pagination-item__link-icon fa-solid fa-chevron-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>