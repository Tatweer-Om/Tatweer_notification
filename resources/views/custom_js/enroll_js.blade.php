<script>
    // var choicesInstance = new Choices("#choices-multiple-remove-button", {
    //     removeItemButton: !0
    // })

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



        $('.subscription_list').off().on('submit', function(e) {
            e.preventDefault();

            // Prepare form data
            var formdatas = new FormData($('.subscription_list')[0]);
            var service = $('.service_id').val();
            var customer = $('.customer_id').val();
            var id = $('.subscription_id').val(); // Get the subscriptionment ID

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
            var url = id ? "{{ url('update_subscription') }}" :
            "{{ url('add_subscription') }}"; // Update URL if ID is present
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
                        show_notification('success', '<?php echo trans('messages.data_add_success_lang', [], session('locale')); ?>');


                        // Reset the form after successful submission
                        $(".subscription_list")[0].reset();
                        window.location.href = 'all_sub';

                    } else {
                        // Handle other statuses or errors in the response
                        show_notification('error', data.message || '<?php echo trans('messages.data_add_failed_lang', [], session('locale')); ?>');
                    }
                },
                error: function(data) {
                    // Hide loader and call post-submit actions
                    $('#global-loader').hide();
                    after_submit();

                    // Show error message and reload DataTable
                    show_notification('error', '<?php echo trans('messages.data_add_failed_lang', [], session('locale')); ?>');

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



    document.addEventListener("DOMContentLoaded", function() {
        const switchInput = document.getElementById("extra_service_switch");
        const toggleInputs = document.querySelectorAll(".toggle-input");

        switchInput.addEventListener("change", function() {
            toggleInputs.forEach(input => {
                input.style.display = this.checked ? "block" : "none";
            });
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        const urlContainer = document.getElementById("url-container");

        // Add event listener to the "+" button for adding new URL inputs
        urlContainer.addEventListener("click", function(event) {
            if (event.target.classList.contains("add-url")) {
                const newUrlInput = document.createElement("div");
                newUrlInput.className = "row mb-1";
                newUrlInput.innerHTML = `
                <div class="col-lg-10 col-md-9 col-sm-8">
                    <input type="text" class="form-control" name="system_url[]" placeholder="{{ trans('messages.enter_system_url_lang', [], session('locale')) }}">
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <button type="button" class="btn btn-danger w-100 remove-url">
                        &times;
                    </button>
                </div>
            `;
                urlContainer.appendChild(newUrlInput);
            } else if (event.target.classList.contains("remove-url")) {
                // Remove the URL input row
                event.target.closest(".row").remove();
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
    // Initialize Choices for service_id
    const serviceElement = document.getElementById('service_id');
    let serviceChoices; // Declare variable to store Choices instance

    if (serviceElement) {
        serviceChoices = new Choices(serviceElement, {
            searchEnabled: true,
            itemSelectText: '',
        });
    }



    // Handle form submission for adding a service
    $('.add_service2').off().on('submit', function (e) {
        e.preventDefault();

        var formdatas = new FormData($('.add_service2')[0]);
        var title = $('.service_name').val();
        var cost = $('.service_cost2').val();

        if (title === "") {
            show_notification('error', 'Please enter a service name.');
            return false;
        }

        if (cost === "") {
            show_notification('error', 'Please enter a service cost.');
            return false;
        }

        $('#global-loader').show();
        before_submit();

        $.ajax({
            type: "POST",
            url: "{{ url('add_service2') }}",
            data: formdatas,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#global-loader').hide();
                after_submit();

                if (data.status === 1) {
                    show_notification('success', 'Service added successfully!');

                    // Add the new service to the Choices.js select box
                    if (serviceChoices) {
                        serviceChoices.setChoices(
                            [
                                {
                                    value: data.service.id,
                                    label: data.service.service_name,
                                    selected: true, // Mark as selected
                                },
                            ],
                            'value',
                            'label',
                            true // Reset the Choices instance
                        );
                    }

                    // Hide the modal and reset the form
                    $('#add_service_modal2').modal('hide');
                    $(".add_service2")[0].reset();
                } else {
                    show_notification('error', 'Failed to add the service.');
                }
            },
            error: function (xhr, status, error) {
                $('#global-loader').hide();
                after_submit();
                show_notification('error', 'An error occurred. Please try again.');
                console.error(error);
            }
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    // Initialize Choices for customer_id
    const customerElement = document.getElementById('customer_id');
    let customerChoices;

    if (customerElement) {
        customerChoices = new Choices(customerElement, {
            searchEnabled: true,
            itemSelectText: '',
        });
    }

    // Handle customer form submission
    $('.add_customer').off().on('submit', function (e) {
        e.preventDefault();

        var formdatas = new FormData($('.add_customer')[0]);
        var title = $('.customer_name').val();
        var number = $('.customer_number').val();

        if (title === "") {
            show_notification('error', '<?php echo trans('messages.add_customer_name_lang', [], session('locale')); ?>');
            return false;
        }

        if (number === "") {
            show_notification('error', '<?php echo trans('messages.add_customer_phone_lang', [], session('locale')); ?>');
            return false;
        }

        $('#global-loader').show();
        before_submit();

        $.ajax({
            type: "POST",
            url: "{{ url('add_customer2') }}",
            data: formdatas,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#global-loader').hide();
                after_submit();

                if (data.status == 3) {
                    show_notification('error', '<?php echo trans('messages.customer_number_or_contact_exist_lang', [], session('locale')); ?>');
                    return false;
                } else if (data.status == 1) {
                    show_notification('success', '<?php echo trans('messages.data_add_success_lang', [], session('locale')); ?>');
                    $('#add_customer_modal').modal('hide');
                    $(".add_customer")[0].reset();

                    // Add the new customer to the Choices.js select box
                    if (customerChoices) {
                        customerChoices.setChoices(
                            [
                                {
                                    value: data.customer_id,
                                    label: data.customer_name, // Adjust this based on your API response
                                    selected: true, // Automatically select the newly added customer
                                },
                            ],
                            'value',
                            'label',
                            true // Reset Choices instance
                        );
                    }

                    return false;
                }
            },
            error: function (data) {
                $('#global-loader').hide();
                after_submit();
                show_notification('error', '<?php echo trans('messages.data_add_failed_lang', [], session('locale')); ?>');
                console.log(data);
                return false;
            }
        });
    });
});





</script>
