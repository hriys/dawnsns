
//投稿の更新フォーム
$(function () {
    $('.modalopen').each(function () {
        $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        console.log(modal);
        $(modal).fadeIn();
        return false;
        });
    });
    $('.modalClose').on('click', function () {
        $('.js-modal').fadeOut();
        return false;
    });
});

//プルダウンメニュー
$(function(){
    $('#user p').click(function() {
        $('#menu ul').slideToggle();
        return false;
    });
});

