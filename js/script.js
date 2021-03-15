$(document).ready(function () {
 $("#SendComment").click(function (){
     //console.log(112);
    let name = $("#name");
    let email = $("#email");
    let message = $("#message");

    if(name.val() != '' && email.val() != '' && message.val() != ''){

        $.ajax({
           type: 'post',
           url: '/ajax/comments_ajax.php',
           data: $("#form").serialize(),
            success: function (data){

                //$("#comments").html(data);
                let d = JSON.parse(data);
                $("#comments").html(d.comments);
                $("#cc").html(d.cc);
                name.val('');
                email.val('');
                message.val('');

                //let cc = $("#cc").html();
                //let newCc = parseInt(cc) + 1;
               // $("#cc").html(newCc);
            }
        });



    }else {
        $("#form_error").html('Заполните все поля!');
    }


    $("input, textarea").focus(function (){// очищаем ошибки
        $("#form_error").html('');
    })




 });
    $("#sendEmail").click(function (){
        //console.log(112);
        let subs = $("#sub_email");
        if(subs.val() != ''){
            $.ajax({
                type: 'post',
                url: '/ajax/subscribe_ajax.php',
                data: $("#subscribe").serialize(),
                success: function (data){
                    console.log(data);
                    $("#sub_error").html('Вы подписаты на новости');

                }
            });



        }else {
            $("#sub_error").html('Заполните адрес электронной почты!');
        }


        $("input").focus(function (){ // очищаем ошибки
            $("#sub_error").html('');
        })




    });
    $("#an").click(function (){
        //console.log(112);
        let title = $("#title");
        let prev = $("#prev");
        let det = $("#det");
        let kat = $("#kat");
        let file = $("#file");
        if(title.val() != '' && prev.val() != '' && det.val() != '' && kat.val() != '' && file.val() != ''){
            $.ajax({
                type: 'post',
                url: '/ajax/admin_ajax.php',
                data: $('#news_form').serialize(),
                success: function (data){
                    let dat = JSON.parse(data);
                    $("#addHistory").html(dat.Add);
                    $("#result").html('Новость добавлена');
                    title.val('');
                    prev.val('');
                    det.val('');
                    kat.val('');
                    file.val('');

                }
            });
        }else {
            $("#result").html('Заполните все поля');
        }

        $("input, textarea").focus(function (){ // очищаем ошибки
            $("#result").html('');

        })




    });


});