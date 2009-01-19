window.addEvent('domready',function(){

	var searchField = $$('#search_field');
	
	var Search = new Request({
		url: 'index.php/ajax/search/',
		onSuccess: function(responseText) {
			$('list_content').set('html', responseText);
		}
	});
	
	searchField.addEvent('keyup', function(el){
		var term = searchField.get('value');
		Search.send('term='+term);
	});

});