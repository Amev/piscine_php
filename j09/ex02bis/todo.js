var pId = 0;

function createCookie(name, value, days) {

	if (days > 0) {

		var date = new Date();
		date.setTime(date.getTime() + days * (24*60*60*1000));
		var expire = "; expire=" + date.toGMTString();
	}
	else {
		expire = ""
	}

	var cookie = name+"="+value+expire+"; path=/";
	document.cookie = cookie;
}

function removeTask(id) {

	if (confirm("Etes-vous sur de vouloir supprimer cette tache ?")) {
		query_id = "#" + id;
		var son = $(query_id).text();
		son = son + "/-/-/" + id;
		createCookie(son, "", -1);
		$(query_id).remove();
	}
}

function newTask() {

	var task = prompt("Quelle est votre nouvelle tache ?");
	task = task.replace(";", ",");
	task = task.replace("=", "->");
	createCookie(task + "/-/-/" + pId, "my_cookie", 1);
	$('<div />', {
		onclick : "removeTask("+pId+")",
		id : pId,
	}).insertAfter("#new").text(task);
	pId++;
	createCookie("my_cookie_id", pId, 1);
}

function getCookie() {

	return document.cookie.split(';');
}

function listTasks() {

	var tasks = getCookie();
	var len = tasks.length;

	while (--len >= 0) {

		var content = tasks[len].split('=');
		if (content[1] == "my_cookie") {
			splited = content[0].split("/-/-/");
			splited[0] = splited[0].substring(1);
			$('<div />', {
				onclick : "removeTask("+splited[1]+")",
				id : splited[1],
			}).insertAfter("#new").text(splited[0]);
		}
		else if (content[0] == "my_cookie_id") {

			pId = parseInt(content[1]);
		}
	}
}
