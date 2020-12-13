require('./bootstrap');

$(document).ajaxComplete(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {
    if (xhr.status == 401) {
        window.location.href = "/login";
    }
});

$(document).on('keypress', '.no-input', function(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    return false;
})

const sound_success = document.getElementById('sound-success');
const sound_warning = document.getElementById('sound-warning');
const sound_error = document.getElementById('sound-error');
const sound_beep = document.getElementById('sound-beep');


notify = (message, type, sound = false) => {
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

handleRoleSelect = (url = '') => {
    // val = typeof (val) !== 'undefined' ? val : $('#role-select').val();
    // if(url == ''){
    //     url = '/'
    // }
    $('.p-checkbox').attr('checked', false)
    $.ajax({
            method: 'get',
            url: url,
        })
        .then(res => tickCheckbox(res.data), eres => console.log(eres))
}

tickCheckbox = (data) => {
    $('.p-checkbox').each(function(index, elem) {
        data.forEach(item => {
            if (elem.id == item) {
                elem.setAttribute('checked', true);
            }
        });
    })
}

//  MANIPULATION OF CART QUANTITY BUTTON
$(document).on('click', '.btn-number', function(e) {
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
$(document).on('focusin', '.input-text', function() {
    $(this).data('oldValue', $(this).val());
});






$(document).on('keydown', '.input-text', function(e) {
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

// toggle collapse class

$(document).on('click', '.toggle-handle', function() {
    $(this).toggleClass(() => {
        if ($(this).hasClass('fa-minus')) {
            return 'fa-plus';
        } else {
            return 'fa-minus';
        }
    })
})

drawChart = ctx => {
    return new chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                    label: 'Wholesale',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90, 300, 800, 200]
                },
                {
                    label: 'Retail',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
            ],
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        }
    })
}