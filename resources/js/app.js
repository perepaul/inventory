require('./bootstrap');

notify = (message, type) => {
    switch (type) {
        case 'success':
            iziToast.success({
                icon: 'fa fa-check',
                message,
            })
            break;
        case 'error':
            iziToast.error({
                icon: 'fas fa-times',
                message
            })
            break;

    }
}

handleRoleSelect = (val) => {
    val = typeof (val) !== 'undefined' ? val : $('#role-select').val();
    $('.p-checkbox').attr('checked', false)
    $.ajax({
        method: 'get',
        url: '/get-role-permissions/' + val,
    })
        .then(res => tickCheckbox(res.data), eres => console.log(eres))
}

tickCheckbox = (data) => {
    $('.p-checkbox').each(function (index, elem) {
        data.forEach(item => {
            if (elem.id == item) {
                elem.setAttribute('checked', true);
            }
        });
    })
}

