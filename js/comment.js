var today = new Date();

function checkWeekday() {
	var daysNames = ["niedziela", "poniedziałek", "wtorek", "środa", "czwartek", "piątek", "sobota"];
	
	return daysNames[today.getDay()];
}

function dayComment() {
	var today = checkWeekday();
	
	if (today === "sobota" || today === "niedziela") {
		today += ". Może imprezka? Albo wypadzik na miasto? &#9787;"
	} else {
		today += ". Praca, praca, praca... &#9822;"
	}
	
	document.getElementById("dayOfWeek").innerHTML = today;
	}