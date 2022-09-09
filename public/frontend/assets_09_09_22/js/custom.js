$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});

$('.email-registration-form a').click(function () {
    let userIdentity = $("input[name=user_identity]").val();
    $('.loader').show();
    if (userIdentity != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}resendemailotp`,
            data: { userIdentity: userIdentity },
            dataType: 'json',
            success: function (data) {
                if (data.status) toastr.success(data.message);
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function(){
                $('.loader').hide();
            }
        });
    }
})

$('.change_email').submit(function (e) {
    e.preventDefault();
    $('.loader').show();
    let userIdentity = $("input[name=change_user_identity]").val();
    let userEmail = $("input[name=change_user_email]").val();
    if (userIdentity != '' && userEmail != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}updateemail`,
            data: { userIdentity: userIdentity, userEmail: userEmail },
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    toastr.success(data.message);
                    $('#emailchangemodal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 700);
                }
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
                $('#emailchangemodal').modal('hide');
            },
            complete: function(){
                $('.loader').hide();
            }
        });
    }
});


$('.mobile-registration-form a').click(function () {
    let userIdentity = $("input[name=user_identity]").val();
    $('.loader').show();
    if (userIdentity != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}resendmobileotp`,
            data: { userIdentity: userIdentity },
            dataType: 'json',
            success: function (data) {
                if (data.status) toastr.success(data.message);
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function(){
                $('.loader').hide();
            }
        });
    }
})

$('.change_mobile').submit(function (e) {
    e.preventDefault();
    $('.loader').show();
    let userIdentity = $("input[name=change_user_identity]").val();
    let userPhone = $("input[name=change_user_mobile]").val();
    if (userIdentity != '' && userPhone != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}updatemobile`,
            data: { userIdentity: userIdentity, userPhone: userPhone },
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    toastr.success(data.message);
                    $('#mobilechangemodal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 700);
                }
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
                $('#mobilechangemodal').modal('hide');
            },
            complete: function(){
                $('.loader').hide();
            }
        });
    }
});

const redirectToDashboard = (userIdentity) => {
    if (userIdentity != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}redirecttodashboard`,
            data: { userIdentity: userIdentity },
            dataType: 'json',
            success: function (data) {
                if (data.status) window.location.href = data.redirect;
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function(){
                $('.loader').hide();
            }
        });
    }
}

$('.skipmobile').click(function () {
    let userIdentity = $("input[name=user_identity]").val();
    $('.loader').show();
    if (userIdentity != '') {
        redirectToDashboard(userIdentity)
    }else{
        toastr.error('Something went wrong. Please try again');
    }
})

$('.dashboardvalidate').click(function () {
    let userIdentity = $("input[name=user_identity]").val();
    $('.loader').show();
    if (userIdentity != '') {
        redirectToDashboard(userIdentity)
    }else{
        toastr.error('Something went wrong. Please try again');
    }
})


