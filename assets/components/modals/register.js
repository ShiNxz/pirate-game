$(document).ready(function() {
    // Register
    $("#register-form").on("submit", function (event) {
        $(".register-btn").prop('disabled', true);
        event.preventDefault();
        Register();
    });

    function register_submitMSG(valid, msg) {
        var msgClasses;
        if(valid){
            msgClasses = `<div class="alert alert-success" role="alert">נרשמת בהצלחה! עכשיו רק נשאר להתחבר, תוכל לעשות זאת <a style="color: #04924f;" onclick="$('#login').modal('show'); $('#register').modal('hide');">מכאן</a></div>`;
        } else {
            msgClasses = `<div class="alert alert-danger" role="alert">${msg}</div>`;
        }
        $("#validator-register").html(msgClasses).fadeIn();
    }

    function Register(){
        var email = $("#register_email").val(),
            password = $("#register_password").val();
    
        if(email == "" || password == "")
          return register_submitMSG(false, 'עליך למלא את כלל הפרטים');
    
        $.ajax({
            type: "POST",
            url: `assets/php/register.php`,
            dataType: 'text',
            data: {
                email: email,
                password: password,
            },
            beforeSend: function() {
                $("#validator-register").fadeOut(50);
            },
            success: function(text){
                if (text == "success"){
                    register_submitMSG(true);
                } else {
                    $(".register-btn").prop('disabled', false);
                    register_submitMSG(false,text);
                }
            }
        });
    }
});