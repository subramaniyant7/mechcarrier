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


$('.search').click(function () {
    let typeVal = $(this).val();
    let name = $(this).attr('name');

    const url = new URL(window.location);


    if($(this).is(':checked') && typeVal != ''){
        console.log('checked')

        url.searchParams.set(name, typeVal);
        window.history.pushState(null, '', url.toString());
        $("input[name='"+name+"']").each(function () {
            if ($(this).val() != typeVal) $(this).prop('checked', false);
        });
        fetchSearchQuery();
    }else{
        url.searchParams.delete(name)
        window.history.pushState(null, '', url.toString());
    }

})

$('.walkin_post').click(function () {
    if($(this).is(":checked")){
        const url = new URL(window.location);
        url.searchParams.set('walkin', 1);
        window.history.pushState(null, '', url.toString());
        fetchSearchQuery();
    }else{
        url.searchParams.delete('walkin')
        window.history.pushState(null, '', url.toString());
    }

})

$(document).on('click', '.show_default_search', function(e){
    $(this).hide()
    $('.advanced_search').hide();
    $('.skillsearch').find('button').show()
    $('.advance_input').val('')
    $('.show_advanced_search').show()
});

$(document).on('click', '.show_advanced_search', function(e){
    $(this).hide()
    $('.advanced_search').show();
    $('.skillsearch').find('button').hide()
    $('.advance_input').val(1)
    $('.show_default_search').show()
});

$(document).on('click', '.searchfilters-list span', function(e){
    let parent = $(this).parents('.searchfilters-list');
    let targetMainElement = parent.find('.rootclass');
    let targetElement = parent.find('.restrictclass');
    if(targetElement.length){
        targetElement.removeClass('restrictclass')
        parent.find('span').html('less')
    }else{
        targetMainElement.addClass('restrictclass')
        parent.find('span').html('more')
    }
})


const fetchSearchQuery = () => {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    console.log('urlSearchParams', params)
    if (Object.keys(params).length) {
        $.ajax({
            type: 'post',
            url: `${siteurl}filterjob`,
            data: params,
            dataType: 'json',
            success: function (data) {
                console.log('data', data)
                if (data.status) $('.job_list').html(data.html);
                else {
                    $('.job_list').html('');
                    toastr.error(data.message);
                }
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

$(document).on('click', '.show_advancedresume_search', function (e) {

   let checkbox = $(this).find('.advance_checkbox');
   if(!checkbox.is(':checked')){
    $(checkbox).attr('checked', true)
    $.ajax({
        type: 'get',
        url: `${siteurl}getadvancedsearchhtml`,
        dataType: 'json',
        success: function (data) {
            console.log('data', data)
            if (data.status) $('.advance_content').html(data.data);
            else {
                $('.advance_content').html('');
                toastr.error(data.message);
            }
        },
        error: function (data) {
            toastr.error('Something went wrong. Please try again');
        },
        complete: function () {
            $('.loader').hide();
        }
    });
   }else{
    $(checkbox).attr('checked', false)
        $('.advance_content').html('');
   }
});


$(document).on('click', '.searchfilter-dflex h4', function (e) {
    window.location = siteurl + 'job_search';
});

$(document).on('click', '.job-card-description span', function (e) {
    let parent = $(this).parents('.job-card-description');
    let rootClass = parent.find('.jobpost_desc');
    let validateClass = parent.find('.searchdescription');
    console.log('click')
    console.log('validateClass', validateClass)
    console.log('validateClass', validateClass.length)
    if (validateClass.length) {
        validateClass.removeClass('searchdescription')
        parent.find('span').html('hide')
    } else {
        rootClass.addClass('searchdescription')
        parent.find('span').html('more')
    }
});
