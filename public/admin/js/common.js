let url = window.location.pathname;
let path = "action_company_mapping";


const getCompanyMappingContent = () => {
    let companyAction = $("select[name=company_action]").val();

    if(companyAction != '' ) {
        let option = companyAction == 1 ? 'manual' : 'company';
        let html = '';
        $.get(siteurl + '/get_company_mapping_content?type=' + option, function (data, status) {
            console.log(data);
            if (data.status) {
                $('.selected_show').css({display: 'flex'});
                html = data.view;
            }
            $('.actionhtml').html(html);
        });
    }
}

if (url.indexOf(path) != -1) {
    console.log('test')
}

$('[name="company_action"]').change(function() {
    if(this.value != ''){
        getCompanyMappingContent();
    }
});
