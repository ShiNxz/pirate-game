<? if($User["Role"] >= 2): // Check if the user has role 2 or higher ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>

<div class="modal pirate-modal fade" id="admin" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    	<div class="modal-content">
    		<div class="modal-body text-center">
				<div class="row">
					<table class="table table-centered dataTable no-footer" id="admin_table">
						<thead>
							<tr>
								<th scope="col" id="top_id">#</th>
								<th scope="col" id="top_id">אימייל</th>
								<th scope="col" id="top_id">נצחונות</th>
								<th scope="col" id="top_id">הפסדים</th>
				  	  		</tr>
						</thead>
                        <tbody class="admin">
						</tbody>
					</table>
				</div>
                <div class="row">
                    <button class="btn btn-primary" onclick="$('#admin').modal('hide');">סגירה</button>
                </div>
    		</div>
      	</div>
    </div>
</div>
<script src="assets/components/modals/admin.js"></script>
<? endif; ?>