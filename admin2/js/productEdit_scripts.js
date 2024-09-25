function get() {
    $(document).delegate("[data-target='#fixProductModal']", "click", function () {
        var masp = $(this).attr('data-id');

        // Ajax config
        $.ajax({
            type: "GET",
            url: 'getProduct.php',
            data: { "MA_SP": masp },
            success: function (response) {
                response = JSON.parse(response);
                let form = $("#productEdit-form");

                $("#productEdit-form [name=\"typeID_edit\"]").val(response.MA_LOAI);
                $("#productEdit-form [name=\"productID_edit\"]").val(response.MA_SP);
                $("#productEdit-form [name=\"productName_edit\"]").val(response.TEN_SP);
                $("#productEdit-form [name=\"color_edit\"]").val(response.MAU);
                $("#productEdit-form [name=\"price_edit\"]").val(response.GIA);
                $("#productEdit-form [name=\"remainingProducts_edit\"]").val(response.SO_LUONG);
                form.find('[name="productDetail"]').val(response.CHI_TIET);
                $('#edit-product-modal').modal('toggle');
            }
        });
    });
}

function update() {
    $("#updateProductBtn").on("click", function () {

        var $this = $(this); // submit button selector using ID
        var form = $("#productEdit-form")[0]; // get form by ID
        var formData = new FormData(form); // Create FormData object, including file data

        var route = $(form).attr('action'); // get the route using attribute action

        // Ajax request
        $.ajax({
            type: "POST", // POST method to submit data
            url: route, // Route for submission
            data: formData, // Serialized array for server-side
            contentType: false, // Important: Prevent jQuery from setting Content-Type
            processData: false, // Important: Prevent jQuery from processing the data
            beforeSend: function () { // Disable button to prevent multiple clicks
                $this.attr('disabled', true).html("Processing...");
            },
            success: function (response) { // On successful response
                alert(response); // Display success message
                $('#edit-product-modal').modal('hide'); // Hide modal
                location.reload(); // Reload page to reflect changes
            },
            error: function (response) { // On failure
                console.log(response.responseText); // Log error response
                alert("Error updating product information!"); // Show error message
            },
            complete: function () { // Re-enable button
                $this.attr('disabled', false).html("Lưu"); // Reset button state
            }
        });
    });
}

$(document).ready(function () {
    get(); // Get the data and view in modal
    update(); // Update the data
});
