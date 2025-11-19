(function ($, window, document) {
    $(function () {
        function csrf() {
            return $('meta[name="csrf-token"]').attr('content');
        }

        function cohortId() {
            let m = location.pathname.match(/training-courses\/(\d+)/);
            if (m) {
                return m[1];
            }

            const fallback = $('#gi_cohort_id').val();
            if (fallback) {
                return fallback;
            }

            m = location.pathname.match(/invoices\/(\d+)/);
            if (m) {
                const invoiceId = m[1];
                setTimeout(() => {

                    $.ajax({
                        url: `/crm/training-courses/getCurrentInvoiceCohort/${invoiceId}`,
                        method: 'GET',
                        success: function (response) {
                            $('#re_from_cohort_id').val(response.from_cohort_id);
                            $('#re_learner_ids').val(JSON.stringify(response.learner_id));
                            return response.from_cohort_id;

                        },
                        error: function (err) {
                            console.error('Failed to load invoice:', err);
                        }
                    });
                }, 1000);
            }

            return null;
        }

        function money(n) {
            return (parseFloat(n || 0)).toFixed(2);
        }

        function r2(n) {
            return Math.round((parseFloat(n || 0)) * 100) / 100;
        }

        function getSecondRouteSegment() {
            const segments = location.pathname.split('/').filter(Boolean);
            return segments[1] || null;
        }

        $(document).on('click', '.open-reassign', function () {
            $('#reassignModal').modal('show');
        });

        let ctxRow = null, MENU_MIN_W = 320;

        $(document).off('contextmenu', '.context');
        $(document).off('contextmenu.ctx click.ctx keydown.ctx scroll.ctx');

        $(document).on('contextmenu.ctx', '#delegates-tbody tr, #delegates-tbody tr .context', function (e) {
            if ((e.which && e.which !== 3) && (e.button && e.button !== 2)) return;
            e.preventDefault();
            e.stopPropagation();
            ctxRow = $(this).closest('tr');
            $('.ctx-menu').hide();
            const $menu = ctxRow.find('.ctx-menu');
            $menu.css({minWidth: MENU_MIN_W + 'px', padding: '6px 0', borderRadius: '8px'});
            $menu.find('a').css({whiteSpace: 'nowrap', display: 'block', padding: '8px 14px'});
            const rowOff = ctxRow.offset();
            let left = e.pageX - rowOff.left;
            let top = e.pageY - rowOff.top;
            const maxL = ctxRow.innerWidth() - $menu.outerWidth() - 6;
            const maxT = ctxRow.innerHeight() - $menu.outerHeight() - 6;
            left = Math.max(6, Math.min(left, maxL));
            top = Math.max(6, Math.min(top, maxT));
            $menu.css({left, top, display: 'block', position: 'absolute', zIndex: 1055});
        });

        $(document).on('click.ctx keydown.ctx scroll.ctx', function (e) {
            if (e.type === 'keydown' && e.key !== 'Escape') return;
            $('.ctx-menu').hide();
        });

        function getSelectedIdsOrRow() {
            const checked = $('#delegates-tbody input.learners:checked').closest('tr').map(function () {
                return $(this).data('id');
            }).get();
            if (checked.length) return checked;
            return ctxRow ? [ctxRow.data('id')] : [];
        }

        function tickAllForCustomer(row) {
            const cid = row.data('customer-id');
            const cname = row.data('customer-name');
            let $rows;
            if (cid) {
                $rows = $(`#delegates-tbody tr[data-customer-id="${cid}"]`);
            } else if (cname) {
                $rows = $('#delegates-tbody tr').filter(function () {
                    return (($(this).data('customer-name') || '') === cname);
                });
            } else {
                $rows = $();
            }
            $rows.find('input.learners').prop('checked', true);
        }

        $(document).on('click', '.ctx-menu a', function (e) {
            e.preventDefault();
            const action = $(this).data('action');
            const row = $(this).closest('tr');
            if (action === 'tick-customer') tickAllForCustomer(row);
            if (action === 'reassign') {
                ctxRow = row;
                openReassignModal();
            }
            $('.ctx-menu').hide();
        });

        let reTimer = null;
        $(document).on('keyup', '#re_course_input', function () {
            clearTimeout(reTimer);
            const q = $(this).val().trim();
            if (q.length < 2) {
                $('#re_course_results').html('');
                return;
            }
            reTimer = setTimeout(function () {
                $.get('/crm/training-courses/search-cohorts', {q})
                    .done(function (rows) {
                        let html = '<div class="dropdown-menu show" style="width:100%">';
                        rows.forEach(r => {
                            html += `<button type="button" class="dropdown-item re-course-item" data-id="${r.id}">${r.label}</button>`;
                        });
                        html += '</div>';
                        $('#re_course_results').html(html);
                    })
                    .fail(() => $('#re_course_results').html('<div class="dropdown-menu show text-danger text-center">Search failed</div>'));
            }, 350);
        });

        $(document).on('click', '.re-course-item', function () {
            $('#re_to_cohort_id').val($(this).data('id'));
            $('#re_course_input').val($(this).text());
            $('#re_course_results').html('');
        });

        function ensureCourseBrowser() {
            if ($('#courseBrowser').length) return;
            const modal = `
            <div class="modal fade" id="courseBrowser" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Training Courses Database</h5>
                    <div class="d-flex align-items-center gap-2 ms-3">
                      <input type="text" id="cb_search" class="form-control form-control-sm" placeholder="Search..." style="width:260px">
                      <select id="cb_year" class="form-select form-select-sm"></select>
                      <select id="cb_month" class="form-select form-select-sm"></select>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="d-flex flex-wrap align-items-center gap-1 mb-2" id="cb_letters"></div>
                    <div class="table-responsive" style="max-height:420px; overflow:auto">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>Code</th>
                            <th>Course Code</th>
                            <th>Start Date</th>
                            <th>Venue</th>
                          </tr>
                        </thead>
                        <tbody id="cb_rows"></tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <span id="cb_count" class="me-auto small text-muted"></span>
                    <button class="btn btn-gray" data-bs-dismiss="modal" type="button">Close</button>
                  </div>
                </div>
              </div>
            </div>`;
            $('body').append(modal);
            const years = [];
            const y0 = new Date().getFullYear();
            for (let y = y0 - 2; y <= y0 + 2; y++) years.push(`<option value="${y}">${y}</option>`);
            $('#cb_year').html(years.join('')).val(y0);
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            $('#cb_month').html(months.map((m, i) => `<option value="${i + 1}">${m}</option>`).join('')).val(new Date().getMonth() + 1);
            const letters = ['ALL'].concat('ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split(''));
            $('#cb_letters').html(letters.map(l => `<button type="button" class="btn btn-sm ${l === 'ALL' ? 'btn-blue' : 'btn-outline'} cb-letter" data-letter="${l === 'ALL' ? '' : l}">${l}</button>`).join(''));
        }

        function fetchCourses(params) {
            const currentId = cohortId();
            $('#cb_rows').html('<tr><td colspan="4" class="text-center">Loading…</td></tr>');

            $.get('/crm/training-courses/search-cohorts', params).done(function (rows) {
                if (!rows || !rows.length) {
                    $('#cb_rows').html('<tr><td colspan="4" class="text-center">No results</td></tr>');
                    $('#cb_count').text('0 records');
                    return;
                }

                rows = rows.filter(r => r.id != currentId);

                if (!rows.length) {
                    $('#cb_rows').html('<tr><td colspan="4" class="text-center">No other cohorts found</td></tr>');
                    $('#cb_count').text('0 records');
                    return;
                }

                let html = '';
                rows.forEach(r => {
                    const code = r.code || ('TC' + String(r.id).padStart(6, '0'));
                    const name = r.course_name || r.label || '';
                    const start = r.start || r.start_date_time || '';
                    const venue = r.venue_name || '';

                    html += `
                <tr class="cb-pick"
                    data-id="${r.id}"
                    data-label="${(r.label || `${start} – ${name} (${venue})`).replace(/"/g, '&quot;')}">
                    <td>${code}</td>
                    <td>${name}</td>
                    <td>${start}</td>
                    <td>${venue}</td>
                </tr>`;
                });

                $('#cb_rows').html(html);
                $('#cb_count').text(rows.length + ' records');
            }).fail(function () {
                $('#cb_rows').html('<tr><td colspan="4" class="text-center text-danger">Failed to load</td></tr>');
                $('#cb_count').text('');
            });
        }


        $('#re_browse_courses').on('click', function () {
            ensureCourseBrowser();
            const y = $('#cb_year').val();
            const m = $('#cb_month').val();
            fetchCourses({year: y, month: m, sort: 'az', q: '*'});
            $('#courseBrowser').modal ? $('#courseBrowser').modal('show') : $('#courseBrowser').show();
        });

        $(document).on('change', '#cb_year,#cb_month', function () {
            fetchCourses({
                year: $('#cb_year').val(),
                month: $('#cb_month').val(),
                sort: 'az',
                q: $('#cb_search').val().trim() || '*'
            });
        });
        $(document).on('keyup', '#cb_search', function () {
            const q = $(this).val().trim();
            fetchCourses({year: $('#cb_year').val(), month: $('#cb_month').val(), q: q || '*', sort: 'az'});
        });
        $(document).on('click', '.cb-letter', function () {
            $('.cb-letter').removeClass('btn-blue').addClass('btn-outline');
            $(this).removeClass('btn-outline').addClass('btn-blue');
            const starts = $(this).data('letter') || '';
            const q = starts ? starts + '%' : '*';
            fetchCourses({year: $('#cb_year').val(), month: $('#cb_month').val(), q, starts: starts, sort: 'az'});
        });
        $(document).on('click', '.cb-pick', function () {
            const id = $(this).data('id');
            const label = $(this).data('label');
            $('#re_to_cohort_id').val(id);
            $('#re_course_input').val(label);
            $('#courseBrowser').modal ? $('#courseBrowser').modal('hide') : $('#courseBrowser').hide();
            $('#re_course_results').html('');
        });

        function submitReassign() {
            const payload = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                from_cohort_id: $('#re_from_cohort_id').val(),
                to_cohort_id: $('#re_to_cohort_id').val(),
                learner_ids: JSON.parse($('#re_learner_ids').val() || '[]'),
                include_invoice: $('#re_include_invoice').is(':checked') ? 1 : 0,
                include_references: $('#re_include_refs').is(':checked') ? 1 : 0,
                reschedule_fee: $('#re_reschedule_fee').val() || 0,
                reschedule_vat_rate: $('#re_reschedule_vat_rate').val() || 0,
                reschedule_vat_amount: ($('#re_reschedule_vat_amount').val() || '0').replace(/,/g, ''),
                reschedule_gross: ($('#re_reschedule_gross').val() || '0').replace(/,/g, '')
            };

            if (!payload.to_cohort_id) {
                Swal.fire({icon: 'error', title: 'Select a target course'});
                return;
            }
            if (!payload.learner_ids.length) {
                Swal.fire({icon: 'error', title: 'No delegates selected'});
                return;
            }

            const proceed = () => {
                const preTitle = (payload.include_invoice)
                    ? 'Reassigning…'
                    : 'Generating New Invoice…';

                Swal.fire({
                    title: preTitle,
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.post('/crm/training-courses/reassignCohort', payload)
                    .done((res) => {
                        Swal.close();

                        const title = (res && res.is_new_invoice)
                            ? 'New Invoice Created'
                            : 'Reassigned';

                        Swal.fire({
                            icon: 'success',
                            title: title,
                            timer: 1000,
                            showConfirmButton: false
                        });

                        $('#reassignModal').modal('hide');

                        const $reassignForm = $('#reassignForm');
                        $reassignForm[0].reset();
                        $('#re_course_results').empty();
                        $('#re_to_cohort_id').val('');
                        $('#re_from_cohort_id').val('');
                        $('#re_learner_ids').val('');
                        $('#re_reschedule_vat_amount').val('0.00');
                        $('#re_reschedule_gross').val('0.00');

                        const $courseBrowser = $('#courseBrowser');
                        $courseBrowser.find('#cb_search').val('');
                        $courseBrowser.find('#cb_letters').empty();
                        $courseBrowser.find('#cb_rows').empty();
                        $courseBrowser.find('#cb_count').text('');

                        if (getSecondRouteSegment() === 'training-courses'){
                            loadLearners();
                        }
                        if (getSecondRouteSegment() === 'invoices'){
                            loadAll();
                        }

                        let secondsLeft = 5;

                        Swal.fire({
                            title: 'All done ✨',
                            html: `
                        <div style="font-size:14px;color:#4b5563;line-height:1.4;">
                            We're opening the new course view for you.<br>
                            <span id="redirectCountdown" style="font-weight:600;color:#111827;">${secondsLeft}s</span> remaining…
                        </div>
                        <div style="
                            margin-top:16px;
                            background:#f1f5f9;
                            border-radius:8px;
                            padding:12px 14px;
                            font-size:12px;
                            color:#6b7280;
                            border:1px solid #e5e7eb;
                            text-align:left;
                        ">
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div style="
                                    width:8px;
                                    height:8px;
                                    border-radius:999px;
                                    background:#0ea5e9;
                                    box-shadow:0 0 10px rgba(14,165,233,.8);
                                    animation:pulseDot 1.2s infinite;
                                "></div>
                                <div>
                                    Redirecting to the new cohort tab…
                                </div>
                            </div>
                        </div>
                        <style>
                            @keyframes pulseDot {
                                0%   { opacity:1; transform:scale(1);   }
                                50%  { opacity:.4; transform:scale(.6); }
                                100% { opacity:1; transform:scale(1);   }
                            }
                        </style>
                    `,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            customClass: {
                                popup: 'swal-modern-popup',
                                title: 'swal-modern-title'
                            },
                            didOpen: () => {
                                const $count = $('#redirectCountdown');
                                const intervalId = setInterval(() => {
                                    secondsLeft -= 1;
                                    if (secondsLeft <= 0) {
                                        clearInterval(intervalId);
                                    }
                                    if ($count.length) {
                                        $count.text(secondsLeft + 's');
                                    }
                                }, 1000);

                                setTimeout(() => {
                                    window.open(
                                        '/crm/training-courses/' + encodeURIComponent(payload.to_cohort_id),
                                        '_blank'
                                    );
                                    Swal.close();
                                }, 5000);
                            }
                        });

                        if (!document.getElementById('swal-modern-style')) {
                            const style = document.createElement('style');
                            style.id = 'swal-modern-style';
                            style.textContent = `
                        .swal-modern-popup {
                            border-radius: 16px !important;
                            padding: 24px 24px 20px !important;
                            box-shadow: 0 25px 50px -12px rgba(0,0,0,.45) !important;
                            border: 1px solid #e5e7eb !important;
                        }
                        .swal-modern-title {
                            font-size: 16px !important;
                            font-weight:600 !important;
                            color:#111827 !important;
                            margin-bottom:8px !important;
                        }
                    `;
                            document.head.appendChild(style);
                        }
                    })
                    .fail((xhr) => {
                        Swal.close();
                        const msg = xhr?.responseJSON?.message || 'Failed to reassign';
                        Swal.fire({icon: 'error', title: 'Error', text: msg});
                    });
            };

            if (payload.include_invoice === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Invoice Included',
                    text: 'A new invoice will be generated for this reassignment. Continue?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, continue',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        proceed();
                    }
                });
            } else {
                proceed();
            }
        }


        $('#reassignProceedTop,#reassignProceedBottom').on('click', submitReassign);
        $('#reassignForm').on('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                submitReassign();
            }
        });

        const AZ_LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
        let currentAZ = '';

        function buildAZFilter() {
            if (!$('#re_az_filter').length) return;
            let html = AZ_LETTERS.map(l => `<button type="button" class="btn btn-sm ${l === currentAZ ? 'btn-blue' : 'btn-outline'} re-az" data-letter="${l}">${l}</button>`).join('');
            html += `<button type="button" class="btn btn-sm ${currentAZ === '' ? 'btn-blue' : 'btn-outline'} re-az" data-letter="">All</button>`;
            $('#re_az_filter').html(html);
        }

        $(document).on('click', '.re-az', function () {
            currentAZ = $(this).data('letter');
            buildAZFilter();
            const q = currentAZ ? currentAZ + '%' : '*';
            $.get('/crm/training-courses/search-cohorts', {q, sort: currentAZ ? 'az' : 'recent'})
                .done(function (rows) {
                    let html = '<div class="dropdown-menu show" style="width:100%; max-height:260px; overflow:auto">';
                    rows.forEach(r => {
                        html += `<button type="button" class="dropdown-item re-course-item" data-id="${r.id}">${r.label}</button>`;
                    });
                    html += '</div>';
                    $('#re_course_results').html(html);
                })
                .fail(() => $('#re_course_results').html('<div class="dropdown-menu show text-danger text-center">Search failed</div>'));
        });

        function openReassignModal() {
            const ids = getSelectedIdsOrRow();
            if (!ids.length) {
                Swal.fire({icon: 'info', title: 'No delegates selected'});
                return;
            }
            $('#re_course_input').val('');
            $('#re_course_results').html('');
            $('#re_to_cohort_id').val('');
            $('#re_from_cohort_id').val(cohortId());
            $('#re_learner_ids').val(JSON.stringify(ids));

            $('#re_fee').closest('.col-md-2').hide();
            $('#re_vat').closest('.col-md-2').hide();
            $('#re_vat_presets').hide();

            $('#re_reschedule_fee').val(0);
            $('#re_reschedule_vat_rate').val(20);
            $('#re_reschedule_vat_amount').val('0.00');
            $('#re_reschedule_gross').val('0.00');
            calcReschedule();

            if (!$('#re_az_filter').length) $('<div id="re_az_filter" class="mb-2 d-flex flex-wrap gap-1"></div>').insertBefore('#re_course_results');
            buildAZFilter();
            $('#reassignModal').modal ? $('#reassignModal').modal('show') : $('#reassignModal').show();
        }

        function calcReschedule() {
            const fee = parseFloat($('#re_reschedule_fee').val() || 0);
            const rate = parseFloat($('#re_reschedule_vat_rate').val() || 0);
            const vat = r2(fee * (rate / 100));
            const gross = r2(fee + vat);
            $('#re_reschedule_vat_amount').val(money(vat));
            $('#re_reschedule_gross').val(money(gross));
        }

        $(document).on('input', '#re_reschedule_fee,#re_reschedule_vat_rate', calcReschedule);
        const coreCSS = `
        :root {
            --erp-chrome: #6e737b;
            --erp-chrome-top: #7a8088;
            --erp-chrome-bot: #5f636a;
            --erp-input: #eef1f4;
            --erp-input-br: #bfc7d1;
            --erp-blue: #0d6efd;
            --erp-blue-pill: #22a3ff;
            --erp-green: #00d237;
            --erp-green-b: #08b62f;
            --erp-yellow: #fff7b8;
        }

        #reassignModal .btn {
            padding: 0.45rem 0.9rem !important;
            border-radius: 18px !important;
            border: 1px solid transparent !important;
        }

        #reassignModal .btn-blue {
            background: linear-gradient(#2d8bff, #1168e6) !important;
            border: 1px solid #0e58c3 !important;
            color: #fff !important;
        }

        #reassignModal .btn-outline {
            background: #fff !important;
            border: 1px solid #a5adba !important;
            color: #0d6efd !important;
        }

        #reassignModal .btn-sm {
            padding: 0.35rem 0.7rem !important;
            border-radius: 16px !important;
            font-size: 0.875rem !important;
        }

        #reassignModal .btn-circle {
            width: 22px !important;
            height: 22px !important;
            border-radius: 6px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            font-weight: 800 !important;
            font-size: 11px !important;
        }

        #reassignModal .btn-gray {
            background: #e2e6ea !important;
            color: #2f3b52 !important;
            border: 1px solid #c7cbd3 !important;
        }

        #reassignModal .input-group {
            gap: 0 !important;
            margin: 0 !important;
        }

        #reassignModal .input-group .form-control,
        #reassignModal .input-group .btn,
        #reassignModal .input-group .input-group-text {
            margin: 0 !important;
        }

        .table thead th {
            position: sticky;
            top: 0;
            background: linear-gradient(var(--erp-chrome-top), var(--erp-chrome-bot));
            color: #fff;
            padding: .5rem .55rem;
            border-bottom: 1px solid #4a4e55;
            font-weight: 800;
            z-index: 2;
            font-size: 12px;
         ;`

        const styleEl = $('<style id="core-modal-css"></style>').text(coreCSS);

        $('#reassignModal').on('show.bs.modal', function () {
            if (!$('#core-modal-css').length) {
                $('head').append(styleEl);
            }
            $('#reassignModal .input-group').css({gap: '0', margin: '0'});
            $('#reassignModal .input-group > *').css('margin', '0');
        });

        $('#reassignModal').on('hidden.bs.modal', function () {
            $('#core-modal-css').remove();
        });

        function feeCols() {
            return [
                $('#re_reschedule_fee').closest('.col-md-2'),
                $('#re_reschedule_vat_rate').closest('.col-md-2'),
                $('#re_reschedule_vat_amount').closest('.col-md-2'),
                $('#re_reschedule_gross').closest('.col-md-2')
            ];
        }

        function toggleFeeControls(enabled) {
            $('#re_reschedule_fee').prop('disabled', !enabled);
            $('#re_reschedule_vat_rate').prop('disabled', !enabled);
            $('#re_reschedule_vat_amount').prop('disabled', !enabled);
            $('#re_reschedule_gross').prop('disabled', !enabled);

            feeCols().forEach($col => $col.toggleClass('field-disabled', !enabled));
        }

        $(document).on('change', '#re_include_invoice', function () {
            const enabled = $(this).is(':checked');
            toggleFeeControls(enabled);
        });

        $('#reassignModal').on('show.bs.modal', function () {
            const enabled = $('#re_include_invoice').is(':checked');
            toggleFeeControls(enabled);
        });

    });
})(jQuery, window, document);
