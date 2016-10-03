document.addEventListener("DOMContentLoaded", function (e) {
	var session = document.cookie.replace(/(?:(?:^|.*;\s*)sessionToken\s*\=\s*([^;]*).*$)|^.*$/, "$1"),
		request = new XMLHttpRequest();
	request.open('POST', '../session.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.send('session=' + session);
	request.onreadystatechange = function () {
		if (request.readyState == XMLHttpRequest.DONE) {
			document.getElementById("user").innerHTML = request.responseText;
		}
	}
});