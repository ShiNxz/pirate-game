<? if(!$logged): ?>
    <div class="modal fade pirate-modal" id="register" tabindex="-1">
    	<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">
    		  	<form id="register-form" class="register-form">
    				<div class="modal-header">
    				  <h5 class="modal-title">הרשמה</h5>
    				</div>
    				<div class="modal-body">
    					<div class="row">
    						<div class="col-12 col-md-12 order-2 order-md-1 text-center text-md-right">
    							<div id="validator-register" class="hidden"></div>
    						</div>
    					</div>
    					<div class="row">
    						<div class="form-group col-8 col-md-8 mb-4">
    							<label for="register_email">כתובת אימייל</label>
    							<input style="direction: rtl" type="email" class="form-control" id="register_email" name="register_email" placeholder="לדוגמה: name@mail.com" required="required" autocomplete="on" oninvalid="setCustomValidity('יש להקליד כתובת אימייל')" onkeyup="setCustomValidity('')">
    							<div class="help-block with-errors"></div>
    						</div>
    						<div class="form-group col-8 col-md-8 mb-4">
    							<label for="register_password">סיסמה</label>
    							<input class="form-control" type="password" id="register_password" name="register_password" placeholder="סיסמה" required="required" minlength="7" maxlength="20" oninvalid="setCustomValidity('יש להקליד סיסמה בעלת 7 תוים לפחות')" onkeyup="setCustomValidity('')"></input>
    							<div class="help-block with-errors"></div>
    						</div>
    					</div>
						<div class="col-12 col-md-10">
							<a class="mr-1" onclick="$('#login').modal('show'); $('#register').modal('hide');">יש ברשותי משתמש</a>
						</div>
    				</div>
    				<div class="modal-footer">
    				  <button type="button" class="btn btn-outline-secondary" onclick="$('#register').modal('hide');">ביטול</button>
    				  <button type="submit" class="btn btn-outline-primary register-btn">הרשם</button>
    				</div>
    			</form>
    	  	</div>
    	</div>
    </div>
    <script>
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
    </script>
<? endif; ?>