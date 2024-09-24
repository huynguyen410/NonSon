function get() {
	$(document).delegate("[data-target='#fixProductModal']", "click", function () {

		var masp = $(this).attr('data-id');

		// Ajax config
		$.ajax({
			type: "GET", //we are using GET method to get data from server side
			url: 'getProduct.php', // get the route value
			data: { "MA_SP": masp }, //set data
			beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click

			},
			success: function (response) {//once the request successfully process to the server side it will return result here
				
				response = JSON.parse(response);
				let form = $("#productEdit-form");

				$("#productEdit-form [name=\"typeID_edit\"]").val(response.MA_LOAI);
				$("#productEdit-form [name=\"productID_edit\"]").val(response.MA_SP);
				$("#productEdit-form [name=\"productName_edit\"]").val(response.TEN_SP);
				$("#productEdit-form [name=\"color_edit\"]").val(response.MAU);
				$("#productEdit-form [name=\"price_edit\"]").val(response.GIA);
				$("#productEdit-form [name=\"remainingProducts_edit\"]").val(response.SO_LUONG);
				// $("#productEdit-form [name=\"productStatus_edit\"]").val(response.TINH_TRANG_SP);
				form.find('[name="productDetail"]').val(response.CHI_TIET);
				console.log(form);
				console.log(form.find('[name="productDetail"]'));
				$('#edit-product-modal').modal('toggle');
			}
		});
	});
}

function update() {
	$("#updateProductBtn").on("click", function () {

		var $this = $(this); //submit button selector using ID
		var $caption = $this.html();// We store the html content of the submit button
		var form = "#productEdit-form"; //defined the #form ID
		var formData = $(form).serializeArray(); //serialize the form into array
		var route = $(form).attr('action'); //get the route using attribute action
		// Ajax config
		$.ajax({
			type: "POST", //we are using POST method to submit the data to the server side
			url: route, // get the route value
			data: formData, // our serialized array data for server side
			beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
				$this.attr('disabled', true).html("Processing...");
			},
			success: function (response) {//once the request successfully process to the server side it will return result here
				// reloadPage();
			},
			error: function (response) {//once the request successfully process to the server side it will return result here
				console.log(response.responseText);
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