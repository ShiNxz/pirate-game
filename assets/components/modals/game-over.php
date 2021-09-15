<div class="modal pirate-modal fade" id="game-over" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
                <h1 id="over-title"></h1>
				<h3 id="over-desc"></h3>
                <a onclick="Game.New()">[ משחק חדש ]</a>
				<? if(!$logged): ?>
					<br/><br/>
                	<a style="font-size: 15px;" onclick="$('#register').modal('show');">מעוניין להתחיל לצבור נצחונות? לחץ כאן!</a>
				<? endif; ?>
			</div>
	  	</div>
	</div>
</div>