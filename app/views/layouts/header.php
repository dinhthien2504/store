<header class="header">
    <div class="grid wide">
        <nav class="header__navbar hide-on-mobile-tablet">
            <ul class="header__navbar-list">
                <li class="header__navbar-item">
                    <span class="header__navbar-title--no-pointer">Kết nối</span>

                    <a href="" class="header__navbar-icon-link">
                        <i class="header__navbar-icon fab fa-facebook"></i>
                    </a>
                    <a href="" class="header__navbar-icon-link">
                        <i class="header__navbar-icon fab fa-instagram"></i>
                    </a>
                </li>
            </ul>
            <ul class="header__navbar-list">
                <li class="header__navbar-item header__navbar-item--has-notify">
                    <a href="" class="header__navbar-item-link">
                        <i class="header__navbar-icon far fa-bell"></i>
                        Thông báo
                    </a>
                    <div class="header__notify">
                        <header class="header__notify-header">
                            <h3>Thông báo mới nhận</h3>
                        </header>
                        <ul class="header__notify-list">
                            <li class="header__notify-item header__notify-item--viewed">
                                <a href="" class="header__notify-link">
                                    <img src="#" alt="" class="header__notify-img" />
                                    <div class="header__notify-info">
                                        <span class="header__notify-name">Mỹ phẩm Ohui chính hãng</span>
                                        <span class="header__notify-description">Mô tả mỹ phẩm Ohui chính hãng</span>
                                    </div>
                                </a>
                            </li>
                            <li class="header__notify-item">
                                <a href="" class="header__notify-link">
                                    <img src="#" alt="" class="header__notify-img" />
                                    <div class="header__notify-info">
                                        <span class="header__notify-name">Xác thực chính hãng nguồn gốc các sản phẩm
                                            Ohui</span>
                                        <span class="header__notify-description">Xác thực chính hãng nguồn gốc các sản phẩm
                                            Ohui</span>
                                    </div>
                                </a>
                            </li>
                            <li class="header__notify-item">
                                <a href="" class="header__notify-link">
                                    <img src="#" alt="" class="header__notify-img" />
                                    <div class="header__notify-info">
                                        <span class="header__notify-name">Sale Sốc bộ dưỡng Ohui The First Tái tạo trẻ hóa da
                                            SALE OFF 70%</span>
                                        <span class="header__notify-description">Siêu sale duy nhất 3 ngày 11-13/12/2019</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="header__notify-footer">
                            <a href="" class="header__notify-footer-btn">Xem tất cả</a>
                        </div>
                    </div>
                </li>
                <li class="header__navbar-item">
                    <a href="" class="header__navbar-item-link">
                        <i class="header__navbar-icon far fa-question-circle"></i>

                        Trợ giúp
                    </a>
                </li>
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="header__navbar-item ">
                        <div class="header__navbar-user">
                            <img src="https://i.pinimg.com/736x/b7/91/44/b79144e03dc4996ce319ff59118caf65.jpg" alt="" class="header__navbar-user-img"/>
                            <span class="header__navbar-user-name"><?= $_SESSION['user']['name'] ?></span>
                            <ul class="header__navbar-user-menu">
                                <li class="header__navbar-user-item">
                                    <a href="">Tài khoản</a>
                                </li>
                                <li class="header__navbar-user-item">
                                    <a href="">Địa chỉ của tôi</a>
                                </li>
                                <li class="header__navbar-user-item">
                                    <a href="">Đơn mua</a>
                                </li>
                                <li class="header__navbar-user-item header__navbar-user-item--separate">
                                    <a href="<?=_WEB_ROOT_?>/logout">Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="header__navbar-item header__navbar-item--strong header__navbar-item--separate" data-bs-toggle="modal" data-bs-target="#myModalRegister">
                        Đăng ký
                    </li>
                    <li class="header__navbar-item header__navbar-item--strong" data-bs-toggle="modal" data-bs-target="#myModalLogin">
                        Đăng Nhập
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Header with Search -->
        <div class="header-with-search">
            <label for="mobile-search-checkbox" class="header__mobile-search">
                <i class="header__mobile-search-icon fas fa-search"></i>
            </label>

            <!-- Header Logo -->
            <div class="header__logo">
                <a href="<?=_WEB_ROOT_?>" class="header__logo-link">
                    <svg viewBox="0 0 192 65" class="header__logo-img">
                        <path fill="#fff"
                            d="M35.6717403 44.953764c-.3333497 2.7510509-2.0003116 4.9543414-4.5823845 6.0575984-1.4379707.6145919-3.36871.9463856-4.896954.8421628-2.3840266-.0911143-4.6237865-.6708937-6.6883352-1.7307424-.7375522-.3788551-1.8370513-1.1352759-2.6813095-1.8437757-.213839-.1790053-.239235-.2937577-.0977428-.4944671.0764015-.1151823.2172535-.3229831.5286218-.7791994.45158-.6616533.5079208-.7446018.5587128-.8221779.14448-.2217688.3792333-.2411091.6107855-.0588804.0243289.0189105.0243289.0189105.0426824.0333083.0379873.0294402.0379873.0294402.1276204.0990653.0907002.0706996.14448.1123887.166248.1287205 2.2265285 1.7438508 4.8196989 2.7495466 7.4376251 2.8501162 3.6423042-.0496401 6.2615109-1.6873341 6.7308041-4.2020035.5160305-2.7675977-1.6565047-5.1582742-5.9070334-6.4908212-1.329344-.4166762-4.6895175-1.7616869-5.3090528-2.1250697-2.9094471-1.7071043-4.2697358-3.9430584-4.0763845-6.7048539.296216-3.8283059 3.8501677-6.6835796 8.340785-6.702705 2.0082079-.004083 4.0121475.4132378 5.937338 1.2244562.6816382.2873109 1.8987274.9496089 2.3189359 1.2633517.2420093.1777159.2898136.384872.1510957.60836-.0774686.12958-.2055158.3350171-.4754821.7632974l-.0029878.0047276c-.3553311.5640922-.3664286.5817134-.447952.7136572-.140852.2144625-.3064598.2344475-.5604202.0732783-2.0600669-1.3839063-4.3437898-2.0801572-6.8554368-2.130442-3.126914.061889-5.4706057 1.9228561-5.6246892 4.4579402-.0409751 2.2896772 1.676352 3.9613243 5.3858811 5.2358503 7.529819 2.4196871 10.4113092 5.25648 9.869029 9.7292478M26.3725216 5.42669372c4.9022893 0 8.8982174 4.65220288 9.0851664 10.47578358H17.2875686c.186949-5.8235807 4.1828771-10.47578358 9.084953-10.47578358m25.370857 11.57065968c0-.6047069-.4870064-1.0948761-1.0875481-1.0948761h-11.77736c-.28896-7.68927544-5.7774923-13.82058185-12.5059489-13.82058185-6.7282432 0-12.2167755 6.13130641-12.5057355 13.82058185l-11.79421958.0002149c-.59136492.0107446-1.06748731.4968309-1.06748731 1.0946612 0 .0285807.00106706.0569465.00320118.0848825H.99995732l1.6812605 37.0613963c.00021341.1031483.00405483.2071562.01173767.3118087.00170729.0236381.003628.0470614.00554871.0704847l.00362801.0782207.00405483.004083c.25545428 2.5789222 2.12707837 4.6560709 4.67201764 4.7519129l.00576212.0055872h37.4122078c.0177132.0002149.0354264.0004298.0531396.0004298.0177132 0 .0354264-.0002149.0531396-.0004298h.0796027l.0017073-.0015043c2.589329-.0706995 4.6867431-2.1768587 4.9082648-4.787585l">
                        </path>
                         <!-- Thêm chữ "Store" -->
                        <text x="55%" y="65%" fill="#fff" font-size="38" text-anchor="middle" dominant-baseline="middle" >
                            Store
                        </text>
                    </svg>
                </a>
            </div>
            <input type="checkbox" hidden id="mobile-search-checkbox" class="header__search-checkbox" />
            <!-- Header Search -->
            <form action="<?=_WEB_ROOT_?>/search" method="GET"
            class="header__search ">
                <div class="header__search-input-wrap">
                    <input type="text" class="header__search-input" name="keyword" value="<?=isset($_GET['keyword']) ? trim($_GET['keyword']) : '';?>" placeholder="Nhập để tìm kiếm sản phẩm" />
                </div>
                <button type="submit" class="header__search-btn">
                    <i class="header__search-btn-icon fas fa-search"></i>
                </button>
            </form>

            <!-- Cart layout -->
            <div class="header__cart--user">
                <?php if (isset($_SESSION['user'])) : ?>
                    <div class="header__navbar-user header__user-wrap">
                    <img src="https://i.pinimg.com/736x/b7/91/44/b79144e03dc4996ce319ff59118caf65.jpg" alt="" class="header__navbar-user-img"/>
                            <ul class="header__navbar-user-menu">
                                <li class="header__navbar-user-item">
                                    <a href="">Tài khoản</a>
                                </li>
                                <li class="header__navbar-user-item">
                                    <a href="">Địa chỉ của tôi</a>
                                </li>
                                <li class="header__navbar-user-item">
                                    <a href="">Đơn mua</a>
                                </li>
                                <li class="header__navbar-user-item header__navbar-user-item--separate">
                                    <a href="<?=_WEB_ROOT_?>/logout">Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                <?php else: ?>
                    <div class="header__user-wrap" data-bs-toggle="modal" data-bs-target="#myModalLogin">
                    <i class="fa-solid fa-user"></i>
                </div>
                <?php endif; ?>
                <div class="header__cart-wrap">
                    <i class="header__cart-icon fas fa-shopping-cart"></i>
                    <span class="header__cart-notice">3</span>
                    <!-- No cart : header__cart-list--no-cart -->
                    <div class="header__cart-list ">
                        <!-- Nocart -->
                        <img src="<?=_WEB_ROOT_?>/assets/img/no-cart.png" alt="No Cart" class="header__cart-no-cart-img" />
                        <span class="header__cart-list-no-cart-msg">
                            Chưa có sản phẩm
                        </span>
                        <!-- Hascart -->
                        <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                        <!-- Cart item -->
                        <ul class="header__cart-list-item">
                            <li class="header__cart-item">
                                <img src="<?=_WEB_ROOT_?>/assets/img/pro/ao-khoac-boxy-ni-2-lop__be.jpg" alt="" class="header__cart-img" />
                                <div class="header__cart-item-info">
                                    <div class="header__cart-item-head">
                                        <h5 class="header__cart-item-name">
                                            Set dĩa nhôm 7075 39T cho Raider FI dĩa nhôm 7075 39T cho Raider FI
                                            dĩa nhôm 7075 39T cho Raider FI
                                        </h5>
                                        <div class="header__cart-item-price-wrap">
                                            <span class="header__cart-item-price">2.000.000đ</span>
                                            <span class="header__cart-item-multiply">x</span>
                                            <span class="header__cart-item-qnt">2</span>
                                        </div>
                                    </div>
                                    <div class="header__cart-item-body">
                                        <span class="header__cart-item-description">Phân loại : Bạc</span>
                                        <span class="header__cart-item-remove">Xóa</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <a href="<?=_WEB_ROOT_?>/cart" class="header__cart-view-cart custom-btn custom-btn__primary">Xem giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <ul class="header__sort-bar">
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Liên Quan</a>
        </li>
        <li class="header__sort-item header__sort-item--active">
            <a href="" class="header__sort-link">Mới Nhất</a>
        </li>
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Bán chạy</a>
        </li>
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Giá</a>
        </li>
    </ul> -->
</header>

<!-- The Modal Login -->
<div class="modal" id="myModalLogin">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="custom-form__account" action="<?=_WEB_ROOT_?>/handle_login" method="POST" onsubmit="return valid_login()">
                <div class="text-center">
                    <h3 class="fs-2 fw-normal">Đăng Nhập</h3>
                </div>
                <div class="flex-column">
                    <label>Email </label>
                </div>
                <div class="inputForm">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        viewBox="0 0 32 32"
                        height="20">
                        <g data-name="Layer 3" id="Layer_3">
                            <path
                                d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
                        </g>
                    </svg>
                    <input type="text" name="login_email" id="email_login" placeholder="Nhập email" class="input" />
                </div>

                <div class="flex-column">
                    <label>Mật Khẩu </label>
                </div>
                <div class="inputForm">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        viewBox="-64 0 512 512"
                        height="20">
                        <path
                            d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path>
                        <path
                            d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
                    </svg> 
                    <input type="password" name="login_pwd" id="pwd_login" placeholder="Nhập mật khẩu" class="input" />
                </div>
                <div class="flex-row">
                    <span class="span">Quên mật khẩu?</span>
                </div>
                <button type="submit" name="submit__login" class="button-submit">Đăng Nhập</button>
                <p class="p">Bạn chưa có tài khoản? <span class="span" data-bs-toggle="modal" data-bs-target="#myModalRegister">Đăng ký</span></p>
                <p class="p line">Hoặc</p>

                <div class="flex-row">
                    <button class="btn google">
                        <svg
                            xml:space="preserve"
                            style="enable-background:new 0 0 512 512;"
                            viewBox="0 0 512 512"
                            y="0px"
                            x="0px"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns="http://www.w3.org/2000/svg"
                            id="Layer_1"
                            width="20"
                            version="1.1">
                            <path
                                d="M113.47,309.408L95.648,375.94l-65.139,1.378C11.042,341.211,0,299.9,0,256
	c0-42.451,10.324-82.483,28.624-117.732h0.014l57.992,10.632l25.404,57.644c-5.317,15.501-8.215,32.141-8.215,49.456
	C103.821,274.792,107.225,292.797,113.47,309.408z"
                                style="fill:#FBBB00;"></path>
                            <path
                                d="M507.527,208.176C510.467,223.662,512,239.655,512,256c0,18.328-1.927,36.206-5.598,53.451
	c-12.462,58.683-45.025,109.925-90.134,146.187l-0.014-0.014l-73.044-3.727l-10.338-64.535
	c29.932-17.554,53.324-45.025,65.646-77.911h-136.89V208.176h138.887L507.527,208.176L507.527,208.176z"
                                style="fill:#518EF8;"></path>
                            <path
                                d="M416.253,455.624l0.014,0.014C372.396,490.901,316.666,512,256,512
	c-97.491,0-182.252-54.491-225.491-134.681l82.961-67.91c21.619,57.698,77.278,98.771,142.53,98.771
	c28.047,0,54.323-7.582,76.87-20.818L416.253,455.624z"
                                style="fill:#28B446;"></path>
                            <path
                                d="M419.404,58.936l-82.933,67.896c-23.335-14.586-50.919-23.012-80.471-23.012
	c-66.729,0-123.429,42.957-143.965,102.724l-83.397-68.276h-0.014C71.23,56.123,157.06,0,256,0
	C318.115,0,375.068,22.126,419.404,58.936z"
                                style="fill:#F14336;"></path>
                        </svg>

                        Google</button>
                    <button class="btn facebook">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            width="20"
                            height="20"
                            fill="#1877F2">
                            <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.099 2.794.143v3.243l-1.917.001c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.324-.593 1.324-1.324V1.325C24 .593 23.407 0 22.675 0z" />
                        </svg>
                        Facebook
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- The Modal Register -->
<div class="modal" id="myModalRegister">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?=_WEB_ROOT_?>/handle_register" onsubmit="return valid_register()"
            class="custom-form__account">
                <div class="text-center">
                    <h3 class="fs-2 fw-normal">Đăng Ký</h3>
                </div>
                <div class="flex-column">
                    <label>Tên </label>
                </div>
                <div class="inputForm">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5z"></path>
                        <path d="M12 14c-4.4 0-8 3.6-8 8h16c0-4.4-3.6-8-8-8z"></path>
                    </svg>
                    <input placeholder="Nhập tên" id="name_register" name="register_name" class="input" type="text" />
                </div>
                <div class="flex-column">
                    <label>Email </label>
                </div>
                <div class="inputForm">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        viewBox="0 0 32 32"
                        height="20">
                        <g data-name="Layer 3" id="Layer_3">
                            <path
                                d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
                        </g>
                    </svg>
                    <input placeholder="Nhập email" id="email_register" name="register_email" class="input" type="text" />
                </div>

                <div class="flex-column">
                    <label>Mật Khẩu </label>
                </div>
                <div class="inputForm">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        viewBox="-64 0 512 512"
                        height="20">
                        <path
                            d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path>
                        <path
                            d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
                    </svg>
                    <input placeholder="Nhập mật khẩu" id="pwd_register" name="register_pwd" class="input" type="password" />
                </div>

                <div class="flex-row">
                    <span class="span">Quên mật khẩu?</span>
                </div>
                <button type="submit" name="submit_register" class="button-submit">Đăng Ký</button>
                <p class="p">Bạn đã có tài khoản? <span class="span" data-bs-toggle="modal" data-bs-target="#myModalLogin">Đăng nhập</span></p>
                <p class="p line">Hoặc</p>

                <div class="flex-row">
                    <button class="btn google">
                        <svg
                            xml:space="preserve"
                            style="enable-background:new 0 0 512 512;"
                            viewBox="0 0 512 512"
                            y="0px"
                            x="0px"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns="http://www.w3.org/2000/svg"
                            id="Layer_1"
                            width="20"
                            version="1.1">
                            <path
                                d="M113.47,309.408L95.648,375.94l-65.139,1.378C11.042,341.211,0,299.9,0,256
	c0-42.451,10.324-82.483,28.624-117.732h0.014l57.992,10.632l25.404,57.644c-5.317,15.501-8.215,32.141-8.215,49.456
	C103.821,274.792,107.225,292.797,113.47,309.408z"
                                style="fill:#FBBB00;"></path>
                            <path
                                d="M507.527,208.176C510.467,223.662,512,239.655,512,256c0,18.328-1.927,36.206-5.598,53.451
	c-12.462,58.683-45.025,109.925-90.134,146.187l-0.014-0.014l-73.044-3.727l-10.338-64.535
	c29.932-17.554,53.324-45.025,65.646-77.911h-136.89V208.176h138.887L507.527,208.176L507.527,208.176z"
                                style="fill:#518EF8;"></path>
                            <path
                                d="M416.253,455.624l0.014,0.014C372.396,490.901,316.666,512,256,512
	c-97.491,0-182.252-54.491-225.491-134.681l82.961-67.91c21.619,57.698,77.278,98.771,142.53,98.771
	c28.047,0,54.323-7.582,76.87-20.818L416.253,455.624z"
                                style="fill:#28B446;"></path>
                            <path
                                d="M419.404,58.936l-82.933,67.896c-23.335-14.586-50.919-23.012-80.471-23.012
	c-66.729,0-123.429,42.957-143.965,102.724l-83.397-68.276h-0.014C71.23,56.123,157.06,0,256,0
	C318.115,0,375.068,22.126,419.404,58.936z"
                                style="fill:#F14336;"></path>
                        </svg>

                        Google</button>
                    <button class="btn facebook">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            width="20"
                            height="20"
                            fill="#1877F2">
                            <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.099 2.794.143v3.243l-1.917.001c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.324-.593 1.324-1.324V1.325C24 .593 23.407 0 22.675 0z" />
                        </svg>
                        Facebook
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>