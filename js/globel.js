
//function l(v) {
//    console.log(v);
//}

$(document).ready(function () {
    $('.login_success').hide();
    $('.subbmint').click(function () {
        var email = $('input[name="email"]').val();
        var password = $('input[name="password"]').val();
        $form = $('.loginform').serialize();
        if (!email || !password) {
            alert('Email and password are compulsary fields');
            return false;
        }
        $.post('http://localhost/desktopdeli/customer/login', $form, function (response) {
            console.log(response);
            var data = JSON.parse(response);
            if (data.success) {
                $('.login_success').show();
                setTimeout(function () {
                    $('.cls').trigger('click');
                }, 2000);
            }
        });
        return false;
    });
});
