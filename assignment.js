var nq;
var ans;
var maxPages;
var h,m,s;
var random_string;
var random_arr;
var group_name;

function getArandomstring(){
	random_string = document.getElementById("jsrand").value;
	random_arr = random_string.split(",");
	group_name = document.getElementById("qwerty").value;
}

function func(n){
	document.getElementById("ifr").src = "questions/"+group_name+"/ques"+random_arr[n]+".php";
	document.getElementById("ifr").class = n;
	document.getElementById("num-holder").innerHTML="Question #"+n;	
}

function loadFromFrame(n){
	var arr = ans.split("");
	if(arr[n] != 'x'){
		document.getElementById("ifr").contentDocument.getElementById(arr[n]).checked = true;
	}
	ans = arr.join("");
}

function previousQuestion(){
	var i = document.getElementById("ifr").class;
	if(i > 1){
		func(i-1);
	}
	else
		func(i);
}

function nextQuestion(){
	var i = document.getElementById("ifr").class;
	
	if(i < maxPages){
		func(i+1);
	}
	else
		func(i);
}


function recordResponse(str){
	var p = document.getElementById("ifr").class;
	p = random_arr[p];
	var arr = ans.split("");
	arr[p] = str;
	p = random_arr.indexOf(p);
	document.getElementById(p).style.backgroundColor = "#66CD00";
	document.getElementById(p).style.color='white';
	ans = arr.join("");
	
	document.getElementById("xyz").value = ans;
	
}
function final(){
	if(confirm("Are you sure that you want to submit the responses!!")){
		document.getElementById("formID").submit();
	}
}

function init(){
	document.getElementById("ifr").class = 1;
	nq = document.getElementById("temp").value;
	ans = "x".repeat(nq+1);
	maxPages = nq;
	getArandomstring();
}

function swap(){
	document.getElementById("start-holder").remove();
	document.getElementById("xlr").style.display = "block";
	document.getElementById("instructions").style.display = "none";
	document.getElementById("timer-holder").style.display = "block";
	document.getElementById("navigate").style.display = "block";
	document.getElementById("ques").style.display = "block";
	document.getElementById("question").style.display = "block";
	document.getElementById("formID").style.display = "block";
	document.getElementById("num-holder").style.display = "block";
	document.getElementById("total-holder").style.display = "block";
}

function timer(){
	var gh = document.getElementById("h").value;
	var gm = document.getElementById("m").value;
	var gs = document.getElementById("s").value;
	h = gh;
	m = gm;
	s = gs;
	var x = setInterval(show, 1000);
}
var a=0,b=0,c=0;
function show(){
	if(h >= 0 && m >= 0 && s >= 0){
		if(h <= 9)
			a="0"+h;
		else
			a=h;
		if(m <= 9)
			b="0"+m;
		else
			b=m;
		if(s <= 9)
			c="0"+s;
		else
			c=s;

		document.getElementById("time").innerHTML = a+" : "+b+" : "+c;
		document.getElementById("h").value = a;
		document.getElementById("m").value = b;
		document.getElementById("s").value = c;
		
		if(s == 0 && m == 0 && h == 0){
			document.getElementById("formID").submit();
		}
		s--;
		if(s < 0){
			s = 59;
			m--;
			rNo = document.getElementById("nro").value;
			document.cookie = "time"+rNo+"="+m;
		}

		if(m < 0){
			m = 59;
			h--;
		}
	}
}