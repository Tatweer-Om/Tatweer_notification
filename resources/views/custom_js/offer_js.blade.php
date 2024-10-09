<script type="text/javascript">
 var choicesInstance =new Choices("#choices-multiple-remove-button",{removeItemButton:!0})
    $(document).ready(function() {


        $('#add_offer_modal').on('hidden.bs.modal', function() {
            $(".add_offer")[0].reset();
            $('.offer_id').val('');


        });
        $('#all_offer').DataTable({
             "sAjaxSource": "{{ url('show_offer') }}",
             "bFilter": true,
             'pagingType': 'numbers',
             "ordering": true,
         });

        $('.add_offer').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_offer')[0]);
            var title=$('.offer_name').val();
            var number=$('.course_id').val();
            var id=$('.offer_id').val();

            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_offer_name_lang',[],session('locale')); ?>'); return false;
                }

                if(number=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_course_lang',[],session('locale')); ?>'); return false;
                }
                $('#global-loader').show();
                before_submit();
                var str = $(".add_offer").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_offer') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#global-loader').hide();
                        after_submit();
                        if(data.status==1)
                        {
                            show_notification('success','<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                            $('#add_offer_modal').modal('hide');
                            $('#all_offer').DataTable().ajax.reload();
                            return false;
                        }

                    },
                    error: function(data)
                    {
                        $('#global-loader').hide();
                        after_submit();
                        show_notification('error','<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                        $('#all_offer').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
            else if(id==''){


                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_offer_name_lang',[],session('locale')); ?>'); return false;

                }

                if(number=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_course_lang',[],session('locale')); ?>'); return false;
                }
                $('#global-loader').show();
                before_submit();
                var str = $(".add_offer").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_offer') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#global-loader').hide();
                        after_submit();
                        if (data.status == 3) {
                        show_notification('error', '<?php echo trans('messages.offer_number_or_contact_exist_lang', [], session('locale')); ?>');
                        return false;
                        }

                        else if(data.status==1)
                        {
                            $('#all_offer').DataTable().ajax.reload();
                            show_notification('success','<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                            $('#add_offer_modal').modal('hide');
                            $(".add_offer")[0].reset();

                            return false;
                        }
                    },
                    error: function(data)
                    {
                        $('#global-loader').hide();
                        after_submit();
                        show_notification('error','<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                        $('#all_offer').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });

            }

        });


    });




function edit(id) {
    $('#global-loader').show();
    before_submit();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        dataType: 'JSON',
        url: "{{ url('edit_offer') }}",
        method: "POST",
        data: { id: id, _token: csrfToken },
        success: function(fetch) {
            $('#global-loader').hide();
            after_submit();

            if (fetch != "") {
                // Set the offer details
                $(".offer_id").val(fetch.offer_id);
                $(".offer_name").val(fetch.offer_name);
                $(".start_date").val(fetch.start_date);
                $(".end_date").val(fetch.end_date);
                $(".notes").val(fetch.notes);
                $(".offer_discount").val(fetch.offer_discount);

                // Fully destroy the existing Choices instance if it exists and is initialized
                // if (typeof choicesInstance !== 'undefined' && choicesInstance) {
                    choicesInstance.destroy();  // Destroy Choices instance safely
                    choicesInstance = null;     // Reset the instance variable
                // }

                // Now reset the select box with new options
                $("#choices-multiple-remove-button").html(fetch.course_id);  // Replace HTML with new options

                // Reinitialize Choices for the select box
                choicesInstance = new Choices("#choices-multiple-remove-button", { removeItemButton: true });

                // Set the modal title
                $(".modal-title").html('<?php echo trans('messages.update_lang', [], session('locale')); ?>');
            }
        },
        error: function(html) {
            $('#global-loader').hide();
            after_submit();
            show_notification('error', '<?php echo trans('messages.edit_failed_lang', [], session('locale')); ?>');
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
                    url: "{{ url('delete_offer') }}",
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
                        $('#all_offer').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }





     // Function to load offer profile data via AJAX


     // Example: Call the function when the page is ready or a offer is selected
//      let offerId = $('#offer_id').val();

//      loadofferProfileData(offerId);

//      function loadofferProfileData(offerId) {
//      $.ajax({
//          url: "{{ url('offer_profile_data') }}",
//          method: 'POST',
//          data: {
//              _token: $('meta[name="csrf-token"]').attr('content'),
//              offer_id: offerId
//          },
//          success: function(response) {
//              let bookingsTable = $('#all_profile_docs_1 tbody');
//              let upcomingTable = $('#all_profile_docs_2 tbody');
//              let currentBookings = response.current_bookings;
//              let bookingList = $('#current_bookings');
//              $('#booking_count').text(response.total_bookings || 0);
//              $('#total_payment').text(response.total_amount || 0);
//              $('#total_panelty').text(response.total_panelty || 0);
//              $('#up_booking').text(response.upcoming_bookings_count || 0);

//              bookingsTable.empty();
//              upcomingTable.empty();
//              bookingList.empty();


//              // Loop through bookings and append to the table
//              $.each(response.bookings, function(index, booking) {
//                  let bill = Array.isArray(booking.bills) && booking.bills.length > 0 ? booking.bills[0] : null;
//                  let bookingRow = `
//                      <tr>
//                          <td style="text-align:center; width:5%;">${index + 1}</td>
//                          <td style="text-align:center;width:25%;">
//                              <span>${'{{ trans("messages.dress_name_lang") }}: '}${booking.dress ? booking.dress.dress_name : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.brand_name_lang") }}: '}${booking.dress && booking.dress.brand ? booking.dress.brand.brand_name : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.category_name_lang") }}: '}${booking.dress && booking.dress.category ? booking.dress.category.category_name : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.color_lang") }}: '}${booking.dress && booking.dress.color ? booking.dress.color.color_name : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.size_lang") }}: '}${booking.dress && booking.dress.size ? booking.dress.size.size_name : '{{ trans("messages.na_lang") }}'}</span>
//                          </td>
//                          <td style="text-align:center; width:25%;">
//                              <span>${'{{ trans("messages.booking_no_lang") }}: '}${booking.booking_no || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.booking_date_lang") }}: '}${booking.booking_date || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.return_date_lang") }}: '}${booking.return_date || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.rent_date_lang") }}: '}${booking.rent_date || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.duration_lang") }}: '}${booking.duration || '{{ trans("messages.na_lang") }}'} days</span>
//                          </td>
//                          <td style="text-align:center; width:25%;">
//                              <span>${'{{ trans("messages.rent_price_lang") }}: '}${bill ? bill.total_price : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.discount_lang") }}: '}${bill ? bill.total_discount : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.total_penalty_lang") }}: '}${bill ? bill.total_penalty : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.grand_total_lang") }}: '}${bill ? bill.grand_total : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.remaining_lang") }}: '}${bill ? bill.total_remaining : '{{ trans("messages.na_lang") }}'}</span>
//                          </td>
//                          <td style="text-align:center; width:20%;">
//                              <span>${'{{ trans("messages.added_by_lang") }}: '}${booking.added_by || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.created_at_lang") }}: '}${booking.created_at ? get_date_only(booking.created_at) : '{{ trans("messages.na_lang") }}'}</span>
//                          </td>
//                      </tr>
//                  `;
//                  bookingsTable.append(bookingRow);
//              });

//              $('#all_profile_docs_1').DataTable({
//          destroy: true,  // Allows re-initializing table multiple times
//          responsive: true
//      });

//              $.each(response.up_bookings, function(index, booking) {
//                  let bill = Array.isArray(booking.bills) && booking.bills.length > 0 ? booking.bills[0] : null;

//                  let upcomingRow = `
//                      <tr>
//                          <td style="text-align:center;">${index + 1}</td>
//                          <td style="text-align:center;width:25%;">
//                              <span>${'{{ trans("messages.dress_name_lang") }}: '}${booking.dress ? booking.dress.dress_name : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.brand_name_lang") }}: '}${booking.dress && booking.dress.brand ? booking.dress.brand.brand_name : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.category_name_lang") }}: '}${booking.dress && booking.dress.category ? booking.dress.category.category_name : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.color_lang") }}: '}${booking.dress && booking.dress.color ? booking.dress.color.color_name : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.size_lang") }}: '}${booking.dress && booking.dress.size ? booking.dress.size.size_name : '{{ trans("messages.na_lang") }}'}</span>
//                          </td>
//                          <td style="text-align:center; width:25%;">
//                              <span>${'{{ trans("messages.booking_no_lang") }}: '}${booking.booking_no || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.booking_date_lang") }}: '}${booking.booking_date || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.return_date_lang") }}: '}${booking.return_date || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.rent_date_lang") }}: '}${booking.rent_date || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.duration_lang") }}: '}${booking.duration || '{{ trans("messages.na_lang") }}'} days</span>
//                          </td>
//                          <td style="text-align:center; width:25%;">
//                              <span>${'{{ trans("messages.rent_price_lang") }}: '}${bill ? bill.total_price : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.discount_lang") }}: '}${bill ? bill.total_discount : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.total_penalty_lang") }}: '}${bill ? bill.total_penalty : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.grand_total_lang") }}: '}${bill ? bill.grand_total : '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.remaining_lang") }}: '}${bill ? bill.total_remaining : '{{ trans("messages.na_lang") }}'}</span>
//                          </td>
//                          <td style="text-align:center; width:20%;">
//                              <span>${'{{ trans("messages.added_by_lang") }}: '}${booking.added_by || '{{ trans("messages.na_lang") }}'}</span><br>
//                              <span>${'{{ trans("messages.created_at_lang") }}: '}${booking.created_at ? get_date_only(booking.created_at) : '{{ trans("messages.na_lang") }}'}</span>
//                          </td>
//                      </tr>
//                  `;
//                  upcomingTable.append(upcomingRow);
//              });

//              if (currentBookings.length > 0) {
//                  $.each(currentBookings, function(index, booking) {
//                      let bookingItem = `
//                          <a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
//                              <div class="d-flex align-items-center">
//                                  <div class="flex-grow-1 overflow-hidden">
//                                      <h3 class="font-size-20 text-truncate">${booking.dress.dress_name || 'N/A'}</h3>
//                                        <p class="text-danger">${'{{ trans("messages.duration_lang") }}: '} ${booking.duration || 'N/A'} days  </p>
//                                      <p class="text-danger">${'{{ trans("messages.rent_date_lang") }}: '} ${booking.booking_date || 'N/A'}  </p>
//                                        <p class="text-danger">${'{{ trans("messages.return_date_lang") }}: '} ${booking.return_date || 'N/A'}  </p>
//                                  </div>
//                                  <div class="fs-1">
//                                      <i class="mdi mdi-calendar"></i>
//                                  </div>
//                              </div>
//                          </a>
//                      `;
//                      bookingList.append(bookingItem);
//                  });
//              } else {
//                  bookingList.append('<a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">{{ trans("messages.no_booking_lang") }}</a>');
//              }
//          },

//          error: function(xhr) {
//              console.error('Error loading offer profile data: ', xhr.responseText);
//          }

//      });
//  }



 var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    // Handle form submission
    document.querySelector('form.add_offer').addEventListener('submit', function(e) {
        // Prevent form submission until the signature is captured
        if (signaturePad.isEmpty()) {
            alert('Please provide a signature.');
            e.preventDefault();
        } else {
            // Convert signature to base64 and store in hidden input
            var signatureData = signaturePad.toDataURL('image/png');
            document.getElementById('signature').value = signatureData;
        }
    });

    // Clear the signature
    document.getElementById('clear-signature').addEventListener('click', function(e) {
        e.preventDefault();
        signaturePad.clear();
    });





 </script>
