$(function(){
		
	var note = $('#note'),
		ts = new Date(2012, 0, 1),
		newYear = true;
	
	if((new Date()) > ts){
		// The new year is here! Count towards something else.
		// Notice the *1000 at the end - time must be in milliseconds
		data1 = new Date();
		data2 = new Date('Sat, 15 Sep 2012 00:00:00 GMT-0300');
		intervalo = data2-data1;
		ts = (new Date()).getTime() + intervalo;
		//ts = (new Date()).getTime() + 20*24*60*60*1000;
		newYear = false;
	}
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "Proporcionando momentos de satisfação e prazer em <br /><br />";
			
			message += days + " dia" + ( days==1 ? '':'s' ) + ", ";
			message += hours + " hora" + ( hours==1 ? '':'s' ) + ", ";
			message += minutes + " minuto" + ( minutes==1 ? '':'s' ) + " e ";
			message += seconds + " segundo" + ( seconds==1 ? '':'s' ) + " <br />";
			
			note.html(message);
		}
	});
	
});
