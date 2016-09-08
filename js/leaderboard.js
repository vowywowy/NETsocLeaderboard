document.addEventListener("DOMContentLoaded", function (e) {
	loadLeaderboard();
	document.getElementById("refresh").onclick = function () {
		var results = document.getElementsByClassName("result");
		while (results.length > 0) {
			results[0].parentNode.removeChild(results[0]);
		}
		loadLeaderboard();
	}
});

function loadLeaderboard() {
	var request = new XMLHttpRequest();
	request.open('POST', '../php/leaderboard.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.send('refresh=true');
	request.onreadystatechange = function () {
		if (request.readyState == XMLHttpRequest.DONE) {
			var leaderboard = JSON.parse(request.responseText);
			for (i in leaderboard) {
				var result = document.createElement("tr"),
					rank = document.createElement("td"),
					user = document.createElement("td"),
					score = document.createElement("td"),
					username = document.createTextNode(leaderboard[i].username),
					points = document.createTextNode(leaderboard[i].points);

				result.setAttribute("class", "result");
				rank.setAttribute("class", "rank");
				user.setAttribute("class", "user");
				score.setAttribute("class", "score");

				user.appendChild(username);
				score.appendChild(points);

				result.appendChild(rank);
				result.appendChild(user);
				result.appendChild(score);

				document.getElementById("leaderboard").firstElementChild.appendChild(result);
			}
		}
	}
}