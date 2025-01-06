<script>
    $(document).ready(function() {

        $('#all_subscription_exp').DataTable({
            "sAjaxSource": "{{ url('show_subscription_exp') }}",
            "bFilter": true,
            "pagingType": "numbers",
            "ordering": true,
            "order": [[7, "desc"]],
        });

        $('#add_renewl_modal').on('submit', function(e) {
            e.preventDefault();

            var formdatas = new FormData($('.add_renewl')[0]);
            var date = $('.new_renewl_date').val();

            // Check if the service or student is not selected
            if (date === "") {
                show_notification('error', @lang('messages.add_new_renewl_date_lang'));
                return false;
            }

            // Show loader before submitting
            $('#global-loader').show();
            before_submit(); // Call any pre-submit actions if needed

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: "{{ url('add_renewl') }}",
                data: formdatas,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                },
                success: function(data) {
                    $('#global-loader').hide();
                    after_submit();

                    if (data.status == 1) {
                        show_notification('success', @lang('messages.data_add_success_lang'));
                        $('#add_renewl_modal').modal('hide');
                        $('#all_subscription_exp').DataTable().ajax.reload();
                    } else {
                        show_notification('error', data.message || @lang('messages.data_add_failed_lang'));
                        $('#all_subscription_exp').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    $('#global-loader').hide();
                    after_submit();
                    show_notification('error', @lang('messages.data_add_failed_lang'));
                }
            });
        });

        $('#add_renewl_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var value1 = button.data('value1'); // Extract value1
            var value2 = button.data('value2'); // Extract value2
            var value3 = button.data('value3'); // Extract value3
            var value4 = button.data('value4'); // Extract value4

            // Populate the modal with the extracted values
            var modal = $(this);
            modal.find('#service_name').val(value1);
            modal.find('#renewl_id').val(value4);
            modal.find('#renewl_date').val(value3);
            modal.find('#renewl_cost').val(value2);
        });

    });
    </script>
