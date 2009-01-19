window.addEvent('domready',function(){

	var searchField = $$('#search_field');
	
	var Search = new Request({
		method: 'post',
		url: 'http://www.fileability.com/coffee-house/index.php/ajax/search/',
		onSuccess: function(responseText) {
			$('content').set('html', responseText);
		}
	});
	
	searchField.addEvent('keydown', function(el){
		var term = searchField.get('value');
		Search.send('term='.term);
	});

});