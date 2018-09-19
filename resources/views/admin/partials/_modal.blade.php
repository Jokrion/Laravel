<div id="{{ $id }}" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Retour">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
        		<p>{{ $text }}</p>
      		</div>
      		<div class="modal-footer">
        		<button onclick="{{ $method }}({{ "'" . implode("', '", $args) . "'" }});" class="btn btn-primary">{{ $button_text }}</button>
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
      		</div>
    	</div>
  	</div>
</div>