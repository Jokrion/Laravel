
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function(){
	function openModal(event, type, id)
	{
		event.preventDefault();

		var postid = $('#postid');
		postid.html(id);

		if(type == 'del') {
			var modale = $('#deleteModal');
		} else if(type == 'pub') {
			var modale = $('#pubModal');
		} else {
			var modale = $('#unpubModal');
		}

		modale.modal('show');
	}

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
});