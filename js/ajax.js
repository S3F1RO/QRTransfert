$(document).ready(function(){
//==============================================================================





/*==============================================================================
	Send ajax to server
==============================================================================*/

	// Send ajax every 60s
	window.setInterval(sendAjax, 60000, "dataAjax.php", {});

	// Send ajax on keyup ENTER in input login
	jQuery("body").on("keyup", "input[name='login']", function(key) {
		if (key.which == 13) {
			var login = jQuery(this).val();
			var pwd = jQuery("input[name='pwd']").val();
			alert("Vous avez appuyé sur ENTREE : login=" + login + ", pwd=" + pwd);
		}
		sendAjax("dataAjax.php", {login: login, pwd: pwd});
	});





/*==============================================================================
	Receive ajax from server
==============================================================================*/

	// Receive ajax
	function receiveAjax(data) {
		// Update html content on success
		if (data.success == true) {
			jQuery(".aClass").html(data.html);
		}

		// Append content to html
		for (var val of data.tab) {
			jQuery("ul").append("<li>" + val + "</li>");
		}
	}





/*==============================================================================
	AJAX functions
==============================================================================*/


	// --- General function sending JSON data to server
	function sendAjax(serverUrl, jsonData) {
		serializedData = JSON.stringify(jsonData);
		jQuery.ajax({type: 'POST', url: serverUrl, dataType: 'json', data: "data=" + serializedData,
			success: function(data) {
				receiveAjax(data);
			}
		});
	}

	// --- Test whether a variable is set or not
	function isset(myVar) {
		if (typeof myVar != 'undefined') return true;
		return false;
	}

//==============================================================================
});
