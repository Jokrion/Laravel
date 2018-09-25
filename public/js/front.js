// Handles menu activation
displayMenu();
function displayMenu()
{
	var loc = window.location.pathname;

	if(loc.includes("/stages") !== false) {
		$('#int').addClass('active');
	} else if(loc.includes("/formations") !== false) {
		$('#train').addClass('active');
	} else if(loc.includes("/contact") !== false) {
		$('#contact').addClass('active');
	} else if(loc.includes("/admin") !== false) {
		$('#admin').addClass('active');
	} else {
		$('#home').addClass('active');
	}
}