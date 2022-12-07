$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('keyup', '.location', function (e) {
    let val = $(this).val();
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    if (val != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}getcity`,
            data: {
                name: val
            },
            dataType: 'json',
            success: function (data) {
                let html = '';
                if (data.status) {
                    let response = JSON.parse(data.data);
                    if (response.length) {
                        response.forEach(res => {
                            html += "<div class='city_click' data-id='" + res.city_name + "'>" + res.city_name + '<input type="hidden" value="' + res.city_id + '"></div>'
                        })
                        currentParent.find('.autocomplete-items').css({
                            'height': '100px',
                            'background': '#fff'
                        }).html(html).show();
                    } else {
                        html += "<div>No options found</div>";
                        currentParent.find('.autocomplete-items').css('height', '42px').html(html).show();
                    }
                    currentParent.find('.autocomplete_id').val('');
                } else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function () {
                $('.loader').hide();
            }
        });
    } else {
        currentParent.find('.autocomplete-items').html('').hide();
        currentParent.find('.autocomplete_id').val('')
    }
});

$(document).on('blur', '.location', function () {
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    currentParent.find('.autocomplete_id').val('');
    setTimeout(() => {
        currentParent.find('.autocomplete-items').hide().html('');
    }, 500);
});

$(document).on('click', '.city_click', function () {
    console.log('Option')
    const inputVal = $(this).find('input').val();
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    currentParent.find('.autocomplete_id').val(inputVal);
    currentParent.find('.autocomplete_actual_id').val($(this).attr('data-id')).removeAttr('required');
    currentParent.find('.autocomplete-items').hide().html('');
});


$('.employment_type').click(function () {
    console.log($(this).val());
    let type = $(this).val();
    // if (!currentUrl.indexOf('?' + field + '=') != -1 && !currentUrl.indexOf('&' + field + '=') != -1) {
    //     console.log('true')
    //     url.searchParams.set('type', type);
    // }

    const url = new URL(window.location);
    url.searchParams.set('type', type);
    window.history.pushState(null, '', url.toString());

    // var searchParams = new URLSearchParams(window.location.search);
    // searchParams.set("type", type);
    // window.history.pushState = searchParams.toString();


    // if (type != '') {
    //     $.ajax({
    //         type: 'post',
    //         url: `${siteurl}resendemailotp`,
    //         data: {
    //             type: type
    //         },
    //         dataType: 'json',
    //         success: function (data) {
    //             if (data.status) toastr.success(data.message);
    //             else toastr.error(data.message);
    //         },
    //         error: function (data) {
    //             toastr.error('Something went wrong. Please try again');
    //         },
    //         complete: function () {
    //             $('.loader').hide();
    //         }
    //     });
    // }
})
