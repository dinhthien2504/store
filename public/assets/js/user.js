const valid_login = () => {
    //Kiểm tra email
    const email = $('#email_login');
    if (email.val() === '') {
        email.focus();
        messager({ title: 'Cảnh báo!', mess: 'Vui lòng nhập email!', type: 'error' });
        return false;
    }
    if (!validate_email(email.val())) {
        email.focus();
        return false;
    }
    //Kiểm tra mật khẩu
    const pwd = $('#pwd_login');
    if (pwd.val() === '') {
        pwd.focus();
        messager({ title: 'Cảnh báo!', mess: 'Vui lòng nhập mật khẩu!', type: 'error' });
        return false;
    }
    return true;
}

const valid_register = () => {
    //Kiểm tra name
    const name = $('#name_register');
    if (name.val() === '') {
        name.focus();
        messager({ title: 'Cảnh báo!', mess: 'Vui lòng nhập tên', type: 'error' });
        return false;
    }
    //Kiểm tra email
    const email = $('#email_register');
    if (email.val() === '') {
        email.focus();
        messager({ title: 'Cảnh báo!', mess: 'Vui lòng nhập email!', type: 'error' });
        return false;
    }
    if (!validate_email(email.val())) {
        email.focus();
        return false;
    }
    check_exist_email('email_register', (exists) => {
        if (exists) {
            email.focus();
            messager({ title: 'Cảnh báo!', mess: 'Email đã tồn tại!', type: 'error' });
            return false;
        }
        return true;
    });
    //Kiểm tra mật khẩu
    const pwd = $('#pwd_register');
    if (pwd.val() === '') {
        pwd.focus();
        messager({ title: 'Cảnh báo!', mess: 'Vui lòng nhập mật khẩu!', type: 'error' });
        return false;
    }
    if (!validate_pwd(pwd.val())) {
        pwd.focus();
        messager({ title: 'Cảnh báo!', mess: 'Mật khẩu phải có ít nhất 8 ký tự, chứa ít nhất một chữ cái viết hoa và một ký tự đặc biệt!', type: 'error' });
        return false;
    }
    return true;
}
const check_exist_email = (name_check, callback) => {
    $.ajax({
        url: 'check_email',
        type: 'POST',
        data: { email: $(`#${name_check}`).val() },
        success: (data) => {
            callback(data);
        },
        error: () => {
            callback(false);
            console.log($(`#${name_check}`).val());
        }
    });
};