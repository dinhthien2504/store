
$(".custom-menu > ul > li").click(function (e) {
    // remove active from already active
    $(this).siblings().removeClass("active");
    // add active to clicked
    $(this).toggleClass("active");
    // if has sub menu open it
    $(this).find("ul").slideToggle();
    // close other sub menu if any open
    $(this).siblings().find("ul").slideUp();
    // remove active class of sub menu items
    $(this).siblings().find("ul").find("li").removeClass("active");
});

$(".custom-menu-btn").click(function () {
    $(".custom-sidebar").toggleClass("active");
});

const validate_file = (file) => {
    const maxFileSize = 2 * 1024 * 1024; // 2MB
    const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    // Kiểm tra nếu file rỗng
    if (!file || file.size === 0) {
        messager({ title: 'Lỗi!', mess: 'File không được để trống!', type: 'error' });
        return false;
    }
    // Kiểm tra kích thước file
    if (file.size > maxFileSize) {
        messager({ title: 'Lỗi!', mess: 'File tối đa 2 MB!', type: 'error' });
        return false;
    }

    // Kiểm tra định dạng file
    if (!allowedTypes.includes(file.type)) {
        messager({ title: 'Lỗi!', mess: 'Chỉ chấp nhận các định dạng: JPEG, PNG, PDF!', type: 'error' });
        return false;
    }
    return true;
}