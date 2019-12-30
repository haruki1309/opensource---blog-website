$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    $('.newsletterForm').ajaxForm({
        url: baseUrl + '/public/subscribe',
        type: 'post',
        success: function(data){
            $('#subsModal').modal('hide');
            $('#notify-modal-subscribe').modal('show');
        },
        error: function(data){
            console.log('error');
        }
    });

});
