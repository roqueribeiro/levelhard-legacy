jQuery.fn.extend({ 
	formFocus:function(text) 
	{
		$(this).val(text);
		$(this).click( function() {
			if ($(this).val() == text) {
				$(this).val("");
				$(this).addClass(this);
			}		
		});
		$(this).blur(function(){
			$(this).removeClass(this);
			if ($(this).val() == "") {
				$(this).val(text);
			}
		});
		$(this).keypress(function() {
			$(this).removeClass(this);
		});
	} 
});