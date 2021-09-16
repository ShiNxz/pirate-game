<? if($logged): ?>
    <div class="modal pirate-modal fade" id="stats-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        	<div class="modal-content">
        		<div class="modal-body">
                    <div class="row text-center mb-5">
                        <div class="col">
                            <h4>נצחונות</h4>
                            <h1 id="wins"></h1>
                        </div>
                        <div class="col">
                            <h4>הפסדים</h4>
                            <h1 id="loses"></h1>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" onclick="$('#stats-modal').modal('hide');">סגירה</button>
                    </div>
        		</div>
          	</div>
        </div>
    </div>
<? endif; ?>