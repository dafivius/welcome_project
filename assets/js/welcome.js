/**
 * Created by Leviostas on 01.08.2017.
 */
$(document).ready(function()
{
    $('input#email').on('input',function()
    {
        var email_data = $('input#email').val();

        if(email_data.length >= 6) // Если ввели 6+ символов - шлем на сервер проверку
        {
            $.ajax({
                type: "POST",
                url: "ajax", // POST'ом отправляем на ajax_view, которая проверяет наличие email'а и возвращ. ответ
                data: 'email='+email_data, // посылаем массив с ключом email
                beforeSend: function()
                {
                    $("#error").fadeOut(1000);
                    $("#error_span").html('<span class="glyphicon glyphicon-transfer"></span> Проверка ...');
                },
                success: function(response){ // Функция получает ответ от сервера
                    // console.log(response);
                    if(response == "Email свободен"){
                        console.log(response);
                        $("#error").fadeIn(100, function() { // Выводим бутстрап блок "Email свободен"
                            $("#error_span").html('<div class="alert alert-success" role="alert">&nbsp; Email свободен</div>');
                        });
                    } else if(response == "Email занят!") {
                        console.log(response); // для отладки
                        $("#error").fadeIn(100, function(){ // выводим бутстрап блок "Email занят"
                            $("#error_span").html('<div class="alert alert-danger" role="alert">&nbsp; Email занят!</div>')
                        });
                    }
                }
            });
        } // закрывающая скобка if'а
        return false;
    })

    // Проверка раскладки клавиатуры в строке ввода пароля
    $('input#password').keyup(function(){
        if($(this).val().match(/([а-яёА-ЯЁ]+)/)){
            console.log('Смените раскладку');
            $("#error").fadeIn(1000, function(){ // выводим бутстрап блок "Email занят"
                $("#error_span").html('<div class="alert alert-danger" role="alert">&nbsp; Смените раскладку клавиатуры!</div>')
            });
        }
    });

    $("input#phone").mask("9-999-999-99-99");
});