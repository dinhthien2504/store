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
const valid_register = async () => {
    // Kiểm tra name
    const name = $('#name_register');
    if (name.val().trim() === '') {
        name.focus();
        messager({ title: 'Cảnh báo!', mess: 'Vui lòng nhập tên', type: 'error' });
        return false;
    }

    // Kiểm tra email
    const email = $('#email_register');
    const emailVal = email.val().trim();
    if (emailVal === '') {
        email.focus();
        messager({ title: 'Cảnh báo!', mess: 'Vui lòng nhập email!', type: 'error' });
        return false;
    }
    if (!validate_email(emailVal)) {
        email.focus();
        messager({ title: 'Cảnh báo!', mess: 'Email không hợp lệ!', type: 'error' });
        return false;
    }

    const emailExists = await check_exist_email(emailVal);
    if (emailExists) {
        return false;
    }

    // Kiểm tra mật khẩu
    const pwd = $('#pwd_register');
    const pwdVal = pwd.val().trim();
    if (pwdVal === '') {
        pwd.focus();
        messager({ title: 'Cảnh báo!', mess: 'Vui lòng nhập mật khẩu!', type: 'error' });
        return false;
    }
    if (!validate_pwd(pwdVal)) {
        pwd.focus();
        messager({
            title: 'Cảnh báo!',
            mess: 'Mật khẩu phải có ít nhất 8 ký tự, chứa ít nhất một chữ cái viết hoa và một ký tự đặc biệt!',
            type: 'error'
        });
        return false;
    }

    return true;
};

const check_exist_email = (email) => {
    return new Promise((resolve) => {
        $.ajax({
            url: 'check_email',
            type: 'POST',
            data: { email: email },
            success: (data) => {
                if (data) {
                    messager({ title: 'Cảnh báo!', mess: 'Email đã tồn tại!', type: 'error' });
                    resolve(true);
                } else {
                    resolve(false);
                }
            },
            error: () => {
                console.log("Không gửi lên được");
                resolve(false);
            }
        });
    });
};

$('#submit_register').click(async () => {
    const isValid = await valid_register();
    if (isValid) {
        $('#form-register').submit(); // Nếu hợp lệ, gửi form
    }
});
