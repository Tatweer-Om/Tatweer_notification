<script type="text/javascript">

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('.sms_status').on('change', function () {
        const smsStatus = $(this).val();
        $('#global-loader').show();
        $.ajax({
            url:  "{{ url('get_sms_status') }}",
            method: "POST",
            data: { sms_status: smsStatus,_token: csrfToken },
            success: function (data) {
                $('#global-loader').hide();
                if (data.status === 1) {
                    $(".sms_area").val(data.sms);
                } else {
                    $(".sms_area").val('');
                }
            },
            error: function (data) {
                $('#global-loader').hide();
                show_notification('error',  '<?php echo trans('messages.get_data_failed_lang',[],session('locale')); ?>');
                console.log(data);
            }
        });
    });

    $(".customer_name").click(function () {
        $(".sms_area").val((index, value) => value + '{customer_name}');
    });

    $(".customer_number").click(function () {
        $(".sms_area").val((index, value) => value + '{customer_number}');
    });

    $(".purchase_date").click(function () {
        $(".sms_area").val((index, value) => value + '{purchase_date}');
    });
    $(".renewl_date").click(function () {
        $(".sms_area").val((index, value) => value + '{renewl_date}');
    });
    $(".service_name").click(function () {
        $(".sms_area").val((index, value) => value + '{service_name}');
    });

    $(".expiry_date").click(function () {
        $(".sms_area").val((index, value) => value + '{expiry_date}');
    });
    $(".company").click(function () {
        $(".sms_area").val((index, value) => value + '{company}');
    });
    $(".renewl_cost").click(function () {
        $(".sms_area").val((index, value) => value + '{renewl_cost}');
    });
    $(".url").click(function () {
        $(".sms_area").val((index, value) => value + '{url}');
    });


    $(".status").click(function () {
        $(".sms_area").val((index, value) => value + '{status}');
    });


    $(".notes").click(function () {
        $(".sms_area").val((index, value) => value + '{notes}');
    });



    $(document).ready(function(){
        // Set timeout to hide the alert after 5 seconds
        setTimeout(function() {
            $("#success-alert").fadeOut("slow", function(){
                $(this).remove(); // Optional: Remove the alert from the DOM after fading out
            });
        }, 3000); // 5000 milliseconds = 5 seconds
    });

</script>
