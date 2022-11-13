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

// Profile Headline
$('.edit_headline').click(function () {
    let parent = $(this).closest('.resume-headline');
    let headline = parent.find('.inputinfo').val();
    parent.find('.form-buttons').show();
    parent.find('.text_limit').html(headline.length + '/250').show();
    parent.find('.inline_text').addClass('hide');
    parent.find('.inputinfo').removeClass('hide');
    parent.find('.key_hint').css('display', 'block');
})

$("textarea[name=user_resume_headline]").keyup(function () {
    let inputVal = $(this).val();
    $(this).parent().find('.text_limit').html(inputVal.length + '/250');
});

$('.cancelaction').click(function () {
    let parent = $(this).closest('.resume-headline');
    parent.find('.form-buttons').hide();
    parent.find('.text_limit').hide();
    parent.find('.inline_text').removeClass('hide');
    parent.find('.inputinfo').addClass('hide');
    parent.find('.key_hint').css('display', 'none');
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

// Key Skills
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

// Profile Summary
$('.edit_summary').click(function () {
    let parent = $(this).closest('.resume-headline');
    let headline = parent.find('.inputinfo').val();
    parent.find('.form-buttons').show();
    parent.find('.text_limit').html(headline.length + '/1000').show();
    parent.find('.inline_text').addClass('hide');
    parent.find('.inputinfo').removeClass('hide');
    parent.find('.key_hint').css('display', 'block');
})

$("textarea[name=user_profile_summary]").keyup(function () {
    let inputVal = $(this).val();
    $(this).parent().find('.text_limit').html(inputVal.length + '/1000');
});

$('#update_profile_summary').submit(function (e) {
    e.preventDefault();
    let summary = $("textarea[name=user_profile_summary]").val();
    if (summary != '') {
        $('.loader').show();
        $.ajax({
            type: 'post',
            url: `${siteurl}update_profile_summary`,
            data: { summary: summary },
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

// Employment
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
});

$(document).on('keyup', '.user_employment_current_companyname', function (e) {
    let val = $(this).val();
    let current = this;
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    $(this).attr('required', 'required');
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
                            html += "<div class='option_click' data-id='" + res.company_detail_name + "'>" + res.company_detail_name + '<input type="hidden" value="' + res.company_detail_id + '"></div>'
                        })
                        currentParent.find('.autocomplete-items').css({ 'height': '100px', 'background': '#fff' }).html(html).show();
                    } else {
                        html += "<div>No options found</div>";
                        currentParent.find('.autocomplete-items').css('height', '42px').html('').hide();
                    }
                    currentParent.find('.autocomplete_id').val('');
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
    } else {
        currentParent.find('.autocomplete-items').html('').hide();
        currentParent.find('.autocomplete_id').val('')
    }
});

$(document).on('blur', '.user_employment_current_companyname', function () {
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    setTimeout(() => {
        const idVal = currentParent.find('.autocomplete_id').val();
        // if(idVal == '') { currentParent.find('.autocomplete_actual_id').val('').attr('required','required'); }
        currentParent.find('.autocomplete-items').hide().html('');
    }, 500);

});


$(document).on('keyup', '.user_employment_current_designation', function (e) {
    let val = $(this).val();
    let current = this;
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    $(this).attr('required', 'required');
    if (val != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}getdesignation`,
            data: { designaionname: val },
            dataType: 'json',
            success: function (data) {
                let html = '';
                if (data.status) {
                    let response = JSON.parse(data.data);
                    if (response.length) {
                        response.forEach(res => {
                            html += "<div class='option_click' data-id='" + res.designation_name + "'>" + res.designation_name + '<input type="hidden" value="' + res.designation_id + '"></div>'
                        })
                        currentParent.find('.autocomplete-items').css({ 'height': '100px', 'background': '#fff' }).html(html).show();
                    } else {
                        html += "<div>No options found</div>";
                        currentParent.find('.autocomplete-items').css('height', '42px').html('').hide();
                    }
                    currentParent.find('.autocomplete_id').val('');
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
    } else {
        currentParent.find('.autocomplete-items').html('').hide();
        currentParent.find('.autocomplete_id').val('')
    }
});

$(document).on('blur', '.user_employment_current_designation', function () {
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    setTimeout(() => {
        const idVal = currentParent.find('.autocomplete_id').val();
        currentParent.find('.autocomplete-items').hide().html('');
    }, 500);

});


// Education
$(document).on('keyup', '.user_education_specialization', function (e) {
    let educationId = $("select[name='user_education_primary_id']").val();
    let val = $(this).val();
    let current = this;
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    $(this).attr('required', 'required');
    if (val != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}getspecialization`,
            data: { name: val, id: educationId },
            dataType: 'json',
            success: function (data) {
                let html = '';
                if (data.status) {
                    let response = JSON.parse(data.data);
                    if (response.length) {
                        response.forEach(res => {
                            html += "<div class='option_click' data-id='" + res.education_specialization_name + "'>" + res.education_specialization_name + '<input type="hidden" value="' + res.education_specialization_id + '"></div>'
                        })
                        currentParent.find('.autocomplete-items').css({ 'height': '100px', 'background': '#fff' }).html(html).show();
                    } else {
                        html += "<div>No options found</div>";
                        currentParent.find('.autocomplete-items').css('height', '42px').html('').hide();
                    }
                    currentParent.find('.autocomplete_id').val('');
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
    } else {
        currentParent.find('.autocomplete-items').html('').hide();
        currentParent.find('.autocomplete_id').val('')
    }
});

$(document).on('blur', '.user_education_specialization', function () {
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    setTimeout(() => {
        const idVal = currentParent.find('.autocomplete_id').val();
        currentParent.find('.autocomplete-items').hide().html('');
    }, 500);

});

$(document).on('keyup', '.user_education_university', function (e) {
    let educationId = $("select[name='user_education_primary_id']").val();
    let val = $(this).val();
    let current = this;
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    $(this).attr('required', 'required');
    if (val != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}getuniversity`,
            data: { name: val, id: educationId },
            dataType: 'json',
            success: function (data) {
                let html = '';
                if (data.status) {
                    let response = JSON.parse(data.data);
                    if (response.length) {
                        response.forEach(res => {
                            html += "<div class='option_click' data-id='" + res.education_university_name + "'>" + res.education_university_name + '<input type="hidden" value="' + res.education_university_id + '"></div>'
                        })
                        currentParent.find('.autocomplete-items').css({ 'height': '100px', 'background': '#fff' }).html(html).show();
                    } else {
                        html += "<div>No options found</div>";
                        currentParent.find('.autocomplete-items').css('height', '42px').html('').hide();
                    }
                    currentParent.find('.autocomplete_id').val('');
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
    } else {
        currentParent.find('.autocomplete-items').html('').hide();
        currentParent.find('.autocomplete_id').val('')
    }
});

$(document).on('blur', '.user_education_university', function () {
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    setTimeout(() => {
        const idVal = currentParent.find('.autocomplete_id').val();
        currentParent.find('.autocomplete-items').hide().html('');
    }, 500);
});

$(document).on('click', '.option_click', function () {
    const inputVal = $(this).find('input').val();
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    currentParent.find('.autocomplete_id').val(inputVal);
    currentParent.find('.autocomplete_actual_id').val($(this).attr('data-id')).removeAttr('required');
    currentParent.find('.autocomplete-items').hide().html('');
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

$(document).on('change', '.user_education_primary_id', function (e) {
    let educationId = $("input[name='user_education_id']").val();
    let type = educationId == '' ? 'add' : 'edit';
    let payload = { type: type, educationId: $(this).val() };
    let contentClass = 'action_education';
    let emptyClass = 'edit_education_content';
    if (educationId != '') {
        payload.dataid = educationId;
        contentClass = 'edit_education_content';
        emptyClass = 'action_education';
    }
    $.ajax({
        type: 'get',
        url: `${siteurl}geteducationhtml`,
        data: payload,
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                $(`.${contentClass}`).html(data.data);
                $(`.${emptyClass}`).html('');
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
    console.log('value:', $(this).val());
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
});

$(document).on('click', '.cancel_education', function (e) {
    let educationId = $("input[name=user_education_id]").val();
    if (educationId == '') {
        $('.action_education').html('');
    } else {
        $(this).parents('.edit_education_content').html('');
    }
});

$(document).on("change", ".user_education_grade", function(){
    let inputVal = $(this).val();
    $('.showmarks').hide();
    if(inputVal != '' && inputVal < 4){
        $('.showmarks').show();
    }
    console.log('thi', $(this).val());
});

$('.custom_change').change(function (e) {
    $(this).parents('.current-location').find('.form-buttons').show();
});

// Location

$(document).on('keyup', '.user_city', function (e) {
    let val = $(this).val();
    let current = this;
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    $(this).attr('required', 'required');
    if (val != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}getcity`,
            data: { name: val },
            dataType: 'json',
            success: function (data) {
                let html = '';
                if (data.status) {
                    let response = JSON.parse(data.data);
                    if (response.length) {
                        response.forEach(res => {
                            html += "<div class='option_click' data-id='" + res.city_name + "'>" + res.city_name + '<input type="hidden" value="' + res.city_id + '"></div>'
                        })
                        currentParent.find('.autocomplete-items').css({ 'height': '100px', 'background': '#fff' }).html(html).show();
                    } else {
                        html += "<div>No options found</div>";
                        currentParent.find('.autocomplete-items').css('height', '42px').html(html).show();
                    }
                    currentParent.find('.autocomplete_id').val('');
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
    } else {
        currentParent.find('.autocomplete-items').html('').hide();
        currentParent.find('.autocomplete_id').val('')
    }
});

$(document).on('blur', '.user_city', function () {
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    const rootParent = $(this).parents('.current-location');
    setTimeout(() => {
        const idVal = currentParent.find('.autocomplete_id').val();
        currentParent.find('.autocomplete-items').hide().html('');
        if(idVal != '') rootParent.find('.form-buttons').show()
        console.log('id', idVal)
    }, 500);
});


$(document).on('keyup', '.user_preferred_location', function (e) {
    let val = $(this).val();
    let current = this;
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    $(this).attr('required', 'required');
    if (val != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}getcity`,
            data: { name: val },
            dataType: 'json',
            success: function (data) {
                let html = '';
                if (data.status) {
                    let response = JSON.parse(data.data);
                    if (response.length) {
                        response.forEach(res => {
                            html += "<div class='option_click' data-id='" + res.city_name + "'>" + res.city_name + '<input type="hidden" value="' + res.city_id + '"></div>'
                        })
                        currentParent.find('.autocomplete-items').css({ 'height': '100px', 'background': '#fff' }).html(html).show();
                    } else {
                        html += "<div>No options found</div>";
                        currentParent.find('.autocomplete-items').css('height', '42px').html(html).show();
                    }
                    currentParent.find('.autocomplete_id').val('');
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
    } else {
        currentParent.find('.autocomplete-items').html('').hide();
        currentParent.find('.autocomplete_id').val('')
    }
});

$(document).on('blur', '.user_preferred_location', function () {
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    const rootParent = $(this).parents('.current-location');
    setTimeout(() => {
        const idVal = currentParent.find('.autocomplete_id').val();
        currentParent.find('.autocomplete-items').hide().html('');
        if(idVal != '') rootParent.find('.form-buttons').show()
        console.log('id', idVal)
    }, 500);
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
});

// IT Skill
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
});

$(document).on('click', '.cancel_itskill', function (e) {
    let educationId = $("input[name=user_itskil_id]").val();
    if (educationId == '') {
        $('.action_itskill').html('');
    } else {
        $(this).parents('.edit_itskill_content').html('');
    }
});

// Certifications
$('.create_certification').click(function () {
    $.ajax({
        type: 'get',
        url: `${siteurl}getcertificationhtml`,
        data: { type: 'add' },
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                $('.action_certification').html(data.data);
                $('.edit_certification_content').html('');

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

$('.edit_certification').click(function () {
    let certification = $(this).attr('data-certification');
    let dataId = $(this).attr('data-id');
    $('.loader').show();
    $.ajax({
        type: 'get',
        url: `${siteurl}getcertificationhtml`,
        data: { type: 'edit', dataid: dataId },
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                $('.action_certification').html('');
                $('.edit_certification_content').html('');
                $('#certification_' + certification).html(data.data);
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


$(document).on('submit', '#action_certification', function (e) {
    e.preventDefault();
    let formValue = $(this).serialize();
    $('.loader').show();
    $.ajax({
        type: 'post',
        url: `${siteurl}action_certification`,
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
});


$(document).on('click', '.cancel_certification', function (e) {
    let id = $("input[name=user_certification_id]").val();
    if (id == '') {
        $('.action_certification').html('');
    } else {
        $(this).parents('.edit_certification_content').html('');
    }
});

// Personal Details
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
});

$(document).on('click', '.cancel_personaldetails', function (e) {
    $('.action_personaldetailsdata').html('');
});

// Language
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




// Employer


$("textarea[name=employer_address]").keyup(function () {
    let inputVal = $(this).val();
    $(this).parent().find('#current').html(inputVal.length);
});

$("textarea[name=employer_about_company]").keyup(function () {
    let inputVal = $(this).val();
    $(this).parent().find('#current1').html(inputVal.length);
});




$(document).on('keyup', '.employer_location', function (e) {
    let val = $(this).val();
    let current = this;
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    $(this).attr('required', 'required');
    if (val != '') {
        $.ajax({
            type: 'post',
            url: `${siteurl}getcity`,
            data: { name: val },
            dataType: 'json',
            success: function (data) {
                let html = '';
                if (data.status) {
                    let response = JSON.parse(data.data);
                    if (response.length) {
                        response.forEach(res => {
                            html += "<div class='option_click' data-id='" + res.city_name + "'>" + res.city_name + '<input type="hidden" value="' + res.city_id + '"></div>'
                        })
                        currentParent.find('.autocomplete-items').css({ 'height': '100px', 'background': '#fff' }).html(html).show();
                    } else {
                        html += "<div>No options found</div>";
                        currentParent.find('.autocomplete-items').css('height', '42px').html(html).show();
                    }
                    currentParent.find('.autocomplete_id').val('');
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
    } else {
        currentParent.find('.autocomplete-items').html('').hide();
        currentParent.find('.autocomplete_id').val('')
    }
});

$(document).on('blur', '.employer_location', function () {
    const currentParent = $(this).parents('.autocomplete_ui_parent');
    setTimeout(() => {
        currentParent.find('.autocomplete-items').hide().html('');
    }, 500);
});

// Employer Post

$("textarea[name=employer_post_description]").keyup(function () {
    let inputVal = $(this).val();
    $(this).parent().find('#current').html(inputVal.length);
});



$('#employer_post_save').click(function(e){
    // e.preventDefault();
    $("input[name=employer_post_saved]").val(1);
    $("input[name=employer_post_save_publish]").val(2);
    $('#employer_post_submit').click();
});


$('#employer_post_save_publish').click(function(e){
    // e.preventDefault();
    $("input[name=employer_post_saved]").val(2);
    $("input[name=employer_post_save_publish]").val(1);
    $('#employer_post_submit').click();
});
