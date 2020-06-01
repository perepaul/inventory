require('./bootstrap');

const sound_success = document.getElementById('sound-success');
const sound_warning = document.getElementById('sound-warning');
const sound_error = document.getElementById('sound-error');
const sound_beep = document.getElementById('sound-beep');

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
        case 'warning':
            iziToast.warning({
                icon: 'fas fa-danger',
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
$(document).on('change', '.input-text', function () {

    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    if (!isNaN(valueCurrent)) {
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus']").removeAttr('disabled')
        } else {
            notify('Min product quantity reached or exceeded', 'warning');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus']").removeAttr('disabled')
        } else {
            notify('Max product quantity reached or exceeded', 'warning');
            $(this).val($(this).data('oldValue'));
        }
    } else {
        notify('Only numbers are allowed', 'error');

        $(this).val($(this).data('oldValue'));
    }


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
