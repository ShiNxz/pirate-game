<? if(!$logged): ?>
<div class="modal pirate-modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  	<form id="login-form" class="login-form" data-toggle="validator">
				<div class="modal-header">
				  <h5 class="modal-title">התחברות</h5>
				</div>
				<div class="modal-body">
					<div class="row mb-1">
						<div class="col-12 col-md-12 order-2 order-md-1 text-center text-md-right">
							<div id="validator-login" class="hidden"></div>
						</div>
					</div>
					<div class="row">
                        <div class="row">
					    	<div class="form-group col-8 col-md-8 mb-4">
                                <label for="login_email" class="form-label">כתובת אימייל</label>
					    		<input type="text" class="form-control" id="login_email" name="login_email" placeholder="user@mail.com" required="required" autocomplete="on" oninvalid="setCustomValidity('יש להקליד כתובת אימייל')" onkeyup="setCustomValidity('')">
					    		<div class="help-block with-errors"></div>
					    	</div>
                        </div>
						<div class="form-group col-8 col-md-8 mb-4">
                            <label for="login_Password" class="form-label">סיסמה</label>
							<input class="form-control mb-1" type="password" id="login_Password" name="login_Password" placeholder="••••••••••••" required="required" oninvalid="setCustomValidity('יש להקליד סיסמה')" onkeyup="setCustomValidity('')"></input>
							<div class="mb-1" style="display:flex;justify-content: space-between;align-items: center">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="password_toggle" id="password_toggle" onclick="ShowPassword('#login_Password')"></input>
									<label class="custom-control-label" for="password_toggle">הצג סיסמה</label>
								</div>
							</div>
							<div class="help-block with-errors"></div>
						</div>
						<div class="col-12 col-md-10">
							<a class="mr-1" onclick="$('#login').modal('hide'); $('#register').modal('show');">אין ברשותך משתמש? לחץ להרשמה</a>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				  <button type="submit" class="btn btn-outline-primary login-btn">התחבר</button>
				</div>
			</form>
	  	</div>
	</div>
</div>
<script>

</script>
<? endif; ?>