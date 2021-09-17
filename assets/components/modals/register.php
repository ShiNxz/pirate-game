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
	<script src="assets/components/modals/register.js"></script>
<? endif; ?>