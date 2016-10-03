document.addEventListener("DOMContentLoaded", function (e) {
	var status = document.getElementById("status");
	document.getElementById("new-username").onkeyup = function () {
		var user = this.value;
		if (user) {
			var request = new XMLHttpRequest();
			request.open('POST', '../check.php', true);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.send('username=' + user);
			request.onreadystatechange = function () {
				if (request.readyState == XMLHttpRequest.DONE) {
					console.log(request.responseText);
					status.innerHTML = request.responseText;
					if (status.innerHTML) {
						document.getElementById("submit").setAttribute("disabled", "disabled");
					} else {
						document.getElementById("submit").removeAttribute("disabled");
					}
				}
			}
		} else {
			status.innerHTML = "";
			document.getElementById("submit").removeAttribute("disabled");
		}
	}
});