
$(document).on("pageshow", "#addressListPage", function () {
	changePageTitle('Overview');
	getAddressList();
});

//Form submit for create new
$(document).on('submit', '#createForm', function() {
	
	console.log($('#createForm').serialize());
	
	$.ajax({url: '/services/products/create_address.php',
	    data: {formData : $('#createForm').serialize()}, // Convert form to a JSON string representation
	    type: 'POST',
	    crossDomain: true,
	    cache: false,
		async: true,
	    beforeSend: function() {
	        // This callback function will trigger before data is sent
	    },
	    complete: function() {
	        // This callback function will trigger on data sent/received complete
	    },
	    success: function (result) {
	    	//alert(result);
	    	window.location = "/index.html";
	    },
	    error: function (request,error) {
	        // This callback function will trigger on unsuccessful action                
	        alert('Error: ' + error);
	    }
 	}); 
});

function getAddressList() {
	$.getJSON('services/getaddresslist.php', function(data) {		
		//console.log(JSON.stringify(data));
		$('#employeeList li').remove();
		employees = data.items;
		$.each(employees, function(index, employee) {
			$('#employeeList').append('<li><a href="addressdetails.html?id=' + employee.id + '" data-transition="flip" data-id=' + employee.id + '>' +
				'<h4>' + employee.firstName + ' ' + employee.lastName + '</h4>' + '<p>' + employee.title + '</p>' + '</a></li>');
		});
		$('#employeeList').listview('refresh');
	});
}

function changePageTitle(page_title){
    $('#page-title').text(page_title);
    document.title=page_title;
}



