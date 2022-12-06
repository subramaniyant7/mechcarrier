$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
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
