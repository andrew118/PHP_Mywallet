var button = document.getElementById("modal_submit");

button.addEventListener("click", function(event) {
	var date1 = document.getElementById("begin_date").value;
	var date2 = document.getElementById("end_date").value;
	
	var dates_correct = true;
	
	if(!checkIfDateCorrect(date1) || !checkIfDateCorrect(date2)) {
		dates_correct = false;
		document.getElementById("dateRangeInput").innerHTML = "Popraw daty.<br>Format RRRR-MM-DD.<br>Początkowa musi być mniejsza";
		document.getElementById("dateRangeInput").className = "modal-title text-danger font-weight-bold";
	}
		
	if (!checkIfFirstDateSmaller(date1, date2))
	{
		dates_correct = false;
	}
	
	if (dates_correct) {
		event.submit();
	} else {
		event.preventDefault();
	}
	
});

function checkIfDateCorrect(formDate) {
	var datePieces = formDate.split("-");
	var y = parseInt(datePieces[0], 10);
	var m = parseInt(datePieces[1], 10);
	var d = parseInt(datePieces[2], 10);
	
	var date = new Date(y, m-1, d);

	if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
	  return true;
	} else {
	  return false;
	}
}

function checkIfFirstDateSmaller(firstDate, secondDate) {
	var firstDatePieces = firstDate.split("-");
	var secondDatePieces = secondDate.split("-");
	
	var y1 = parseInt(firstDatePieces[0], 10);
	var m1 = parseInt(firstDatePieces[1], 10);
	var d1 = parseInt(firstDatePieces[2], 10);
	
	var y2 = parseInt(secondDatePieces[0], 10);
	var m2 = parseInt(secondDatePieces[1], 10);
	var d2 = parseInt(secondDatePieces[2], 10);
	
	var intFirstDate = y1 * 10000 + m1 * 100 + d1;
	var intSecondDate = y2 * 10000 + m2 * 100 + d2;
	
	if (intFirstDate < intSecondDate){
		return true;
	} else {
		return false;
	}
}