<style>
    #globalTopProgress {
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        height: 3px;
        background: linear-gradient(90deg, #4f8cff, #22c55e);
        transform-origin: left;
        transform: scaleX(0);
        transition: transform .25s ease;
        z-index: 2147483647
    }

    #globalTopProgress.active {
        transform: scaleX(.35)
    }

    #globalTopProgress.almost {
        transform: scaleX(.8)
    }

    .modal .modal-content {
        position: relative;
        overflow: hidden
    }

    .modal .loading-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15, 20, 30, .42);
        backdrop-filter: saturate(120%) blur(2px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 20
    }

    .modal .loading-backdrop.show {
        display: flex
    }

    .load-spinner {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, .35);
        border-top-color: #fff;
        animation: spin .9s linear infinite
    }

    @keyframes spin {
        to {
            transform: rotate(360deg)
        }
    }

    .btn-busy {
        position: relative
    }

    .btn-busy[disabled] {
        opacity: .7;
        cursor: not-allowed
    }

    .btn-busy .btn-loader {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .btn-busy .btn-loader i {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 2px solid currentColor;
        border-top-color: transparent;
        animation: spin .75s linear infinite
    }

    tr.refunding td {
        opacity: .6
    }

    .badge-refunding {
        background: #6c757d;
        color: #fff;
        border-radius: 999px;
        padding: .2rem .5rem;
        margin-left: .5rem;
        font-size: .72rem
    }
</style>

<div class="modal" id="stripeModal" tabindex="-1" style="display:none; background:rgba(0,0,0,.45);z-index:5000;">
    <div class="modal-dialog" style="max-width:640px">
        <div class="modal-content" style="border-radius:12px">
            <div class="modal-header">
                <h5 class="modal-title">Take Payment (Stripe)</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"
                        id="stripeClose"></button>
            </div>
            <div class="modal-body">
                <div style="display:grid;grid-template-columns:1fr 140px;gap:.75rem;margin-bottom:.75rem">
                    <div>
                        <label style="font-weight:700">Amount</label>
                        <input id="stripe_amount" class="form-control" type="number" min="0.01" step="0.01">
                    </div>
                    <div>
                        <label style="font-weight:700">Currency</label>
                        <select id="stripe_currency" class="form-control">
                            <option value="GBP">GBP</option>
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                </div>
                <div style="margin:.5rem 0;font-weight:700">Card Details</div>
                <div id="stripe-card-element" style="border:1px solid #cfd5dc;border-radius:10px;padding:12px"></div>
                <div id="stripe-card-errors" style="color:#dc3545;margin-top:.5rem;font-weight:700"></div>
            </div>
            <div class="modal-footer" style="display:flex;gap:.5rem">
                <button class="btn btn-gray" id="stripeCancel">Cancel</button>
                <button class="btn btn-blue" id="stripePayBtn">Proceed</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="stripeBRModal" tabindex="-1" style="display:none; background:rgba(0,0,0,.45);z-index:5000;">
    <div class="modal-dialog" style="max-width:680px">
        <div class="modal-content" style="border-radius:12px">
            <div class="modal-header">
                <h5 class="modal-title">Stripe Full Refund</h5>
                <button type="button" class="btn-close" id="brClose"></button>
            </div>

            <div class="modal-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem">
                    <div>
                        <label style="font-weight:700">Account ID</label>
                        <input id="br_account_id" class="form-control" placeholder="Optional">
                    </div>
                    <div style="display:flex;align-items:end;gap:.5rem">
                        <button class="btn btn-blue d-none" id="brCheck">Check Balance</button>
                    </div>
                </div>

                <div id="brResult"
                     style="margin-top:.75rem;border:1px solid #cfd5dc;border-radius:10px;padding:10px;display:none"></div>

                <hr>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem">
                    <div>
                        <label style="font-weight:700">Payment Intent ID</label>
                        <input id="br_pi" class="form-control">
                    </div>
                    <div class="d-none">
                        <label style="font-weight:700">Refund Amount</label>
                        <input id="br_amount" class="form-control" type="number" step="0.01" min="0.01"
                               placeholder="Blank = full">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-top:.75rem">
                    <div>
                        <label style="font-weight:700">Reason</label>
                        <select id="br_reason" class="form-select">
                            <option value="">Select reason...</option>
                            <option value="duplicate">Duplicate</option>
                            <option value="fraudulent">Fraudulent</option>
                            <option value="requested_by_customer">Requested by Customer</option>
                        </select>
                    </div>
                    <div style="display:flex;align-items:end;gap:.5rem">
                        <button class="btn btn-red" id="brRefund">Refund</button>
                    </div>
                </div>

                <div id="brMsg" style="margin-top:.75rem;color:#0f5132;display:none"></div>
                <div id="brErr" style="margin-top:.75rem;color:#b02a37;display:none"></div>
            </div>

            <div class="modal-footer" style="display:flex;gap:.5rem">
                <button class="btn btn-gray" id="brCancel">Close</button>
            </div>
        </div>
    </div>
</div>
