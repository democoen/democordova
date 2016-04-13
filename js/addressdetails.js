$(document).on("pageshow", "#detailsPage", function () {
	changePageTitle('Details page');
	var id = getUrlVars()["id"];
	$.getJSON('services/getaddress.php?id='+id, displayAddressDetails);
});

$(document).on("click", "#popupEditDialog", function () {
	 var idToEdit = $('#addressId').text();
	 console.log('edit_id='+idToEdit);
	 window.location.replace("edit.html?id=" + idToEdit);
});

function deleteItem(){
	var idToDelete = $('#addressId').text();
	var deleteItem = $.ajax({
	      type: 'POST',
	      url: "/services/products/delete_address.php",
	      data: {id:idToDelete},
	      success: function(resultData) {
	      		$("#popupCloseLeft").popup("open");
	      		window.location.replace("index.html");
	       }
	});
	deleteItem.error(function() { alert("An errror occured"); });
}

function displayAddressDetails(data) {
	
	var addressItem = data.item;
	//console.log(JSON.stringify(data));
	
	$('#addressId').text(addressItem.id);
	$('#fullName').text(addressItem.firstName + ' ' + addressItem.lastName);
	$('#title').text(addressItem.title);
	$('#city').text(addressItem.city);
	
	if (addressItem.email) {
		$('#actionList').append('<li>Email: ' + addressItem.email + '</li>');
	}
	if (addressItem.officePhone) {
		$('#actionList').append('<li>Telefoon: ' + addressItem.officePhone + '</li>');
	}
	if (addressItem.cellPhone) {
		$('#actionList').append('<li>Mobiel: ' + addressItem.cellPhone + '</li>');
	}
	if (addressItem.managerFirstName) {
		$('#actionList').append('<li><a data-transition="flip" href="addressdetails.html?id=' + addressItem.managerId + '">Manager: ' + addressItem.managerFirstName + ' ' + addressItem.managerLastName + '</a></li>');
	}else{
		$('#actionList').append('<li>Manager: n.v.t.</a></li>');
	}

	$('#actionList').listview('refresh');
	
}

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

// Change page title
function changePageTitle(page_title){   
    // change page title
    $('#page-title').text(page_title);
    document.title=page_title;
}