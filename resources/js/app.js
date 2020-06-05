require('./bootstrap');

$(document).ajaxComplete(function myErrorHandler (event, xhr, ajaxOptions, thrownError) {
    if (xhr.status == 401) {
        window.location.href = "/login";
    }
});

const sound_success = document.getElementById('sound-success');
const sound_warning = document.getElementById('sound-warning');
const sound_error = document.getElementById('sound-error');
const sound_beep = document.getElementById('sound-beep');

var socket = null;
var socket_host = 'ws://127.0.0.1:6441';

initializeSocket = function () {
    try {
        if (socket == null) {
            socket = new WebSocket(socket_host);
            socket.onopen = function () { };
            socket.onmessage = function (msg) { };
            socket.onclose = function () {
                socket = null;
            };
        }
    } catch (e) {
        console.log(e);
    }
};

notify = (message, type, sound = true) => {
    if (sound == true) {
        playsound(type);
    }
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
        case 'warning':
            iziToast.warning({
                icon: 'fas fa-exclamation-triangle',
                message
            });
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
        case 'beep':
            sound_beep.play();
            break;
    }
}

validateUpdate = (elem) => {
    valid = false;
    minValue = parseInt($(elem).attr('min'));
    maxValue = parseInt($(elem).attr('max'));
    valueCurrent = parseInt($(elem).val());

    if (!isNaN(valueCurrent)) {
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus']").removeAttr('disabled')
            valid = true;
        } else {
            notify('Min product quantity reached or exceeded', 'warning');
            $(elem).val($(elem).data('oldValue'));
            valid = false;
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus']").removeAttr('disabled')
            valid = true;
        } else {
            valid = false;
            notify('Max product quantity reached or exceeded', 'warning');
            $(elem).val($(elem).data('oldValue'));
        }
    } else {
        valid = false;
        notify('Only numbers are allowed', 'error');
        $(elem).val($(elem).data('oldValue'));
    }
    return valid;
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

//  MANIPULATION OF CART QUANTITY BUTTON
$(document).on('click', '.btn-number', function (e) {
    e.preventDefault();

    // fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $(this).parent().siblings(".input-text");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type == 'minus') {
            if (currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if (parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if (type == 'plus') {

            if (currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if (parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$(document).on('focusin', '.input-text', function () {
    $(this).data('oldValue', $(this).val());
});






$(document).on('keydown', '.input-text', function (e) {
    return onlyNumbers(e);
});

onlyNumbers = (e) => {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}
