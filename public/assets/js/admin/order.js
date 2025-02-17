const update_status_order = (select, id) => {
    const newStatus = parseInt(select.value);

    if (confirm("Bạn có chắc muốn thay đổi trạng thái đơn hàng?")) {
        // Disable trạng thái trước đó
        const previousOption = select.querySelector(`option[value="${newStatus - 1}"]`);
        if (previousOption) previousOption.disabled = true;

        // Bật trạng thái tiếp theo nếu có (trừ khi nó là 5)
        const nextOption = select.querySelector(`option[value="${newStatus + 1}"]`);
        if (nextOption && nextOption.value != 5) {
            nextOption.disabled = false;
        }

        // Nếu trạng thái là 5, disable tất cả các option khác
        if (newStatus === 5) {
            select.querySelectorAll("option").forEach((option) => {
                if (option.value != 5) option.disabled = true;
            });
        }
        update_status_order_server(newStatus, id);
    } else {
        select.value = newStatus - 1; // Quay lại trạng thái cũ nếu hủy
        return;
    }
};

const update_status_order_server = (status, id) => {
    $.ajax({
        url: `update_status_order`,
        type: 'POST',
        data: {
            id: id,
            status: status
        },
        success: (data) => {
            //Thay đổi thành công
            if (data) {
                window.location.reload();
            }
        },
        error: () => {
            console.log("Đã có lỗi xảy ra!");
        }
    })
}
