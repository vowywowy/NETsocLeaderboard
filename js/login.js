document.addEventListener("DOMContentLoaded", function (e) {
	document.getElementById("username").onkeyup = function () {
		checkState();
	}
	document.getElementById("password").onkeyup = function () {
		checkState();
	}
});

function checkState() {
	if (document.getElementById("username").value && document.getElementById("password").value) {
		document.getElementById("log").removeAttribute("disabled");
	} else {
		document.getElementById("log").setAttribute("disabled", "disabled");
	}
}