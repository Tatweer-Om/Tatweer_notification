<script>

// var choicesInstance =new Choices("#choices-multiple-remove-button",{removeItemButton:!0})


$(document).on('click', '.remove-url', function() {
    $(this).closest('.row').remove();
});

// Handle adding new URL input row
$(document).on('click', '.add-url', function() {
    var newRow = `
        <div class="row mb-1">
            <div class="col-lg-10 col-md-9 col-sm-8">
                <input type="text" class="form-control" name="system_url[]" placeholder="{{ trans('messages.enter_system_url_lang', [], session('locale')) }}">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <button type="button" class="btn btn-danger w-100 remove-url">x</button>
            </div>
        </div>
    `;
    $('#url-container').append(newRow); // Add the new row at the end of the container
});

$(document).ready(function() {
    $('#extra_service_switch').on('change', function() {
        if ($(this).prop('checked')) {
            // If the checkbox is checked (extra_service is on)
            $('.toggle-input').show();
        } else {
            // If the checkbox is unchecked (extra_service is off)
            $('.toggle-input').hide();
        }
    });

    // Initialize visibility on page load based on the initial state of the switch
    if ($('#extra_service_switch').prop('checked')) {
        $('.toggle-input').show();
    } else {
        $('.toggle-input').hide();
    }
});



$(document).ready(function() {

    $('#service_id').on('change', function () {
            let serviceId = $(this).val();

            if (serviceId) {
                $.ajax({
                    url: `/get-service-cost/${serviceId}`,
                    type: 'GET',
                    success: function (response) {
                        if (response.status) {
                            // Populate the service cost input field
                            $('.service_cost').val(response.service_cost);
                        } else {
                            // Clear the input field if no service is found
                            $('.service_cost').val('');
                            alert(response.message);
                        }
                    },
                    error: function () {
                        alert('An error occurred while fetching the service cost.');
                    },
                });
            } else {
                // Clear the input field if no service is selected
                $('.service_cost').val('');
            }
        });


$('.update_subscription').off().on('submit', function(e) {
e.preventDefault();

// Prepare form data
var formdatas = new FormData($('.update_subscription')[0]);
var service = $('.service_id').val();
var customer = $('.customer_id').val();
var id = $('.sub_id').val(); // Get the subscriptionment ID

// Check if the service or student is not selected
if (service === "") {
    show_notification('error', '<?php echo trans('messages.add_service_name_lang', [], session('locale')); ?>');
    return false;
}

if (customer === "") {
    show_notification('error', '<?php echo trans('messages.add_customer_lang', [], session('locale')); ?>');
    return false;
}

// Show loader before submitting
$('#global-loader').show();
before_submit(); // Call any pre-submit actions if needed

// Get CSRF token from meta tag
var csrfToken = $('meta[name="csrf-token"]').attr('content');

// Determine if this is an update or add operation
var url = id ? "{{ url('update_subscription') }}" : "{{ url('add_subscription') }}"; // Update URL if ID is present
var type = id ? "POST" : "POST"; // Use PUT for update

$.ajax({
    type: type,
    url: url,
    data: formdatas,
    contentType: false,
    processData: false,
    headers: {
        'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
    },
    success: function(data) {
        // Hide loader and call post-submit actions
        $('#global-loader').hide();
        after_submit();

        if (data.status == 1) {
            show_notification('success', '<?php echo trans('messages.data_update_success_lang', [], session('locale')); ?>');
            window.location.href = '<?php echo route('all_sub'); ?>';


        } else {
            // Handle other statuses or errors in the response
            show_notification('error', data.message || '<?php echo trans('messages.data_update_failed_lang', [], session('locale')); ?>');
        }
    },
    error: function(data) {
        // Hide loader and call post-submit actions
        $('#global-loader').hide();
        after_submit();

        // Show error message and reload DataTable
        show_notification('error', '<?php echo trans('messages.data_update_failed_lang', [], session('locale')); ?>');

    }
});

$('.student_id').select2({
    placeholder: '{{ trans('messages.choose_lang', [], session('locale')) }}', // Placeholder text
    allowClear: true // Allow clearing the selection
});
$('.service_id').select2({
    placeholder: '{{ trans('messages.choose_lang', [], session('locale')) }}', // Placeholder text
    allowClear: true // Allow clearing the selection
});
});


});




</script>
