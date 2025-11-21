@extends('crm.layout.main')
@section('title','CRM - Payment Receipt')

@push('css')
    <style>
        :root {
            --ink: #0f172a;
            --muted: #6b7280;
            --soft: #e5e7eb;
            --bg: #f3f4f6;
            --card-bg: #ffffff;
            --accent: #1168e6;
            --accent-soft: #e0edff;
            --danger: #ef4444;
            --amber: #facc15;
        }

        body {
            background: radial-gradient(circle at top left, #eef2ff 0, #f3f4f6 45%, #f9fafb 100%);
            color: var(--ink);
            font-size: 13px;
        }


        .pr-wrap {
            background: var(--card-bg);
            border: 1px solid rgba(148, 163, 184, .45);
            border-radius: 18px;
            margin-top: .9rem;
            box-shadow: 0 20px 45px rgba(15, 23, 42, .14),
            0 0 0 1px rgba(255, 255, 255, .8);
            overflow: hidden;
        }


        .pr-toolbar {
            display: flex;
            justify-content: flex-end;
            gap: .5rem;
            padding: .7rem 1rem;
            background: linear-gradient(120deg, #eff6ff 0%, #e0f2fe 40%, #f9fafb 100%);
            border-bottom: 1px solid rgba(148, 163, 184, .4);
            position: sticky;
            top: 0;
            z-index: 9;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .08);
        }


        .btn {
            border-radius: 999px;
            padding: .45rem .95rem;
            cursor: pointer;
            font-weight: 600;
            border: 1px solid transparent;
            font-size: .82rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .3rem;
            transition: all .16s ease-in-out;
        }

        .btn-blue {
            background: linear-gradient(135deg, #2d8bff, #1168e6);
            border-color: #0e58c3;
            color: #fff;
            box-shadow: 0 6px 16px rgba(37, 99, 235, .35);
        }

        .btn-blue:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, .4);
        }

        .btn-gray {
            background: linear-gradient(135deg, #e5e7eb, #cbd5e1);
            border-color: #cbd5e1;
            color: #111827;
            box-shadow: 0 4px 10px rgba(15, 23, 42, .12);
        }

        .btn-gray:hover {
            filter: brightness(1.02);
        }

        .btn-outline {
            background: #fff;
            border: 1px solid var(--accent);
            color: var(--accent);
            box-shadow: 0 2px 6px rgba(15, 23, 42, .05);
        }

        .btn:disabled,
        .btn.disabled {
            opacity: .55;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }


        .pr-body {
            padding: 1rem 1rem 1.1rem;
            background: radial-gradient(circle at top right, #eff6ff 0, #ffffff 45%, #f9fafb 100%);
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .box {
            border: 1px solid rgba(148, 163, 184, .4);
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        }

        .box-h {
            background: linear-gradient(135deg, #0f172a, #1f2937);
            color: #fff;
            padding: .5rem .85rem;
            font-weight: 600;
            border-bottom: 1px solid #020617;
            letter-spacing: .05em;
            text-transform: uppercase;
            font-size: .78rem;
        }

        .box-b {
            padding: .8rem .9rem;
        }


        .kv {
            display: grid;
            grid-template-columns: 150px 1fr auto;
            gap: .5rem;
            align-items: center;
            margin-bottom: .55rem;
        }

        .muted {
            color: var(--muted);
            font-size: .9rem;
        }


        .hl {
            border: 1px solid #d1d5db;
            border-radius: 16px;
            padding: .35rem .65rem;
            width: 100%;
            background: #f9fafb;
            box-shadow: inset 0 1px 0 #fff,
            inset 0 -1px 0 #e4e7ec;
            font-size: 12px;
            color: var(--ink);
            transition: all .16s ease-in-out;
        }

        .hl:focus {
            outline: none;
            background: #ffffff;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(17, 104, 230, .18),
            0 4px 10px rgba(15, 23, 42, .08);
        }

        .hl[readonly] {
            background: linear-gradient(180deg, #e2e6ea 0%, #eef2f6 100%);
            border-color: #b7bec7;
            color: #374151;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .4);
        }

        textarea.hl {
            min-height: 110px;
            resize: vertical;
            white-space: pre-line;
        }


        .pill {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            border: 1px solid #cbd5e1;
            border-radius: 999px;
            background: #f9fafb;
            padding: .2rem .6rem;
            font-weight: 600;
            font-size: .78rem;
            color: #374151;
        }

        .badge {
            border: 1px solid #cbd5e1;
            border-radius: 999px;
            padding: .25rem .7rem;
            font-weight: 600;
            background: #f9fafb;
            font-size: .8rem;
        }

        .badge-warn {
            background: #fef9c3;
            border-color: #eab308;
        }


        .summary {
            display: flex;
            justify-content: space-between;
            margin-top: .65rem;
            gap: .75rem;
            flex-wrap: wrap;
        }

        .form-note {
            font-size: .82rem;
            color: var(--muted);
        }


        @media (max-width: 992px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .kv {
                grid-template-columns: 120px 1fr auto;
            }
        }

        @media (max-width: 768px) {
            .kv {
                grid-template-columns: 1fr;
                align-items: flex-start;
            }

            .summary {
                flex-direction: column;
                align-items: flex-start;
            }

            .pr-toolbar {
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }
    </style>
@endpush


@section('main')
    @php $cust=$invoice->user; @endphp
    <div class="container-fluid px-3 py-3">
        <div class="pr-wrap">
            <div class="pr-toolbar">
                <button type="button" class="btn btn-gray"
                        onclick="if (document.referrer) { window.location.href = document.referrer; } else { window.location.reload(true); }">
                    Back
                </button>
                <button type="button" class="btn btn-blue" id="btnSave">Save</button>
                <button type="button" class="btn btn-blue" id="btnSaveExit">Save and Exit</button>
            </div>

            <form id="paymentForm" class="pr-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="invoice_id" value="{{ $invoice->id }}">
                <input type="hidden" id="payment_id" value="{{ $payment->id }}">

                <div class="box">
                    <div class="box-h">Customer Details</div>
                    <div class="box-b grid">
                        <div>
                            <div class="kv">
                                <label class="muted">Customer Code:</label>
                                <input class="hl"
                                       value="{{ $cust->customer_no ?? ('U'.str_pad($cust->id,6,'0',STR_PAD_LEFT)) }}"
                                       readonly>
                                <button type="button" class="pill" disabled>A–Z</button>
                            </div>
                            <textarea class="hl" rows="6" readonly>{{ trim(($cust->name ?? '').' '.($cust->last_name ?? '')) }}
                                {{ $cust->company ?? '' }}
                                {{ $cust->address ?? '' }}
                                {{ $cust->city ?? '' }}
                                {{ $cust->postcode ?? '' }}</textarea>
                        </div>
                        <div>
                            <div class="kv">
                                <label class="muted">Payment Date:</label>
                                <input type="datetime-local" class="hl" name="payment_date"
                                       value="{{ $prefill['payment_date'] }}">
                                <span class="pill">📅</span>
                            </div>
                            <div class="kv">
                                <label class="muted">Payment Type:</label>
                                <select name="payment_type" class="hl" required>
                                    @foreach($types as $t)
                                        <option
                                            value="{{ $t }}" {{ (isset($prefill['payment_type']) && $prefill['payment_type']===$t)?'selected':'' }}>{{ $t }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="pill" disabled>A–Z</button>
                            </div>
                            <div class="kv">
                                <label class="muted">Payment Ref:</label>
                                <input name="payment_ref" class="hl" value="{{ $prefill['payment_ref'] }}" readonly>
                                <span></span>
                            </div>
                            <div class="kv">
                                <label class="muted">Payment From:</label>
                                <select name="payment_from" class="hl">
                                    <option {{ $prefill['payment_from']==='Customer'?'selected':'' }}>Customer</option>
                                    <option {{ $prefill['payment_from']==='Other'?'selected':'' }}>Other</option>
                                </select>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box" style="margin-top:1rem">
                    <div class="box-b">
                        <div class="kv">
                            <label class="muted">Payment Amount:</label>
                            <input name="amount" class="hl" inputmode="decimal" value="{{ $prefill['amount'] }}">
                            <span></span>
                        </div>
                        <hr>
                        <div class="grid">
                            <div>
                                <div class="box-h" style="border-radius:6px 6px 0 0">Transaction Details</div>
                                <div class="box-b">
                                    <div class="kv">
                                        <label class="muted">Date Transaction Cleared:</label>
                                        <input type="datetime-local" class="hl" name="cleared_at"
                                               value="{{ $prefill['payment_date'] }}">
                                        <span class="pill">📅</span>
                                    </div>
                                    <div class="form-note">Optional — for record only</div>
                                </div>
                            </div>
                            <div>
                                <div class="summary">
                                    <div class="badge text-dark">Amount Allocated: <b
                                            id="allocated">{{ $allocated }}</b></div>
                                    <div class="badge badge-warn text-dark">Amount Unallocated: <b
                                            id="unallocated">{{ $unallocated }}</b></div>
                                </div>
                                <div class="form-note" style="margin-top:.5rem">Outstanding = Invoice Gross −
                                    Allocated
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('paymentForm');
            const inv = document.getElementById('invoice_id') ? document.getElementById('invoice_id').value : null;
            const pid = document.getElementById('payment_id') ? document.getElementById('payment_id').value : null;
            const btnSave = document.getElementById('btnSave');
            const btnSaveExit = document.getElementById('btnSaveExit');
            const amountInput = document.querySelector('[name=amount]');
            const allocatedEl = document.getElementById('allocated');
            const unallocatedEl = document.getElementById('unallocated');

            function toNum(v) {
                const n = parseFloat((v || '').toString().replace(/,/g, ''));
                return isFinite(n) ? n : 0;
            }

            function fmt2(n) {
                return toNum(n).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            }

            function currentUnallocated() {
                return unallocatedEl ? toNum(unallocatedEl.textContent) : 0;
            }

            function setButtonsDisabled(state) {
                if (btnSave) btnSave.disabled = state;
                if (btnSaveExit) btnSaveExit.disabled = state;
            }

            function ensureAmountErrorElement() {
                let err = document.getElementById('amount-error');
                if (!err) {
                    const wrap = amountInput.closest('.kv') || amountInput.parentElement;
                    err = document.createElement('div');
                    err.id = 'amount-error';
                    err.className = 'invalid-feedback d-block';
                    if (wrap) wrap.appendChild(err);
                }
                return err;
            }

            function clearAmountError() {
                const err = document.getElementById('amount-error');
                if (err) err.remove();
                if (amountInput) amountInput.classList.remove('is-invalid');
            }

            function updateToolbarButtons() {
                const unalloc = currentUnallocated();
                const amt = amountInput ? toNum(amountInput.value) : 0;
                const shouldDisable = (unalloc <= 0.00001) || (amt <= 0.00001) || (amt > unalloc + 0.00001);
                setButtonsDisabled(shouldDisable);
            }

            function updateRemainingPreview() {
                if (!amountInput) return;

                const unalloc = currentUnallocated();
                const amt = toNum(amountInput.value);
                const remaining = Math.max(0, unalloc - amt);

                let preview = document.getElementById('remaining-preview');
                if (!preview) {
                    const wrap = amountInput.closest('.kv') || amountInput.parentElement;
                    preview = document.createElement('div');
                    preview.id = 'remaining-preview';
                    preview.className = 'form-note';
                    if (wrap) wrap.appendChild(preview);
                }
                preview.textContent = 'Remaining after this payment: ' + fmt2(remaining);

                clearAmountError();

                if (amt <= 0.00001) {
                    const err = ensureAmountErrorElement();
                    amountInput.classList.add('is-invalid');
                    err.textContent = 'Payment amount must be greater than zero.';
                } else if (amt > unalloc + 0.00001) {
                    const err = ensureAmountErrorElement();
                    amountInput.classList.add('is-invalid');
                    err.textContent = 'Amount cannot exceed the current unallocated (' + fmt2(unalloc) + ').';
                }

                updateToolbarButtons();
            }

            function refreshAlloc() {
                if (!inv) return;
                fetch('/crm/invoices/' + inv + '/payments?t=' + Date.now(), {
                    headers: {'Accept': 'application/json'},
                    cache: 'no-store'
                })
                    .then(r => r.json())
                    .then(j => {
                        const a = toNum(j.allocated), u = toNum(j.unallocated);
                        if (allocatedEl) allocatedEl.textContent = fmt2(a);
                        if (unallocatedEl) unallocatedEl.textContent = fmt2(u);
                        if (amountInput) amountInput.value = fmt2(u);
                        updateRemainingPreview();
                    })
                    .catch(() => {});
            }

            function csrf() {
                const m = document.querySelector('meta[name="csrf-token"]');
                if (m && m.content) return m.content;
                const t = form ? new FormData(form).get('_token') : null;
                return t || '';
            }

            function submit(exitAfter) {
                if (!form || !pid) return;

                const unalloc = currentUnallocated();
                const amt = amountInput ? toNum(amountInput.value) : 0;

                // sirf inline error + disable buttons, swal nahi
                if (amt <= 0.00001 || amt > unalloc + 0.00001) {
                    updateRemainingPreview();
                    amountInput && amountInput.focus();
                    return;
                }

                const fd = new FormData(form);
                fd.append('_method', 'PUT');

                setButtonsDisabled(true);

                Swal.fire({
                    title: 'Saving Payment...',
                    text: 'Please wait while we save your changes.',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch('/crm/invoice-payments/' + pid, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf(),
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: fd
                })
                    .then(r => {
                        if (!r.ok) return r.json().then(j => { throw j; });
                        return r.json();
                    })
                    .then(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Saved Successfully',
                            text: 'Your payment details have been updated.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            if (exitAfter && inv) {
                                window.location.href = '/crm/invoices/' + inv;
                            } else {
                                refreshAlloc();
                            }
                        });
                    })
                    .catch(err => {
                        let msg = 'Failed to save payment.';
                        if (err && err.errors) {
                            const k = Object.keys(err.errors)[0];
                            if (k && err.errors[k] && err.errors[k][0]) msg = err.errors[k][0];
                        } else if (err && err.message) {
                            msg = err.message;
                        }
                        Swal.fire({icon: 'error', title: 'Error', text: msg});
                    })
                    .finally(() => {
                        setButtonsDisabled(false);
                        updateToolbarButtons();
                    });
            }

            if (btnSave) btnSave.addEventListener('click', () => submit(false));
            if (btnSaveExit) btnSaveExit.addEventListener('click', () => submit(true));

            if (amountInput) {
                amountInput.addEventListener('input', updateRemainingPreview);
            }

            refreshAlloc();
            updateRemainingPreview();
        });
    </script>
@endpush

