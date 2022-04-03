
//投稿の更新フォーム
$(function () {
    $('.modalopen').each(function () {
        $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        console.log(modal);
        $(modal).fadeIn();
        $("body").append('<div id="bg">');
        $("#bg").fadeIn();
        });
    });
    $("#bg").on('click', function(){
        $(this).fadeOut(function(){
            $(this).remove();
        });
        $().fadeOut();
        return false;
    });
});

//プルダウンメニュー
$(function(){
    $('#user').click(function() {
        $('#menu ul').slideToggle();
        return false;
    });
});
