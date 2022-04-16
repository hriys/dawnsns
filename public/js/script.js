//投稿の更新フォーム
$(function () {
    $('.modalopen').each(function () {
        $(this).on('click', function () {
        var target = $(this).data('target'); //data-target="{{ $list->id }}"
        var modal = document.getElementById(target); //変数targetと一致するidを変数modalに入れる
        console.log(modal);
        $(modal).fadeIn();
        return false;
        });
    });
    $(".bg").on('click', function(){ //.bg…半透明の背景と.upform
        $(".bg").fadeOut();
        return false;
    });
    $(".upform").click(function(event){ //.upform…投稿フォーム
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