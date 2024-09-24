function get() {
    $(document).delegate("[data-target='#fixAccountModal']", "click", function () {
        var username = $(this).attr('data-id');

        // Ajax config
        $.ajax({
            type: "GET",
            url: 'get.php', // URL to fetch user data
            data: { "username": username },
            beforeSend: function () {
                // Disable the button or show a loading spinner
            },
            success: function (response) {
                try {
                    response = JSON.parse(response); // Parse JSON response

                    // Fill the form with the data from the response
                    $("#edit-form [name='Username_edit']").val(response.USERNAME);
                    $("#edit-form [name='Name_edit']").val(response.NAME);
                    $("#edit-form [name='phoneNumber_edit']").val(response.PHONE_NUMBER);
                    $("#edit-form [name='email_edit']").val(response.EMAIL);
                    $("#edit-form [name='Address_edit']").val(response.ADDRESS);
                    $("#edit-form [name='Role_edit']").val(response.ROLE);

                    // Toggle the modal to display
                    $('#fixAccountModal').modal('toggle');
                } catch (e) {
                    console.error('Error parsing JSON:', e); // Catch any JSON parsing errors
                }
            },
            error: function (xhr, status, error) {
                console.error('Ajax request failed:', status, error); // Log the error
                alert('Failed to fetch user data. Please try again.'); // Notify the user
            }
        });
    });
}


function update() {
	$("#btnUpdateSubmit").on("click", function () {

		var $this = $(this); //submit button selector using ID
		var $caption = $this.html();// We store the html content of the submit button
		var form = "#edit-form"; //defined the #form ID
		var formData = $(form).serializeArray(); //serialize the form into array
		var route = $(form).attr('action'); //get the route using attribute action
		//console.log(formData);
		// Ajax config
		$.ajax({
			type: "POST", //we are using POST method to submit the data to the server side
			url: route, // get the route value
			data: formData, // our serialized array data for server side
			beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
				$this.attr('disabled', true).html("Processing...");
			},
			success: function (response) {//once the request successfully process to the server side it will return result here
				$this.attr('disabled', false).html($caption);

				// We will display the result using alert
				alert(response);

				// Close modal
				$('#fixAccountModal').modal('toggle');
			},
		});
	});
}

$(document).ready(function () {
	// Get the data and view to modal
	get();

	// Updating the data
	update();
});