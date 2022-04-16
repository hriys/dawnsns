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
    $(".bg").on('click', function(){
        $(".bg").fadeOut();
        return false;
    });
    $(".upform").click(function(event){
        event.stopPropagation();
    });
});

//プルダウンメニュー
$(function(){
    $('#user').click(function() {
        $('#menu ul').slideToggle();
        return false;
    });
});