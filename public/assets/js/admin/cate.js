const valid_add_cate = () => {
    const el_name = document.getElementById('name_cate');
    if (!el_name.value.trim()) {
        messager({title: 'Lỗi!', mess: 'Tên danh mục không được để trống!', type: 'error'});
        return false;
    }
    return true;
    
}