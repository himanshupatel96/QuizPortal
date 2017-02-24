var teacher = new Array();
var rnum = 0;
var lnum ;
var count ;

function init(){
	lnum = document.getElementById("count").value;
	count = lnum;
}

var alreadyPresent = function(b){
	for(var i = 1; i <= rnum; i++){
		if(teacher[i] == b){
			return i;
		}
	}
	return 0;
}

function addTeacher(a){
	if(alreadyPresent(document.getElementById("lname"+a).innerHTML.trim()) == 0){
		rnum++;
		teacher[rnum] = document.getElementById("lname"+a).innerHTML.trim();

		if(rnum > count){
			alert("Error, cannot add more teachers!!!");
			lnum++;
			return;
		}

		for(var i = a;i < lnum; i++){
			document.getElementById("lname"+i).innerHTML = document.getElementById("lname"+(i+1)).innerHTML.trim();
		}

		document.getElementById("rname"+rnum).innerHTML = teacher[rnum];
		document.getElementById("r"+rnum).style.display = "block";
		document.getElementById("l"+lnum).style.display = "none";
		document.getElementById("lname"+lnum).innerHTML = null;

		lnum--;

		document.getElementById("nRemaining").innerHTML = lnum;
		document.getElementById("nSelected").innerHTML = rnum;
	}
	else{
		return;
	}

	updateForm();
}
function removeTeacher(a){
	if(rnum == 0){
		return;
	}
	var tt = document.getElementById("rname"+a).innerHTML.trim();
	var i;

	for(i=a;i<rnum;i++){
		document.getElementById("rname"+i).innerHTML = document.getElementById("rname"+(i+1)).innerHTML.trim();
		teacher[i] = teacher[i+1];
	}

	document.getElementById("rname"+rnum).innerHTML = null;
	teacher[rnum] = null;
	document.getElementById("r"+rnum).style.display = "none";

	lnum++;
	document.getElementById("l"+lnum).style.display = "block";
	document.getElementById("lname"+lnum).innerHTML = tt;
	rnum--;

	document.getElementById("nRemaining").innerHTML = lnum;
	document.getElementById("nSelected").innerHTML = rnum;

	updateForm();
}

function moveUp(a){

	if(a > rnum){
		return;
	}

	if(a == 1){
		return;
	}

	var tmp = teacher[a];
	teacher[a] = teacher[a-1];
	teacher[a-1] = tmp;

	tmp = document.getElementById("rname"+a).innerHTML.trim();
	document.getElementById("rname"+a).innerHTML = document.getElementById("rname"+(a-1)).innerHTML.trim();
	document.getElementById("rname"+(a-1)).innerHTML = tmp;	

	updateForm();
}

function moveDown(a){

	if(a > rnum){
		return;
	}

	if(a == rnum){
		return;
	}

	var tmp = teacher[a];
	teacher[a] = teacher[a+1];
	teacher[a+1] = tmp;

	tmp = document.getElementById("rname"+a).innerHTML.trim();
	document.getElementById("rname"+a).innerHTML = document.getElementById("rname"+(a+1)).innerHTML.trim();
	document.getElementById("rname"+(a+1)).innerHTML = tmp;	

	updateForm();
}

function updateForm(){
	var i;
	for(i=1;i<=rnum;i++){
		document.getElementById("a"+i).value = teacher[i].trim();
		teacher[i] = teacher[i].trim();
	}
}

function submitForm(){
	if(rnum == count && lnum == 0){
		if(confirm("Are you sure that you want to submit your preferences!!!")){
			document.getElementById("alloted").submit();
		}
	}
	else{
		alert("Incomplete. First add all the teachers!!!");
		return;
	}
}
function logout(){
	document.getElementById("hidden_form").submit();
}