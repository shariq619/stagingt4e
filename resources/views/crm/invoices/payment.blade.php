@extends('crm.layout.main')
@section('title','Payment Receipt Create')

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
            --green: #16a34a;
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
            box-shadow:
                0 20px 45px rgba(15, 23, 42, .14),
                0 0 0 1px rgba(255,255,255,.8);
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
            box-shadow:
                inset 0 1px 0 #fff,
                inset 0 -1px 0 #e4e7ec;
            font-size: 12px;
            color: var(--ink);
            transition: all .16s ease-in-out;
        }

        .hl:focus {
            outline: none;
            background: #ffffff;
            border-color: var(--accent);
            box-shadow:
                0 0 0 3px rgba(17, 104, 230, .18),
                0 4px 10px rgba(15, 23, 42, .08);
        }

        .hl[readonly] {
            background: linear-gradient(180deg, #e2e6ea 0%, #eef2f6 100%);
            border-color: #b7bec7;
            color: #374151;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.4);
        }

        .hl-wrapper {
            width: 100%;
            display: block;
            position: relative;
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

        .is-invalid {
            border-color: var(--danger) !important;
            box-shadow: 0 0 0 1px rgba(239, 68, 68, .35) !important;
        }

        .invalid-feedback {
            display: block;
            font-size: .78rem;
            color: var(--danger);
            margin-top: .15rem;
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
                <div class="box">
                    <div class="box-h">Customer Details</div>
                    <div class="box-b grid">
                        <div>
                            <div class="kv">
                                <label class="muted">Customer Code:</label>
                                <input class="hl"
                                       value="{{ $cust->customer_no ?? ('U'.str_pad($cust->id,6,'0',STR_PAD_LEFT)) }}"
                                       readonly>
                                <button type="button" class="pill d-none">A–Z</button>
                            </div>
                            <textarea class="hl" rows="6" readonly>
                                {{ trim(($cust->name ?? '').' '.($cust->last_name ?? '')) }}
                                {{ $cust->company ?? '' }}
                                {{ $cust->address ?? '' }}
                                {{ $cust->city ?? '' }}
                                {{ $cust->postcode ?? '' }}
                            </textarea>
                        </div>
                        <div>
                            <div class="kv">
                                <label class="muted">Payment Date:</label>
                                <input type="datetime-local" class="hl" name="payment_date"
                                       value="{{ $prefill['payment_date'] }}">
                                <span class="pill d-none">📅</span>
                            </div>
                            <div class="kv">
                                <label class="muted">Payment Type:</label>
                                <select name="payment_type" class="hl" required>
                                    @foreach(paymentTypes() as $t)
                                        <option
                                            value="{{ $t }}" {{ (isset($prefill['payment_type']) && $prefill['payment_type']===$t)?'selected':'' }}>{{ $t }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="pill d-none">A–Z</button>
                            </div>
                            <div class="kv">
                                <label class="muted">Payment Ref:</label>
                                <div class="hl-wrapper">
                                    <input name="payment_ref" class="hl" placeholder="Auto e.g. PR010774" value="">
                                </div>
                                <span></span>
                            </div>
                            <div class="kv">
                                <label class="muted">Payment From:</label>
                                <select name="payment_from" class="hl">
                                    <option {{ $prefill['payment_from']==='Customer'?'selected':'' }}>Customer</option>
                                    <option {{ $prefill['payment_from']==='Other'?'selected':'' }}>Other</option>
                                </select>
                                <span class="muted d-none">VAT Analysis:</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box" style="margin-top:1rem">
                    <div class="box-b">
                        <div class="kv">
                            <label class="muted">Payment Amount:</label>
                            <div class="hl-wrapper">
                                <input name="amount" class="hl" inputmode="decimal" value="{{ $prefill['amount'] }}">
                            </div>
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
                                        <span class="pill d-none">📅</span>
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
                                <div class="form-note" style="margin-top:.5rem">Outstanding = Invoice Gross − Allocated.
                                    Paying more than outstanding will be blocked.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="invoice_id" value="{{ $invoice->id }}">
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function () {
            const form = $('#paymentForm');
            const invId = document.getElementById('invoice_id').value;
            const $btnSave = $('#btnSave');
            const $btnSaveExit = $('#btnSaveExit');
            const $allocatedEl = $('#allocated');
            const $unallocatedEl = $('#unallocated');
            const $amountInput = $('[name=amount]');
            const $paymentRef = $('[name=payment_ref]');

            function toNumber(v) {
                if (v === null || v === undefined) return 0;
                if (typeof v === 'number') return isFinite(v) ? v : 0;
                const s = String(v).replace(/,/g, '').trim();
                const n = parseFloat(s);
                return isFinite(n) ? n : 0;
            }

            function fmt2(n) {
                return (toNumber(n)).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function currentUnallocated() {
                return toNumber($unallocatedEl.text());
            }

            function setButtonsDisabled(state) {
                $btnSave.prop('disabled', state);
                $btnSaveExit.prop('disabled', state);
            }

            function handleFullyPaid(unalloc) {
                if (unalloc <= 0.00001) {
                    if ($amountInput.length) {
                        $amountInput.val(fmt2(0));
                        $amountInput.prop('disabled', true);
                        $amountInput.removeClass('is-invalid');
                        const wrap = $amountInput.closest('.hl-wrapper');
                        if (wrap.length) {
                            wrap.find('.invalid-feedback').remove();
                        }
                    }
                    let preview = document.getElementById('remaining-preview');
                    if (!preview && $amountInput.length) {
                        const wrap = $amountInput.closest('.hl-wrapper');
                        preview = document.createElement('div');
                        preview.id = 'remaining-preview';
                        preview.className = 'form-note';
                        wrap.append(preview[0] || preview);
                    }
                    if (preview) {
                        preview.textContent = 'Invoice fully paid.';
                    }
                    setButtonsDisabled(true);
                    return true;
                }
                if ($amountInput.prop('disabled')) {
                    $amountInput.prop('disabled', false);
                }
                return false;
            }

            function updateToolbarButtons() {
                const unalloc = currentUnallocated();
                if (unalloc <= 0.00001) {
                    setButtonsDisabled(true);
                    return;
                }
                const amt = toNumber($amountInput.val());
                const hasError = amt <= 0.00001 || amt > unalloc + 0.00001 || $amountInput.hasClass('is-invalid');
                setButtonsDisabled(hasError);
            }

            async function refreshBalances() {
                const url = `/crm/invoices/${invId}/payments?t=${Date.now()}`;
                const res = await fetch(url, {
                    method: 'GET',
                    headers: {'Accept': 'application/json'},
                    cache: 'no-store'
                });
                if (!res.ok) throw new Error('Failed to refresh balances');
                const j = await res.json();
                const allocated = toNumber(j.allocated);
                const unallocated = toNumber(j.unallocated);
                $allocatedEl.text(fmt2(allocated));
                $unallocatedEl.text(fmt2(unallocated));
                if (handleFullyPaid(unallocated)) {
                    return {allocated, unallocated};
                }
                $amountInput.val(fmt2(unallocated));
                if (form.data('validator')) {
                    $amountInput.valid();
                }
                updateRemainingPreview();
                updateToolbarButtons();
                return {allocated, unallocated};
            }

            function updateRemainingPreview() {
                const unalloc = currentUnallocated();
                const amt = toNumber($amountInput.val());
                let preview = document.getElementById('remaining-preview');
                if (!preview) {
                    const wrap = $amountInput.closest('.hl-wrapper');
                    preview = document.createElement('div');
                    preview.id = 'remaining-preview';
                    preview.className = 'form-note';
                    wrap.append(preview[0] || preview);
                }
                if (unalloc <= 0.00001) {
                    preview.textContent = 'Invoice fully paid.';
                    $amountInput.removeClass('is-invalid');
                    setButtonsDisabled(true);
                    return;
                }
                const remaining = Math.max(0, unalloc - amt);
                preview.textContent = `Remaining after this payment: ${fmt2(remaining)}`;
                if (amt <= 0.00001 || amt > unalloc + 0.00001) {
                    $amountInput.addClass('is-invalid');
                } else {
                    $amountInput.removeClass('is-invalid');
                }
                updateToolbarButtons();
            }

            $.validator.methods.number = function (value, element) {
                if (typeof value === 'string') value = value.replace(/,/g, '').trim();
                return this.optional(element) || (value !== '' && !isNaN(value) && !isNaN(parseFloat(value)));
            };

            $.validator.methods.min = function (value, element, param) {
                if (typeof value === 'string') value = value.replace(/,/g, '').trim();
                if (this.optional(element)) return true;
                const v = parseFloat(value);
                if (isNaN(v)) return false;
                return v >= param;
            };

            $.validator.methods.max = function (value, element, param) {
                if (typeof value === 'string') value = value.replace(/,/g, '').trim();
                if (this.optional(element)) return true;
                const v = parseFloat(value);
                if (isNaN(v)) return false;
                return v <= param;
            };

            form.validate({
                ignore: [],
                rules: {
                    payment_date: {required: true},
                    payment_type: {required: true},
                    payment_ref: {
                        required: true,
                        maxlength: 40,
                        remote: {
                            url: "{{ route('crm.payments.validateRef') }}",
                            type: "GET",
                            data: {
                                payment_ref: function () {
                                    return $paymentRef.val().trim();
                                }
                            }
                        }
                    },
                    amount: {
                        required: true,
                        number: true,
                        min: 0.01,
                        max: function () {
                            return currentUnallocated() + 0.00001;
                        }
                    }
                },
                messages: {
                    payment_date: {required: "Please select a payment date."},
                    payment_type: {required: "Please select a payment type."},
                    payment_ref: {
                        required: "Payment Ref is required.",
                        remote: "This payment reference already exists."
                    },
                    amount: {
                        required: "Enter an amount.",
                        number: "Enter a valid number.",
                        min: "Amount must be at least 0.01",
                        max: function () {
                            return "Amount cannot exceed the current unallocated (" + currentUnallocated().toFixed(2) + ").";
                        }
                    }
                },
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                highlight: function (e) {
                    $(e).addClass('is-invalid');
                    updateToolbarButtons();
                },
                unhighlight: function (e) {
                    $(e).removeClass('is-invalid');
                    updateToolbarButtons();
                },
                errorPlacement: function (err, el) {
                    const wrap = $(el).closest('.hl-wrapper');
                    if (wrap.length) {
                        wrap.find('.invalid-feedback').remove();
                        err.appendTo(wrap);
                    } else {
                        err.insertAfter(el);
                    }
                    updateToolbarButtons();
                }
            });

            $amountInput.on('input', function () {
                updateRemainingPreview();
                if (form.data('validator')) {
                    $amountInput.valid();
                }
            });

            async function post(exitAfter) {
                if (!form.valid()) {
                    updateRemainingPreview();
                    return;
                }
                setButtonsDisabled(true);
                const fd = new FormData(form[0]);
                try {
                    const r = await fetch(`/crm/invoices/${invId}/payments`, {
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': fd.get('_token'), 'Accept': 'application/json'},
                        body: fd,
                        cache: 'no-store'
                    });
                    if (!r.ok) {
                        const j = await r.json().catch(() => ({}));
                        throw new Error(j.message || 'Failed to save payment');
                    }
                    await Swal.fire({
                        icon: 'success',
                        title: 'Payment Saved',
                        text: 'The payment has been saved successfully.',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    await refreshBalances();
                    if (exitAfter) location.href = `/crm/invoices/${invId}`;
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: e.message || 'Something went wrong while saving the payment.'
                    });
                } finally {
                    setButtonsDisabled(false);
                    updateToolbarButtons();
                }
            }

            document.getElementById('btnSave').addEventListener('click', () => post(false));
            document.getElementById('btnSaveExit').addEventListener('click', () => post(true));

            handleFullyPaid(currentUnallocated());
            updateRemainingPreview();
            refreshBalances().catch(() => {
                updateToolbarButtons();
            });
        })();
    </script>
@endpush
