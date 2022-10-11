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
            complete: function () {
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
            complete: function () {
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
            complete: function () {
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
            complete: function () {
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
            complete: function () {
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
    } else {
        toastr.error('Something went wrong. Please try again');
    }
})

$('.dashboardvalidate').click(function () {
    let userIdentity = $("input[name=user_identity]").val();
    $('.loader').show();
    if (userIdentity != '') {
        redirectToDashboard(userIdentity)
    } else {
        toastr.error('Something went wrong. Please try again');
    }
})

$('.user_img').on('change', function (e) {
    let files = e.target.files;
    if (files.length) {
        let file = files[0];
        let fileName = files[0].name;
        var form_data = new FormData();
        var ext = fileName.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
            toastr.error('Please upload valid file format');
            return false;
        }
        let fsize = file.size || file.fileSize;
        form_data.append("profile_picture", file);
        $('.loader').show();
        $.ajax({
            type: 'post',
            url: `${siteurl}upload_profile_picture`,
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.status) {
                    toastr.success(data.message)
                    location.reload();
                }
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function () {
                $('.loader').hide();
            }
        });
    }
});


$('.resume_upload').on('change', function (e) {
    let files = e.target.files;
    if (files.length) {
        let file = files[0];
        let fileName = files[0].name;
        var form_data = new FormData();
        var ext = fileName.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['doc', 'docx', 'pdf']) == -1) {
            toastr.error('Please upload valid file format');
            return false;
        }
        let fsize = file.size || file.fileSize;
        const fileS = Math.round((fsize / 1024));
        if (fileS > 2048) {
            toastr.error('Maximum allowed file size wil be 2MB');
            return false;
        }
        form_data.append("upload_resume", file);
        $('.loader').show();
        $.ajax({
            type: 'post',
            url: `${siteurl}upload_resume`,
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.status) {
                    toastr.success(data.message)
                    setTimeout(() => {
                        location.reload();
                    }, 1000)
                }
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function () {
                $('.loader').hide();
            }
        });
    }
});

$('.delete_resume').click(function () {
    let dataId = $(this).attr('data-id');
    if (dataId != '') {
        $('.loader').show();
        $.ajax({
            type: 'post',
            url: `${siteurl}delete_resume`,
            data: { dataid: dataId },
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    toastr.success(data.message)
                    setTimeout(() => {
                        location.reload();
                    }, 1000)
                }
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function () {
                $('.loader').hide();
            }
        });
    }
});

$('.edit_headline').click(function () {
    let parent = $(this).closest('.resume-headline');
    let headline = parent.find('.inputinfo').val();
    console.log(headline.length);
    parent.find('.form-buttons').show();
    parent.find('.text_limit').html(headline.length + '/250').show();
    parent.find('.inline_text').addClass('hide');
    parent.find('.inputinfo').removeClass('hide');
})

$("textarea[name=user_resume_headline]").keyup(function () {
    let inputVal = $(this).val();
    $(this).parent().find('.text_limit').html(inputVal.length + '/250');
    console.log($(this).val().length);
});

$('.cancelaction').click(function () {
    let parent = $(this).closest('.resume-headline');
    parent.find('.form-buttons').hide();
    parent.find('.text_limit').hide();
    parent.find('.inline_text').removeClass('hide');
    parent.find('.inputinfo').addClass('hide');
})

$('#update_resume_headline').submit(function (e) {
    e.preventDefault();
    let headline = $("textarea[name=user_resume_headline]").val();
    if (headline != '') {
        $('.loader').show();
        $.ajax({
            type: 'post',
            url: `${siteurl}update_resume_headline`,
            data: { headline: headline },
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    toastr.success(data.message)
                    setTimeout(() => {
                        location.reload();
                    }, 1000)

                }
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function () {
                $('.loader').hide();
            }
        });
    }
});

$('#create_keyskils').submit(function (e) {
    e.preventDefault();
    let keyskils = $("input[name=key_skils]").val();
    if (keyskils != '') {
        $('.loader').show();
        $.ajax({
            type: 'post',
            url: `${siteurl}create_keyskils`,
            data: { keyskils: keyskils },
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    toastr.success(data.message)
                    location.reload();
                }
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function () {
                $('.loader').hide();
            }
        });
    }
});

const removeKeySkil = (skilid) => {
    if (skilid != '') {
        $('.loader').show();
        $.ajax({
            type: 'post',
            url: `${siteurl}delete_keyskils`,
            data: { skilid: skilid },
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    toastr.success(data.message)
                    location.reload();
                }
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function () {
                $('.loader').hide();
            }
        });
    }
}

$('.create_employment').click(function () {
    $.ajax({
        type: 'get',
        url: `${siteurl}getemploymenthtml`,
        data: { type: 'add' },
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                $('.action_employment').html(data.data);
                $('.edit_employment_content').html('');

            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
});

$('.edit_employment').click(function () {
    let employment = $(this).children('img').attr('data-employment');
    let dataId = $(this).children('img').attr('data-id');
    $('.loader').show();
    $.ajax({
        type: 'get',
        url: `${siteurl}getemploymenthtml`,
        data: { type: 'edit', dataid: dataId },
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                $('.action_employment').html('');
                $('.edit_employment_content').html('');
                $('#employment_' + employment).html(data.data);
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
});

$(document).on('click', '.cancel_employment', function (e) {
    let employmentId = $("input[name=user_employment_id]").val();
    if (employmentId == '') {
        $('.action_employment').html('');
    } else {
        $(this).parents('.edit_employment_content').html('');
    }
});

$(document).on('submit', '#action_employment', function (e) {
    e.preventDefault();
    let formValue = $(this).serialize();
    $('.loader').show();
    $.ajax({
        type: 'post',
        url: `${siteurl}action_employment`,
        data: formValue,
        dataType: 'json',
        success: function (data) {
            console.log(data)
            if (data.status) {
                toastr.success(data.message)
                setTimeout(() => {
                    location.reload();
                }, 1000)
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
    console.log(formValue);
});

$(document).on('keyup', '.user_employment_current_companyname', function (e) {
    console.log('llllll')
    let val = $(this).val();
    let current = this;
    if (val != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}getcompany`,
            data: { companyname: val },
            dataType: 'json',
            success: function (data) {
                let html = '';
                if (data.status) {
                    let response = JSON.parse(data.data);

                    if (response.length) {
                        response.forEach(res => {
                            html += '<div>' + res.company_detail_name + '<input type="hidden" value="' + res.company_detail_id + '"></div>'
                        })

                    }
                    console.log(JSON.parse(data.data))
                    // $('.autocomplete-items').html(html).show();
                }
                else toastr.error(data.message);
            },
            error: function (data) {
                toastr.error('Something went wrong. Please try again');
            },
            complete: function () {
                $('.loader').hide();
            }
        });
    }

});


$('.create_education').click(function () {
    $.ajax({
        type: 'get',
        url: `${siteurl}geteducationhtml`,
        data: { type: 'add' },
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                $('.action_education').html(data.data);
                $('.edit_education_content').html('');

            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
});

$('.edit_education').click(function () {
    let education = $(this).attr('data-education');
    let dataId = $(this).attr('data-id');
    $('.loader').show();
    $.ajax({
        type: 'get',
        url: `${siteurl}geteducationhtml`,
        data: { type: 'edit', dataid: dataId },
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                $('.action_education').html('');
                $('.edit_education_content').html('');
                $('#education_' + education).html(data.data);
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
});

$(document).on('submit', '#action_education', function (e) {
    e.preventDefault();
    let formValue = $(this).serialize();
    $('.loader').show();
    $.ajax({
        type: 'post',
        url: `${siteurl}action_education`,
        data: formValue,
        dataType: 'json',
        success: function (data) {
            console.log(data)
            if (data.status) {
                toastr.success(data.message)
                location.reload();
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
    console.log(formValue);
});

$(document).on('click', '.cancel_education', function (e) {
    let educationId = $("input[name=user_education_id]").val();
    if (educationId == '') {
        $('.action_education').html('');
    } else {
        $(this).parents('.edit_education_content').html('');
    }
});

$('.custom_change').change(function (e) {
    $(this).parents('.current-location').find('.form-buttons').show();
});

$(document).on('submit', '#current-location', function (e) {
    e.preventDefault();
    let formValue = $(this).serialize();
    $('.loader').show();
    $.ajax({
        type: 'post',
        url: `${siteurl}actioncurrentlocation`,
        data: formValue,
        dataType: 'json',
        success: function (data) {
            console.log(data)
            if (data.status) {
                toastr.success(data.message)
                location.reload();
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
    console.log(formValue);
});








$('.create_itskill').click(function () {
    $.ajax({
        type: 'get',
        url: `${siteurl}getitskillhtml`,
        data: { type: 'add' },
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                $('.action_itskill').html(data.data);
                $('.edit_itskill_content').html('');

            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
});

$('.edit_itskill').click(function () {
    let itskill = $(this).attr('data-itskill');
    let dataId = $(this).attr('data-id');
    $('.loader').show();
    $.ajax({
        type: 'get',
        url: `${siteurl}getitskillhtml`,
        data: { type: 'edit', dataid: dataId },
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                $('.action_itskill').html('');
                $('.edit_itskill_content').html('');
                $('#itskill_' + itskill).html(data.data);
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
});


$(document).on('submit', '#action_itskill', function (e) {
    e.preventDefault();
    let formValue = $(this).serialize();
    $('.loader').show();
    $.ajax({
        type: 'post',
        url: `${siteurl}action_itskill`,
        data: formValue,
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                toastr.success(data.message)
                location.reload();
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
    console.log(formValue);
});


$(document).on('click', '.cancel_itskill', function (e) {
    let educationId = $("input[name=user_itskil_id]").val();
    if (educationId == '') {
        $('.action_itskill').html('');
    } else {
        $(this).parents('.edit_itskill_content').html('');
    }
});



$('.action_personaldetails').click(function () {
    $('.loader').show();
    $.ajax({
        type: 'get',
        url: `${siteurl}getpersonaldetailhtml`,
        success: function (data) {
            if (data.status) {
                $('.action_personaldetailsdata').html(data.data);
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
});


$(document).on('submit', '#action_personaldetails_data', function (e) {
    e.preventDefault();
    let formValue = $(this).serialize();
    $('.loader').show();
    $.ajax({
        type: 'post',
        url: `${siteurl}action_personaldetails_data`,
        data: formValue,
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                toastr.success(data.message)
                location.reload();
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
    console.log(formValue);
});

$(document).on('click', '.cancel_personaldetails', function (e) {
    $('.action_personaldetailsdata').html('');
});

$(document).on('click', '.new_language', function (e) {
    $.ajax({
        type: 'get',
        url: `${siteurl}newlanguagehtml`,
        success: function (data) {
            if (data.status) {
                $('.new_lan_html').html(data.data);
            }
            else toastr.error(data.message);
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
});
