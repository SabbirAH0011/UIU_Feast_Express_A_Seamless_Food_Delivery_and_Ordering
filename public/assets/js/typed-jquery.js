$(window).on('load', function () {
    function ReloadReady() {
        $('#preloader').css('display', 'none');
        $('.main').css('display', 'block');
    };
    window.setTimeout(ReloadReady, 250);
});
$(document).ready(function () {
    $('#see_password').click(function () {
        $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
    });

    $('#main_image').change(function () {
        const file = this.files[0];
        if (file) {
            $('.image-holder').css('display','block');
            let reader = new FileReader();
            reader.onload = function (event) {
                $('#imgPreview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }else{
            $('.image-holder').css('display', 'none');
        }
    });
});
