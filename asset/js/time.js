setInterval(timer,1000);
function timer(){
    var hour = new Date();
    $('#timer-hour').text(hour.getHours()+ ":");
    if(hour.getMinutes() < 10){
		$('#timer-minutes').text("0"+hour.getMinutes()+ ":");
    }else{
		$('#timer-minutes').text(hour.getMinutes()+ ":");
    }
    if(hour.getSeconds()<10){
		$('#timer-second').text("0"+hour.getSeconds());
    }else{
		$('#timer-second').text(hour.getSeconds());
    }
}