<style>
    #reassignModal .modal-dialog {
        max-width: 880px !important;
    }

    #reassignModal .modal-content {
        border-radius: 14px !important;
        border: 1px solid #c7cbd3 !important;
        box-shadow: 0 8px 24px #0002 !important;
        background: #fff !important;
    }

    #reassignModal .modal-header {
        background: linear-gradient(var(--erp-chrome-top), var(--erp-chrome-bot)) !important;
        color: #fff !important;
        padding: .75rem 1rem !important;
        border-bottom: 1px solid #4d5157 !important;
        border-top-left-radius: 14px !important;
        border-top-right-radius: 14px !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
    }

    #reassignModal .modal-title {
        font-weight: 800 !important;
        font-size: 1rem !important;
    }

    #reassignModal .modal-header .btn {
        border-radius: 16px !important;
        padding: .35rem .75rem !important;
        font-size: 12px !important;
    }

    #reassignModal .modal-body {
        background: #f8fafc !important;
        padding: 1rem 1.25rem !important;
        border-top: 1px solid #d3d8df !important;
        border-bottom: 1px solid #d3d8df !important;
    }

    #reassignModal .modal-footer {
        background: #f7f8fa !important;
        border-top: 1px solid #d3d8df !important;
        border-bottom-left-radius: 14px !important;
        border-bottom-right-radius: 14px !important;
        padding: .75rem 1rem !important;
    }

    #reassignModal label.small-lab {
        font-size: 11.5px !important;
        color: #6b7280 !important;
        margin-bottom: 3px !important;
        font-weight: 600 !important;
    }

    #reassignModal .form-control {
        height: 32px !important;
        font-size: 12px !important;
        border-radius: 16px !important;
        border: 1px solid var(--erp-input-br) !important;
        background: var(--erp-input) !important;
        transition: all .2s !important;
    }

    #reassignModal .form-control:focus {
        border-color: var(--erp-blue) !important;
        box-shadow: 0 0 0 2px #0d6efd25 !important;
        background: #fff !important;
    }

    #reassignModal .input-group .btn {
        height: 32px !important;
        font-size: 12px !important;
        border-radius: 0 16px 16px 0 !important;
    }

    #reassignModal .input-group input.form-control {
        border-radius: 16px 0 0 16px !important;
    }

    #reassignModal #re_course_results {
        border: 1px solid #d3d8df !important;
        background: #fff !important;
        border-radius: 10px !important;
        margin-top: .3rem !important;
        max-height: 160px !important;
        overflow-y: auto !important;
        padding: .4rem .6rem !important;
        font-size: 12px !important;
        display: none !important;
    }

    #reassignModal #re_course_results .course-item {
        padding: .3rem .4rem !important;
        border-radius: 6px !important;
        cursor: pointer !important;
    }

    #reassignModal #re_course_results .course-item:hover {
        background: #f1f4f8 !important;
    }

    #reassignModal .form-check-label {
        font-size: 12px !important;
        color: #6b7280 !important;
    }

    #reassignModal .form-check-input {
        border-radius: 4px !important;
    }

    #reassignModal .row.g-3 {
        row-gap: 0.6rem !important;
        column-gap: 0.6rem !important;
    }

    #reassignModal .modal-footer .btn {
        padding: .45rem .9rem !important;
        border-radius: 18px !important;
        font-size: 12.5px !important;
        min-width: 100px !important;
    }

    #reassignModal .btn-blue:hover {
        background: linear-gradient(#3a96ff, #0e5ed5) !important;
    }

    #reassignModal .btn-gray:hover {
        background: linear-gradient(#d8dde2, #bfc8d0) !important;
    }

    .field-disabled .form-control {
        background: #eceff3 !important;
        color: #b4bac6 !important;
        pointer-events: none !important;
        cursor: not-allowed !important;
    }

    .field-disabled label.small-lab {
        color: #9aa3af !important;
    }
</style>
<div class="modal fade" id="reassignModal" tabindex="-1" aria-hidden="true"
     style="z-index: 999999999999999999 !important;">
    <div class="modal-dialog modal-lg">
        <form id="reassignForm" class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title">Reassign Learner Delegate</h5>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-blue btn-sm" id="reassignProceedTop">Proceed</button>
                    <button type="button" class="btn btn-gray btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="small-lab">Course to be moved to</label>
                        <div class="input-group" style="height: 41px;">
                            <input type="text" class="form-control" id="re_course_input"
                                   placeholder="Search course/cohort…">
                            <button class="btn btn-blue" type="button" id="re_browse_courses">A-Z</button>
                        </div>
                        <div id="re_course_results"></div>
                        <input type="hidden" id="re_to_cohort_id" name="to_cohort_id">
                    </div>

                    <div class="col-md-2 d-none">
                        <label class="small-lab">Fee</label>
                        <input type="number" step="0.01" class="form-control" id="re_fee" name="fee" placeholder="0.00">
                    </div>

                    <div class="col-md-2 d-none">
                        <label class="small-lab">VAT Rate</label>
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control" id="re_vat" name="vat_rate"
                                   placeholder="20">
                            <button class="btn btn-blue" type="button" id="re_vat_presets">A-Z</button>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-2">
                        <label class="small-lab">Scheduling Fee</label>
                        <input type="number" step="0.01" class="form-control" id="re_reschedule_fee"
                               name="reschedule_fee" value="0.00">
                    </div>

                    <div class="col-md-2">
                        <label class="small-lab">VAT % (Scheduling)</label>
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control" id="re_reschedule_vat_rate"
                                   name="reschedule_vat_rate" value="20">
                            <span class="input-group-text" style="height: 33px;">%</span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="small-lab">VAT Amount</label>
                        <input type="text" class="form-control" id="re_reschedule_vat_amount"
                               name="reschedule_vat_amount" value="0.00" readonly>
                    </div>

                    <div class="col-md-2">
                        <label class="small-lab">Gross (Fee + VAT)</label>
                        <input type="text" class="form-control" id="re_reschedule_gross" name="reschedule_gross"
                               value="0.00" readonly>
                    </div>
                </div>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="re_include_invoice" name="include_invoice"
                           checked>
                    <label class="form-check-label text-muted" for="re_include_invoice">Include Invoice in
                        Reassignment</label>
                    <input type="hidden" class="d-none" name="include_invoice" value="1">
                </div>

                <div class="form-check mt-1 d-none">
                    <input class="form-check-input" type="checkbox" id="re_include_refs" name="include_references">
                    <label class="form-check-label" for="re_include_refs">Include Delegate References</label>
                </div>

                <input type="hidden" id="re_from_cohort_id" name="from_cohort_id">
                <input type="hidden" id="re_learner_ids" name="learner_ids">
            </div>

            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-blue" id="reassignProceedBottom">Proceed</button>
                <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div id="passwordConfirmModal"
     style="display:none;
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.5);
            z-index:9999;
            align-items:center;
            justify-content:center;">
    <div style="background:#fff;
              width:100%;
              max-width:360px;
              border-radius:12px;
              box-shadow:0 24px 48px rgba(0,0,0,.3);
              padding:20px;
              margin:40px auto;
              font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">

        <h5 style="margin:0 0 12px;font-size:16px;font-weight:600;color:#111827;">
            Confirm Action
        </h5>
        <p style="margin:0 0 16px;font-size:13px;color:#4b5563;line-height:1.4;">
            Please enter your password to continue with refund.
        </p>

        <div class="mb-2">
            <input id="verifyPasswordInput"
                   type="password"
                   autocomplete="current-password"
                   placeholder="Enter password"
                   style="width:100%;
                        border:1px solid #d1d5db;
                        border-radius:8px;
                        padding:8px 10px;
                        font-size:14px;
                        line-height:1.4;
                        color:#111827;
                        outline:none;"
            />
        </div>

        <div id="verifyPasswordErr"
             style="display:none;
                  color:#dc2626;
                  font-size:13px;
                  margin-bottom:12px;
                  line-height:1.4;">
        </div>

        <div style="display:flex;justify-content:flex-end;gap:8px;">
            <button type="button"
                    id="verifyPasswordCancel"
                    style="background:#fff;
                         border:1px solid #d1d5db;
                         border-radius:8px;
                         padding:6px 12px;
                         font-size:14px;
                         line-height:1.4;
                         cursor:pointer;">
                Cancel
            </button>

            <button type="button"
                    id="verifyPasswordContinue"
                    style="background:#4f46e5;
                         border:1px solid #4f46e5;
                         color:#fff;
                         border-radius:8px;
                         padding:6px 12px;
                         font-size:14px;
                         line-height:1.4;
                         cursor:pointer;
                         font-weight:500;">
                Continue
            </button>
        </div>
    </div>
</div>



