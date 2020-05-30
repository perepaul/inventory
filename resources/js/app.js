require('./bootstrap');

const sound_success = document.getElementById('sound-success');
const sound_warning = document.getElementById('sound-warning');
const sound_error = document.getElementById('sound-error');

notify = (message, type) => {
    playsound(type);
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

playsound = (type) => {
    switch (type) {
        case 'success':
            sound_success.play();
            break;
        case 'warning':
            sound_warning.play();
            break;
        case 'error':
            sound_error.play();
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

