<script type="text/javascript">

    $(document).ready(function() {



        let courseId = $('#course_id').val();

// Load course profile data with the actual course ID
loadcourseProfileData(courseId);

function loadcourseProfileData(courseId) {
    $.ajax({
        url: "{{ url('course_profile_data') }}",  // Adjust URL as needed
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
            course_id: courseId  // Pass the course ID
        },
        success: function(response) {
            // Check if response is valid before using it
            if (response) {
                $('#total_enrol').text(response.total_enrol || 0); // Total enrollments
                $('#total_income').text(response.total_income || 0); // Total income
            } else {
                console.warn('Unexpected response format:', response);
            }

            // Clear the current list items
            $('.list-group').empty();

            // Ensure offers exist in the response
            if (response.offers && response.offers.length) {
                response.offers.forEach(function(offer) {
                    // Handle undefined fields gracefully
                    const courses = offer.courses ? offer.courses.join(', ') : 'No courses';
                    const offerName = offer.offer_name || 'Unnamed Offer';
                    const offerDiscount = offer.offer_discount || 'No discount';
                    const start_date= offer.start_date || 'null'
                     const end_date= offer.end_date || 'null'

                    // Append each offer to the list
                    $('.list-group').append(`
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <img src="{{ asset('images/favicon.ico') }}" alt="" class="img-thumbnail rounded-circle"> <!-- Adjust based on your image field -->
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">${offerName}</h5>
                                        <p class="font-size-13 text-muted mb-0">Courses: ${courses}</p>
                                        <p class="font-size-13 text-muted mb-0">Discount: ${offerDiscount}%</p>
                                        <p class="font-size-13 text-muted mb-0">Start Date: ${start_date}</p>
                                        <p class="font-size-13 text-muted mb-0">End Date: ${end_date}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    `);
                });
            } else {
                console.warn('No offers found for this course.');
            }
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error('AJAX Error:', status, error);
            alert('An error occurred while loading course data. Please try again.');
        }
    });
}

        $('#all_enroll_student').DataTable({
            destroy: true, // Reset the table on initialization
            "processing": true, // Show a processing indicator
            "serverSide": true, // Enable server-side processing
            "pagingType": 'numbers', // Pagination style
            "ordering": true, // Enable column ordering
            "bFilter": true, // Enable filtering
            "ajax": {
                "url": "{{ url('show_enroll_student') }}", // Use Blade syntax for Laravel URL
                "type": "GET",
                "data": function(d) {
                    d.course_id = $('.course_id').val(); // Send the selected course_id in the request
                }
            }
        });





        $('#add_course_modal').on('hidden.bs.modal', function() {
            $(".add_course")[0].reset();
            $('.course_id').val('');


        });
        $('#all_course').DataTable({
             "sAjaxSource": "{{ url('show_course') }}",
             "bFilter": true,
             'pagingType': 'numbers',
             "ordering": true,
         });

        $('.add_course').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_course')[0]);
            var title=$('.course_name').val();
            var number=$('.teacher_id').val();
            var id=$('.course_id').val();


            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_course_name_lang',[],session('locale')); ?>'); return false;
                }

                if(number=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_teacher_lang',[],session('locale')); ?>'); return false;
                }
                $('#global-loader').show();
                before_submit();
                var str = $(".add_course").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_course') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#global-loader').hide();
                        after_submit();
                        if(data.status==1)
                        {
                            show_notification('success','<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                            $('#add_course_modal').modal('hide');
                            $('#all_course').DataTable().ajax.reload();
                            return false;
                        }

                    },
                    error: function(data)
                    {
                        $('#global-loader').hide();
                        after_submit();
                        show_notification('error','<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                        $('#all_course').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
            else if(id==''){


                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_course_name_lang',[],session('locale')); ?>'); return false;

                }

                if(number=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_teacher_lang',[],session('locale')); ?>'); return false;
                }
                $('#global-loader').show();
                before_submit();
                var str = $(".add_course").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_course') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#global-loader').hide();
                        after_submit();
                        if (data.status == 3) {
                        show_notification('error', '<?php echo trans('messages.course_number_or_contact_exist_lang', [], session('locale')); ?>');
                        return false;
                        }

                        else if(data.status==1)
                        {
                            $('#all_course').DataTable().ajax.reload();
                            show_notification('success','<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                            $('#add_course_modal').modal('hide');
                            $(".add_course")[0].reset();

                            return false;
                        }
                    },
                    error: function(data)
                    {
                        $('#global-loader').hide();
                        after_submit();
                        show_notification('error','<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                        $('#all_course').DataTable().ajax.reload();
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
            url : "{{ url('edit_course') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                $('#global-loader').hide();
                after_submit();
                if(fetch!=""){
                    // Define a variable for the image path

                    $(".course_id").val(fetch.course_id);
                    $(".course_name").val(fetch.course_name);
                    $(".teacher_id").val(fetch.teacher_id);
                    $(".start_date_date").val(fetch.start_date);
                    $(".end_date").val(fetch.end_date);
                    $(".start_time").val(fetch.start_time);
                    $(".end_time").val(fetch.end_time);
                    $(".notes").val(fetch.notes);
                    $(".course_price").val(fetch.course_price);

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
                    url: "{{ url('delete_course') }}",
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
                        $('#all_course').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }


    function del_new(id) {
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
                    url: "{{ url('delete_new') }}",
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
                        $('#all_enroll_student').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }









 </script>
