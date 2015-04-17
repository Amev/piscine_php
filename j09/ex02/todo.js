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
		var element = document.getElementById(id);
		var son = element.firstChild;
		element.parentNode.removeChild(element);
		son = son.data + "/-/-/" + id;
		createCookie(son, "", -1);
		son.parentNode.removeChild(son);
		element.parentNode.removeChild(element);
	}
}

function newTask() {

	var task = prompt("Quelle est votre nouvelle tache ?");
	task = task.replace(";", ",");
	task = task.replace("=", "->");
	createCookie(task + "/-/-/" + pId, "my_cookie", 1);
	var div = document.getElementById('ft_list');
	var newDiv = document.createElement('div');
	var content = task;
	var content = document.createTextNode(content);
	newDiv.appendChild(content);
	newDiv.setAttribute("onclick", "removeTask("+pId+")");
	newDiv.setAttribute("id", pId);
	pId++;
	createCookie("my_cookie_id", pId, 1);
	div.insertBefore(newDiv, div.firstChild);
}

function getCookie() {

	return document.cookie.split(';');
}

function listTasks() {

	var div = document.getElementById('ft_list');
	var tasks = getCookie();
	var len = tasks.length;

	while (--len >= 0) {

		var content = tasks[len].split('=');
		if (content[1] == "my_cookie") {
			splited = content[0].split("/-/-/");
			splited[0] = splited[0].substring(1);
			var newDiv = document.createElement('div');
			var newContent = document.createTextNode(splited[0]);
			newDiv.appendChild(newContent);
			newDiv.setAttribute("onclick", "removeTask("+splited[1]+")");
			newDiv.setAttribute("id", splited[1]);
			div.appendChild(newDiv);
		}
		else if (content[0] == "my_cookie_id") {

			pId = parseInt(content[1]);
		}
	}
}
