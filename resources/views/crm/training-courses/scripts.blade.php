{{--@push('js')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            // Edit--}}
{{--            $('.edit-row').on('click', function() {--}}
{{--                let row = $(this).closest('tr');--}}
{{--                row.find('.view').addClass('d-none');--}}
{{--                row.find('.edit').removeClass('d-none');--}}
{{--                row.find('.edit-row').addClass('d-none');--}}
{{--                row.find('.save-row').removeClass('d-none');--}}
{{--            });--}}

{{--            // Save--}}
{{--            $('.save-row').on('click', function(e) {--}}
{{--                e.preventDefault();--}}
{{--                let row = $(this).closest('tr');--}}
{{--                // let id = row.data('id');--}}
{{--                let route_url = $(this).closest('form');--}}
{{--                let data = {--}}
{{--                    _token: '{{ csrf_token() }}',--}}
{{--                    cohort_id: '{{ $training_course->id }}',--}}
{{--                };--}}

{{--                // Collect all inputs--}}
{{--                row.find('input, select').each(function() {--}}
{{--                    data[$(this).attr('name')] = $(this).val();--}}
{{--                });--}}

{{--                $.ajax({--}}
{{--                    // url: '/crm/training-courses/' + id,--}}
{{--                    url: route_url.attr('action'),--}}
{{--                    method: 'POST',--}}
{{--                    data: data,--}}
{{--                    success: function(res) {--}}
{{--                        // row.find('.edit').addClass('d-none');--}}
{{--                        // row.find('.view').each(function() {--}}
{{--                        //     let name = $(this).siblings('input, select').attr('name');--}}
{{--                        //     $(this).text(data[name]).removeClass('d-none');--}}
{{--                        // });--}}

{{--                        // row.find('.edit-row').removeClass('d-none');--}}
{{--                        // row.find('.save-row').addClass('d-none');--}}
{{--                        // window.location.reload();--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}

{{--            // Delete--}}
{{--            $('.delete-row').on('click', function() {--}}
{{--                if (!confirm("Are you sure to delete?")) return;--}}
{{--                let row = $(this).closest('tr');--}}
{{--                let id = row.data('id');--}}

{{--                $.ajax({--}}
{{--                    url: '/crm/training-courses/' + id,--}}
{{--                    method: 'DELETE',--}}
{{--                    data: {--}}
{{--                        _token: '{{ csrf_token() }}',--}}
{{--                        cohort_id: '{{ $training_course->id }}',--}}
{{--                    },--}}
{{--                    success: function() {--}}
{{--                        row.remove();--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            var cohort_id_pdf = '{{ $training_course->id }}';--}}
{{--            var order_detail_id = $('input[name="order_detail_id"]').val();--}}


{{--            $('input[name="select_all"]').on('change', function() {--}}
{{--                var checked = $(this).is(':checked');--}}
{{--                $('input[name="learners"]').prop('checked', checked);--}}
{{--                if (checked) {--}}
{{--                    $(this).addClass('selectall');--}}
{{--                } else {--}}
{{--                    $(this).removeClass('selectall');--}}
{{--                }--}}
{{--            });--}}
{{--            $('input[name="learners"]').on('change', function() {--}}
{{--                var allChecked = $('input[name="learners"]').length === $('input[name="learners"]:checked')--}}
{{--                    .length;--}}
{{--                var selectAll = $('input[name="select_all"]');--}}
{{--                selectAll.prop('checked', allChecked);--}}
{{--                if (allChecked) {--}}
{{--                    selectAll.addClass('selectall');--}}
{{--                } else {--}}
{{--                    selectAll.removeClass('selectall');--}}
{{--                }--}}
{{--            });--}}
{{--            $('.generateChecklist').click(function() {--}}
{{--                var printList = $('#print_list').val();--}}
{{--                if (!printList) {--}}
{{--                    alert('Please select a list type.');--}}
{{--                    return;--}}
{{--                }--}}
{{--                window.open(`/crm/training-courses/generate-checklist/${cohort_id_pdf}?type=` +--}}
{{--                    encodeURIComponent(--}}
{{--                        printList), '_blank');--}}
{{--            });--}}
{{--            // $('#trainer-select').on('change', function() {--}}
{{--            //     var trainerId = $(this).val();--}}
{{--            //     var courseId = '{{ $training_course->id }}';--}}

{{--            //     if (trainerId) {--}}
{{--            //         $.ajax({--}}
{{--            //             url: '{{ route('crm.update_trainers') }}',--}}
{{--            //             type: 'POST',--}}
{{--            //             data: {--}}
{{--            //                 trainer_id: trainerId,--}}
{{--            //                 course_id: courseId,--}}
{{--            //                 _token: '{{ csrf_token() }}',--}}
{{--            //             },--}}
{{--            //             success: function(response) {--}}
{{--            //                 // Update the <tr> with the new trainer info, or reload part of the table--}}
{{--            //                 alert('Trainer added successfully!');--}}
{{--            //                 // Optionally, update the row with response data--}}
{{--            //             },--}}
{{--            //             error: function(xhr) {--}}
{{--            //                 alert('Error adding trainer');--}}
{{--            //             }--}}
{{--            //         });--}}
{{--            //     }--}}
{{--            // });--}}
{{--            let typingTimer;--}}
{{--            let userExists = false;--}}
{{--            let selectedUserId = null;--}}
{{--            $('#user_search_input').on('keyup', function() {--}}
{{--                clearTimeout(typingTimer);--}}
{{--                const query = $(this).val().trim();--}}
{{--                if (query.length < 2) {--}}
{{--                    $('#user_search_results').html('');--}}
{{--                    $('#create_new_user_btn').addClass('event_none');--}}
{{--                    selectedUserId = null;--}}
{{--                    return;--}}
{{--                }--}}
{{--                typingTimer = setTimeout(function() {--}}
{{--                    $.ajax({--}}
{{--                        url: '{{ route('crm.training-courses.find-user') }}',--}}
{{--                        method: 'GET',--}}
{{--                        data: {--}}
{{--                            q: query,--}}
{{--                            cohortId: '{{ $training_course->id }}'--}}
{{--                        },--}}
{{--                        success: function(res) {--}}
{{--                            if (res.length > 0) {--}}
{{--                                let html = '<div class="dropdown-menu show">';--}}
{{--                                res.forEach(function(user) {--}}
{{--                                    html +=--}}
{{--                                        `<button class='dropdown-item user-result-item' data-id='${user.id}' data-name='${user.name}' data-email='${user.email}'>${user.name} (${user.email})</button>`;--}}
{{--                                });--}}
{{--                                html += '</div>';--}}
{{--                                $('#user_search_results').html(html);--}}
{{--                                $('#create_new_user_btn').addClass('event_none');--}}
{{--                                userExists = true;--}}
{{--                            } else {--}}
{{--                                $('#user_search_results').html(--}}
{{--                                    '<div class="dropdown-menu show text-danger text-center">No user found.</div>'--}}
{{--                                );--}}
{{--                                $('#create_new_user_btn').removeClass('event_none');--}}
{{--                                userExists = false;--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function() {--}}
{{--                            $('#user_search_results').html(--}}
{{--                                '<div class="dropdown-menu show">Error searching user.</div>'--}}
{{--                            );--}}
{{--                            $('#create_new_user_btn').addClass('event_none');--}}
{{--                        }--}}
{{--                    });--}}
{{--                }, 400);--}}
{{--            });--}}
{{--            // Handle click on dropdown result--}}
{{--            $(document).on('click', '.user-result-item', function() {--}}
{{--                let userId = $(this).data('id');--}}
{{--                let userName = $(this).data('name');--}}
{{--                let userEmail = $(this).data('email');--}}
{{--                selectedUserId = userId;--}}
{{--                $('#user_search_input').val(userName + ' (' + userEmail + ')');--}}
{{--                $('#user_search_results').html('');--}}
{{--                // Save user to cohort via AJAX--}}
{{--                $.ajax({--}}
{{--                    url: "{{ route('crm.training-courses.add-user-to-cohort') }}",--}}
{{--                    method: 'POST',--}}
{{--                    data: {--}}
{{--                        user_id: userId,--}}
{{--                        cohort_id: '{{ $training_course->id }}',--}}
{{--                        _token: '{{ csrf_token() }}'--}}
{{--                    },--}}
{{--                    success: function(res) {--}}
{{--                        window.location.reload();--}}
{{--                    },--}}
{{--                    error: function() {--}}
{{--                        alert('Error adding user to cohort');--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            // $('#create_new_user_btn').on('click', function() {--}}
{{--            //     const name = $('#user_search_input').val().trim();--}}
{{--            //     if (!userExists && name.length > 1) {--}}
{{--            //         window.location.href = '/users/create?name=' + encodeURIComponent(name);--}}
{{--            //     }--}}
{{--            // });--}}

{{--            // Loader for all AJAX requests--}}
{{--            $(document).on({--}}
{{--                ajaxStart: function() {--}}
{{--                    $('html').addClass('body_loader');--}}
{{--                },--}}
{{--                ajaxStop: function() {--}}
{{--                    $('html').removeClass('body_loader');--}}
{{--                }--}}
{{--            });--}}
{{--            $('#save_note_btn').on('click', function() {--}}
{{--                var note = $('#additional_note').val();--}}
{{--                $.ajax({--}}
{{--                    url: "{{ route('crm.training-courses.save-note') }}",--}}
{{--                    method: 'POST',--}}
{{--                    data: {--}}
{{--                        _token: '{{ csrf_token() }}',--}}
{{--                        cohort_id: '{{ $training_course->id }}',--}}
{{--                        note: note--}}
{{--                    },--}}
{{--                    success: function() {--}}
{{--                        window.location.reload();--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            $(document).on('click', '.view-popup', function() {--}}
{{--                var status = $(this).data('status');--}}
{{--                var registration = $(this).data('registration');--}}
{{--                var expiry = $(this).data('expiry');--}}
{{--                var userId = $(this).closest('tr').data('id');--}}
{{--                $('#qualification_user_id').val(userId);--}}
{{--                $('select[name="qualification_status"]').val(status);--}}
{{--                $('input[name="registration_date"]').val(registration);--}}
{{--                $('input[name="date_of_last_expiry"]').val(expiry);--}}
{{--                $('#qualificationForm select, #qualificationForm input').prop('disabled', true);--}}
{{--                $('.modal-footer .btn-primary').hide();--}}
{{--                $('#qualificationModal').modal('show');--}}
{{--            });--}}

{{--            // If you want to re-enable fields for .show-popup (new entry)--}}
{{--            // $(document).on('click', '.show-popup', function() {--}}
{{--            //     $('#qualificationForm')[0].reset();--}}
{{--            //     $('#qualificationForm select, #qualificationForm input').prop('disabled', false);--}}
{{--            //     var userId = $(this).closest('tr').data('id');--}}
{{--            //     $('#qualification_user_id').val(userId);--}}
{{--            //     $('.modal-footer .btn-primary').show();--}}
{{--            //     $('#qualificationModal').modal('show');--}}
{{--            // });--}}
{{--            $(document).on('click', '.show-popup', function() {--}}
{{--                var userId = $(this).closest('tr').data('id');--}}
{{--                alert(userId)--}}
{{--                // $('#qualification_user_id').val(userId);--}}
{{--                // $('#qualificationModal').modal('show');--}}
{{--            });--}}
{{--            $(document).on('click', '.close_model', function() {--}}
{{--                var userId = $(this).closest('tr').data('id');--}}
{{--                $('#qualification_user_id').val(userId);--}}
{{--                $('#qualificationModal').modal('hide');--}}
{{--            });--}}
{{--            $('#qualificationForm').on('submit', function(e) {--}}
{{--                e.preventDefault();--}}
{{--                var form = $(this);--}}
{{--                // Remove previous errors--}}
{{--                form.find('.invalid-feedback').remove();--}}
{{--                form.find('.is-invalid').removeClass('is-invalid');--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route('crm.qualifications.post') }}',--}}
{{--                    method: 'POST',--}}
{{--                    data: form.serialize() + '&_token={{ csrf_token() }}',--}}
{{--                    success: function() {--}}
{{--                        $('#qualificationModal').modal('hide');--}}
{{--                        location.reload();--}}
{{--                    },--}}
{{--                    error: function(xhr) {--}}
{{--                        if (xhr.status === 422) {--}}
{{--                            var errors = xhr.responseJSON.errors;--}}
{{--                            $.each(errors, function(key, messages) {--}}
{{--                                var input = form.find('[name="' + key + '"]');--}}
{{--                                input.addClass('is-invalid');--}}
{{--                                input.after('<div class="invalid-feedback">' + messages[--}}
{{--                                    0] + '</div>');--}}
{{--                            });--}}
{{--                        } else {--}}
{{--                            alert('Error posting qualification.');--}}
{{--                        }--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            document.querySelectorAll('.delegate-name-cell').forEach(function(cell) {--}}
{{--                cell.addEventListener('contextmenu', function(e) {--}}
{{--                    e.preventDefault();--}}
{{--                    // Hide any other open context menus--}}
{{--                    document.querySelectorAll('.custom-context-menu').forEach(function(menu) {--}}
{{--                        menu.style.display = 'none';--}}
{{--                    });--}}
{{--                    // Show this cell's context menu at the bottom of the cell--}}
{{--                    var menu = cell.querySelector('.custom-context-menu');--}}
{{--                    if (menu) {--}}
{{--                        menu.style.display = 'block';--}}
{{--                        menu.style.left = '0px';--}}
{{--                        menu.style.top = (cell.offsetHeight - 20) + 'px';--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            // Hide context menu on click elsewhere--}}
{{--            document.addEventListener('click', function(e) {--}}
{{--                document.querySelectorAll('.custom-context-menu').forEach(function(menu) {--}}
{{--                    menu.style.display = 'none';--}}
{{--                });--}}
{{--            });--}}

{{--            document.getElementById('bulk-status-form').addEventListener('submit', function(e) {--}}
{{--                var checked = Array.from(document.querySelectorAll('.bulk-learner-checkbox:checked')).map(--}}
{{--                    cb => cb.value);--}}
{{--                document.getElementById('bulk-learner-ids').value = checked.join(',');--}}
{{--                if (checked.length === 0) {--}}
{{--                    e.preventDefault();--}}
{{--                    alert('Please select at least one learner to update status.');--}}
{{--                }--}}
{{--            });--}}


{{--            // Open modal from the row--}}
{{--            $(document).on('click', '.generate-pdf', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                const $row = $(this).closest('tr');--}}
{{--                const learnerId = $row.data('id');--}}
{{--                const orderDetailId = $row.find('input[name="order_detail_id"]').val();--}}
{{--                const cohortId = '{{ $training_course->id }}';--}}
{{--                $('#gi_user_id').val(learnerId);--}}
{{--                $('#gi_order_detail_id').val(orderDetailId);--}}
{{--                $('#gi_cohort_id').val(cohortId);--}}
{{--                $('#gi-customer-row').html('<tr><td colspan="8" class="text-center">Loading preview…</td></tr>');--}}
{{--                $('#generateInvoiceModal').modal('show');--}}
{{--                $.ajax({--}}
{{--                    url: "{{ route('crm.training-courses.invoice-preview') }}",--}}
{{--                    method: 'GET',--}}
{{--                    data: {--}}
{{--                        cohort_id: cohortId,--}}
{{--                        user_id: learnerId,--}}
{{--                        order_detail_id: orderDetailId--}}
{{--                    },--}}
{{--                    success: function (res) {--}}
{{--                        const r = res || {};--}}
{{--                        $('#gi-customer-row').html(`--}}
{{--                            <tr>--}}
{{--                              <td>${r.customer_no ?? '-'}</td>--}}
{{--                              <td>${r.customer_name ?? '-'}</td>--}}
{{--                              <td>${r.address1 ?? '-'}</td>--}}
{{--                              <td>${r.postcode ?? '-'}</td>--}}
{{--                              <td>${r.funder ?? '-'}</td>--}}
{{--                              <td>${(r.net_amount ?? 0).toFixed ? r.net_amount.toFixed(2) : r.net_amount}</td>--}}
{{--                              <td>${(r.vat_amount ?? 0).toFixed ? r.vat_amount.toFixed(2) : r.vat_amount}</td>--}}
{{--                              <td>${(r.gross_amount ?? 0).toFixed ? r.gross_amount.toFixed(2) : r.gross_amount}</td>--}}
{{--                            </tr>--}}
{{--                          `);--}}
{{--                    },--}}
{{--                    error: function (xhr) {--}}
{{--                        const msg = xhr?.responseJSON?.message || 'Failed to load invoice preview.';--}}
{{--                        $('#gi-customer-row').html(`<tr><td colspan="8" class="text-danger text-center">${msg}</td></tr>`);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}

{{--            $('#generateInvoiceForm').on('submit', function (e) {--}}
{{--                e.preventDefault();--}}

{{--                const $form = $(this);--}}
{{--                const $btn  = $('#gi_submit_btn');--}}
{{--                const passwordField = $form.find('[name="approval_password"]');--}}
{{--                const password = passwordField.val().trim();--}}

{{--                passwordField.removeClass('is-invalid');--}}
{{--                $form.find('.invalid-feedback.password-error').remove();--}}

{{--                if (password === '') {--}}
{{--                    passwordField.addClass('is-invalid');--}}
{{--                    passwordField.after('<div class="invalid-feedback password-error">Password is required.</div>');--}}
{{--                    return;--}}
{{--                }--}}
{{--                if (password.length < 4) {--}}
{{--                    passwordField.addClass('is-invalid');--}}
{{--                    passwordField.after('<div class="invalid-feedback password-error">Password must be at least 4 characters.</div>');--}}
{{--                    return;--}}
{{--                }--}}

{{--                $btn.prop('disabled', true).text('Generating…');--}}

{{--                Swal.fire({--}}
{{--                    title: 'Verifying...',--}}
{{--                    allowOutsideClick: false,--}}
{{--                    didOpen: () => { Swal.showLoading(); }--}}
{{--                });--}}

{{--                setTimeout(() => {--}}
{{--                    Swal.fire({--}}
{{--                        title: 'Generating invoice…',--}}
{{--                        allowOutsideClick: false,--}}
{{--                        didOpen: () => { Swal.showLoading(); }--}}
{{--                    });--}}

{{--                    $.ajax({--}}
{{--                        url: "{{ route('crm.training-courses.generate-invoice') }}",--}}
{{--                        method: 'POST',--}}
{{--                        data: $form.serialize(),--}}
{{--                        success: function (res) {--}}
{{--                            $('#generateInvoiceModal').modal('hide');--}}
{{--                            Swal.close();--}}
{{--                            if (res?.pdf_url) {--}}
{{--                                Swal.fire({ icon: 'success', title: 'Invoice ready', timer: 1200, showConfirmButton: false });--}}
{{--                                window.open(res.pdf_url, '_blank', 'width=900,height=1000');--}}
{{--                            } else {--}}
{{--                                Swal.fire({ icon: 'success', title: 'Invoice generated', timer: 1000, showConfirmButton: false })--}}
{{--                                    .then(() => window.location.reload());--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function (xhr) {--}}
{{--                            Swal.close();--}}
{{--                            $btn.prop('disabled', false).text('Generate');--}}
{{--                            $form.find('.invalid-feedback.server-error').remove();--}}
{{--                            $form.find('.is-invalid').not('[name="approval_password"]').removeClass('is-invalid');--}}

{{--                            if (xhr.status === 422 && xhr.responseJSON?.errors) {--}}
{{--                                const errors = xhr.responseJSON.errors;--}}
{{--                                let firstMsg = null;--}}
{{--                                Object.keys(errors).forEach(function (field) {--}}
{{--                                    const $input = $form.find(`[name="${field}"]`);--}}
{{--                                    if ($input.length) {--}}
{{--                                        const msg = errors[field][0];--}}
{{--                                        firstMsg = firstMsg || msg;--}}
{{--                                        $input.addClass('is-invalid');--}}
{{--                                        $input.after(`<div class="invalid-feedback server-error">${msg}</div>`);--}}
{{--                                    }--}}
{{--                                });--}}
{{--                                Swal.fire({ icon: 'error', title: 'Validation error', text: firstMsg || 'Please review the form and try again.' });--}}
{{--                            } else {--}}
{{--                                const msg = xhr.responseJSON?.message || 'Failed to generate invoice.';--}}
{{--                                Swal.fire({ icon: 'error', title: 'Error', text: msg });--}}
{{--                            }--}}
{{--                        },--}}
{{--                        complete: function () {--}}
{{--                            if (Swal.isLoading()) Swal.close();--}}
{{--                            $btn.prop('disabled', false).text('Generate');--}}
{{--                        }--}}
{{--                    });--}}
{{--                }, 1000);--}}
{{--            });--}}

{{--            $(document).on('click', '[data-dismiss="modal"], [data-bs-dismiss="modal"], #generateInvoiceModal .close, #generateInvoiceModal .btn-close', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                $('#generateInvoiceModal').modal ? $('#generateInvoiceModal').modal('hide') : (function(){--}}
{{--                    const modal = document.getElementById('generateInvoiceModal');--}}
{{--                    modal.classList.remove('show');--}}
{{--                    modal.style.display = 'none';--}}
{{--                    document.body.classList.remove('modal-open');--}}
{{--                    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());--}}
{{--                })();--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
