// Opens the three different modals
function openModal(event, type, id)
{
	event.preventDefault();

	var postid = $('#postid');
	postid.html(id);

	if(type == 'del') {
		var modale = $('#deleteModal');
	} else if(type == 'pub') {
		var modale = $('#pubModal');
	} else if(type == 'unpub') {
		var modale = $('#unpubModal');
	} else {
		var selected = $('#grouped_actions').find(":selected").val();
		if(selected != 'del' && selected != 'soft') return;
		var modale = $('#actionsModal');
	}

	modale.modal('show');
}

// Removes a post on click via ajax
function removePost(token, url, redir)
{
	var postid = $('#postid').html();
	url = url.replace('#', postid);

	$.ajax({
	  	type: "DELETE",
	  	url: url,
	  	headers: {
	    	'X-CSRF-Token': token,
		}
	});

	window.location.reload(true);
}

// Toggles post publication via ajax
function toggle(url, redir)
{
	var postid = $('#postid').html();
	url = url.replace('#', postid);
	
	$.ajax({
	  	type: "GET",
	  	url: url
	});

	window.location.reload(true);
}

// Checks if all checkboxes are checked to change link text
function check()
{
	var checkboxes = $(':checkbox');
	var link = $('#checkall');
	var count = 0;

	checkboxes.each( function(id) {
		if(checkboxes[id].checked === true) count++;
	});

	if(count < checkboxes.length) {
		link.html('Tout cocher');
	} else {
		link.html('Tout décocher');
	}
}

// Checks or unchecks all checkboxes
function checkAll()
{
	var checkboxes = $(':checkbox');
	var link = $('#checkall');
	var count = 0;

	checkboxes.each( function(id) {
		if(checkboxes[id].checked === true) count++;
	});

	if(count == checkboxes.length) {
		for(var i = 0; i < checkboxes.length; i++) {
			checkboxes[i].checked = false;
		}
		link.html('Tout cocher');
	} else {
		for(var i = 0; i < checkboxes.length; i++) {
			checkboxes[i].checked = true;
		}
		link.html('Tout décocher');
	}
}

// Triggers the action selected for the checkboxes checked
function groupedAction(url)
{
	var selected = $('#grouped_actions').find(":selected").val();
	var checkboxes = $(':checkbox');
	var ajaxurl = url + '/adminAction/';
	var ids = [];

	checkboxes.each( function(i) {
		if(checkboxes[i].checked === true) {
			var name = checkboxes[i].name;
			var id = name.split('_')[1];
			ids.push(+id);
		}
	});

	if(ids.length > 0) {
		for(var i = 0; i < ids.length; i++){
			$.ajax({
			  	type: "GET",
			  	url: ajaxurl + ids[i] + '/' + selected
			});
		}

		window.location.reload(true);
	}
}