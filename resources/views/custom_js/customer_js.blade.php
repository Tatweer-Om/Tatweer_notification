<script type="text/javascript">

    $(document).ready(function() {
        $('#add_customer_modal').on('hidden.bs.modal', function() {
            $(".add_customer")[0].reset();
            $('.customer_id').val('');


        });
        $('#all_customer').DataTable({
             "sAjaxSource": "{{ url('show_customer') }}",
             "bFilter": true,
             'pagingType': 'numbers',
             "ordering": true,
         });

        $('.add_customer').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_customer')[0]);
            var title=$('.customer_name').val();
            var number=$('.customer_number').val();

            var id=$('.customer_id').val();


            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_customer_name_lang',[],session('locale')); ?>'); return false;
                }

                if(number=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_customer_phone_lang',[],session('locale')); ?>'); return false;
                }

                $('#global-loader').show();
                before_submit();
                var str = $(".add_customer").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_customer') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#global-loader').hide();
                        after_submit();
                        if(data.status==1)
                        {
                            show_notification('success','<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                            $('#add_customer_modal').modal('hide');
                            $('#all_customer').DataTable().ajax.reload();
                            return false;
                        }

                    },
                    error: function(data)
                    {
                        $('#global-loader').hide();
                        after_submit();
                        show_notification('error','<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                        $('#all_customer').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
            else if(id==''){


                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_customer_name_lang',[],session('locale')); ?>'); return false;

                }

                if(number=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_customer_phone_lang',[],session('locale')); ?>'); return false;
                }

                $('#global-loader').show();
                before_submit();
                var str = $(".add_customer").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_customer') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#global-loader').hide();
                        after_submit();
                        if (data.status == 3) {
                        show_notification('error', '<?php echo trans('messages.customer_number_or_contact_exist_lang', [], session('locale')); ?>');
                        return false;
                        }

                        else if(data.status==1)
                        {
                            $('#all_customer').DataTable().ajax.reload();
                            show_notification('success','<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                            $('#add_customer_modal').modal('hide');
                            $(".add_customer")[0].reset();

                            return false;
                        }
                    },
                    error: function(data)
                    {
                        $('#global-loader').hide();
                        after_submit();
                        show_notification('error','<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                        $('#all_customer').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });

            }

        });
    });
    function edit(id){
        $('#global-loader').show();
        before_submit();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax ({
            dataType:'JSON',
            url : "{{ url('edit_customer') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                $('#global-loader').hide();
                after_submit();
                if(fetch!=""){
                    // Define a variable for the image path

                    $(".customer_id").val(fetch.customer_id);
                    $(".customer_name").val(fetch.customer_name);
                    $(".customer_email").val(fetch.customer_email);
                    $(".address").val(fetch.address)
                    $(".customer_number").val(fetch.customer_number);
                    $(".modal-title").html('<?php echo trans('messages.update_lang',[],session('locale')); ?>');

                }
            },
            error: function(html)
            {
                $('#global-loader').hide();
                after_submit();
                show_notification('error','<?php echo trans('messages.edit_failed_lang',[],session('locale')); ?>');
                console.log(html);
                return false;
            }
        });
    }

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
                    url: "{{ url('delete_customer') }}",
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
                        $('#all_customer').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }







 </script>
