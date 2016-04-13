$(document).ready(function(){
	var id = getUrlVars()["id"];
	$.getJSON('services/getaddress.php?id='+id, displayAddress);
});


function displayAddress(data) {
	
	var addr = data.item;
	
	//console.log(JSON.stringify(data));
	$('#id').val(addr.id);
	$('#firstname').val(addr.firstName);
	$('#lastname').val(addr.lastName);
	$('#title').val(addr.title);
	$('#department').val(addr.department);
	$('#city').val(addr.city);
	$('#email').val(addr.email);

}

$(document).on("click", "#submitedit", function () {
	
	//console.log('start submit edit form');
	console.log($('#editForm').serialize());

	$.ajax({url: '/services/products/update.php',
	    data: {formData : $('#editForm').serialize()}, // Convert a form to a JSON string representation
	        type: 'post',
	    	async: true,
	    beforeSend: function() {
	        // Callback function before data is sent
	    },
	    complete: function() {
	        // Callback function on data sent/received complete
	    },
	    success: function (result) {
	    	var x = JSON.parse(result);
	    	if(x.success == 1){
	    		//Update successfull
	    		alert(x.message);
	    		window.location = "index.html";
	    	}else if(x.success == 0){
	    		//Error updating
	    		alert(x.message);
	    	}
	    },
	    error: function (request, error) {
	        // This callback function will trigger on unsuccessful action                
	        alert('An error has occurred');
	    }
	});

});

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}