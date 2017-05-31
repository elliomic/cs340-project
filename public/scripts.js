

var myPix = new Array( "images/barshaw_01.jpg", "images/carson_01.jpg", "images/court_01.jpg", "images/court_02.jpg", "images/court_03.jpg", "images/jake_bredenbeck_hit.jpg", "images/jake_bredenbeck01.jpg", "images/OSU_Team_01.jpg", "images/wayne_dive_01.jpg", "images/wayne_dive_02.jpg", "images/jake_bredenbeck_hit.jpg");

function choosePic() {
     var randomNum = Math.floor(Math.random() * myPix.length);
     document.getElementById("myPicture").src = myPix[randomNum];
	 
}
	window.onload = choosePic;
function username_check(input){
	search database users;
	if (input == dbuser)
		return true;
	else
		return false;
}
function password_check(input){
	search database passwords;
	if (input == dbpass)
		return true;
	else
		return false;	
}

function state_input() {
	
	var dropdown = document.getElementById("state");
    var state = dropdown.options[dropdown.selectedIndex].value;

window.open("http://www.usaracquetballevents.com/" + state + "/racquetball-events.asp");
  win.focus();

	
}

function logged_in(){
	check if logged in;
	
	if logged in
	
}

