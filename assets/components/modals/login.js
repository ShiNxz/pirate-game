$(document).ready(function() {
// Login
$("#login-form").on("submit", function (event) {
    $(".login-btn").prop('disabled', true);
    event.preventDefault();
    Login();
});

function login_submitMSG(valid, msg) {
    var msgClasses;
    if(valid){
        msgClasses = `<div class="alert alert-success" role="alert">התחברת בהצלחה!</div>`;
    } else {
       msgClasses = `<div class="alert alert-danger" role="alert">${msg}</div>`;
    }
    $("#validator-login").html(msgClasses).fadeIn();
}

function Login() {
    var email = $("#login_email").val(),
        password = $("#login_password").val();

    $.ajax({
        type: "POST",
        url: 'assets/php/login.php',
        dataType: 'text',
        data: {
            email: email,
            password: password
        },
        beforeSend: function() { 
            $("#validator-login").fadeOut(50);
        },
        success: function(text){
            if (text == "success"){
                login_submitMSG(true);
                setTimeout(function(){ location.reload(); }, 1200);
            } else {
                $(".login-btn").prop('disabled', false);
                login_submitMSG(false, text);
            }
        }
    });
  }
});