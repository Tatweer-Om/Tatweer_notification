<script>

   $(document).ready(function() {

    $('#all_subscription').DataTable({
    "sAjaxSource": "{{ url('show_subscription') }}",
    "bFilter": true,
    "pagingType": "numbers",
    "ordering": true,
    "order": [[3, "asc"]],
});






$('#add_renewl_modal').off().on('submit', function(e) {
    e.preventDefault();

    // Prepare form data
    var formdatas = new FormData($('.add_renewl')[0]);
    var date = $('.new_renewl_date').val();


    // Check if the service or student is not selected
    if (date === "") {
        show_notification('error', '<?php echo trans('messages.add_new_renewl_date_lang', [], session('locale')); ?>');
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
            // Hide loader and call post-submit actions
            $('#global-loader').hide();
            after_submit();

            if (data.status == 1) {
                show_notification('success', '<?php echo trans('messages.data_add_success_lang', [], session('locale')); ?>');
                $('#add_renewl_modal').modal('hide');

                $('#all_subscription').DataTable().ajax.reload();



            } else {
                // Handle other statuses or errors in the response
                show_notification('error', data.message || '<?php echo trans('messages.data_add_failed_lang', [], session('locale')); ?>');
                $('#all_subscription').DataTable().ajax.reload();

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

});



$('#add_renewl_modal').on('show.bs.modal', function (event) {
    // Get data from the button that triggered the modal
    var button = $(event.relatedTarget);  // Button that triggered the modal
    var value1 = button.data('value1');  // Extract the value1
    var value3 = button.data('value3');  // Extract the value1
    var value4 = button.data('value4');  // Extract the value1
    var value2 = button.data('value2');  // Extract the value2

    // Populate the modal with the extracted values
    var modal = $(this);
    modal.find('#service_name').val(value1);  // Set Value 1
    modal.find('#renewl_id').val(value4);  // Set Value 1

    modal.find('#renewl_date').val(value3);  // Set Value 1

    modal.find('#renewl_cost').val(value2);  // Set Value 2
});

});
function del(id) {
        Swal.fire({
            title:  '<?php echo trans('messages.sure_lang',[],session('locale')); ?>',
            text:  '<?php echo trans('messages.delete_lang',[],session('locale')); ?>',
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: '<?php echo trans('messages.delete_it_lang',[],session('locale')); ?>',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1
        }).then(function (result) {
            if (result.value) {
                $('#global-loader').show();
                before_submit();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('delete_subscription') }}",
                    type: 'POST',
                    data: {id: id,_token: csrfToken},
                    error: function () {
                        $('#global-loader').hide();
                        after_submit();
                        show_notification('error', '<?php echo trans('messages.delete_failed_lang',[],session('locale')); ?>');
                    },
                    success: function (data) {
                        $('#global-loader').hide();
                        after_submit();
                        $('#all_subscription').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }












</script>
