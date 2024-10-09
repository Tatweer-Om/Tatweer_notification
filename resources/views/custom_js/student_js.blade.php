<script type="text/javascript">

    $(document).ready(function() {
        $('#add_student_modal').on('hidden.bs.modal', function() {
            $(".add_student")[0].reset();
            $('.student_id').val('');


        });
        $('#all_student').DataTable({
             "sAjaxSource": "{{ url('show_student') }}",
             "bFilter": true,
             'pagingType': 'numbers',
             "ordering": true,
         });

         $('#all_course_student').DataTable({
            destroy: true, // Reset the table on initialization
            "processing": true, // Show a processing indicator
            "serverSide": true, // Enable server-side processing
            "pagingType": 'numbers', // Pagination style
            "ordering": true, // Enable column ordering
            "bFilter": true, // Enable filtering
            "ajax": {
                "url": "{{ url('show_student_courses') }}", // Use Blade syntax for Laravel URL
                "type": "GET",
                "data": function(d) {
                    d.student_id = $('.student_id').val(); // Send the selected course_id in the request
                }
            }
        });

        $('.add_student').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_student')[0]);
            var title=$('.student_name').val();
            var number=$('.student_number').val();
            var id=$('.student_id').val();



            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_student_name_lang',[],session('locale')); ?>'); return false;
                }

                if(number=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_student_phone_lang',[],session('locale')); ?>'); return false;
                }
                $('#global-loader').show();
                before_submit();
                var str = $(".add_student").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_student') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#global-loader').hide();
                        after_submit();
                        if(data.status==1)
                        {
                            show_notification('success','<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                            $('#add_student_modal').modal('hide');
                            $('#all_student').DataTable().ajax.reload();
                            return false;
                        }

                    },
                    error: function(data)
                    {
                        $('#global-loader').hide();
                        after_submit();
                        show_notification('error','<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                        $('#all_student').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
            else if(id==''){


                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_student_name_lang',[],session('locale')); ?>'); return false;

                }

                if(number=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_student_phone_lang',[],session('locale')); ?>'); return false;
                }
                $('#global-loader').show();
                before_submit();
                var str = $(".add_student").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_student') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#global-loader').hide();
                        after_submit();
                        if (data.status == 3) {
                        show_notification('error', '<?php echo trans('messages.student_number_or_contact_exist_lang', [], session('locale')); ?>');
                        return false;
                        }

                        else if(data.status==1)
                        {
                            $('#all_student').DataTable().ajax.reload();
                            show_notification('success','<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                            $('#add_student_modal').modal('hide');
                            $(".add_student")[0].reset();

                            return false;
                        }
                    },
                    error: function(data)
                    {
                        $('#global-loader').hide();
                        after_submit();
                        show_notification('error','<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                        $('#all_student').DataTable().ajax.reload();
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
            url : "{{ url('edit_student') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                $('#global-loader').hide();
                after_submit();
                if(fetch!=""){
                    // Define a variable for the image path

                    $(".student_id").val(fetch.student_id);
                    $(".first_name").val(fetch.first_name);
                    $(".second_name").val(fetch.second_name);
                    $(".last_name").val(fetch.last_name);
                    $(".student_email").val(fetch.student_email);
                    $(".dob").val(fetch.dob);
                    $(".notes").val(fetch.notes);
                    $(".civil_number").val(fetch.civil_number);
                    $(".student_number").val(fetch.student_number);
                    if (fetch.gender == 1) {
                        $("#male").prop("checked", true);
                    }
                    else
                    {
                        $("#female").prop("checked", true);
                    }


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
                    url: "{{ url('delete_student') }}",
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
                        $('#all_student').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }






 </script>
