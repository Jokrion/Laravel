// Opens the three different modals
function openModal(event, type, id)
{
	event.preventDefault();

	var postid = $('#postid');
	postid.html(id);

	if(type == 'des') {
		var modale = $('#desModal');
	}

	modale.modal('show');
}

function unparticipate(url, redir)
{
	var postid = $('#postid').html();
	url = url.replace('#', postid);
	
	$.ajax({
	  	type: "GET",
	  	url: url
	});

	window.location.reload(true);
}