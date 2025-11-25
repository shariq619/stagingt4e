(function () {
    const PUBLISHABLE = document.querySelector('meta[name="stripe-pk"]')?.getAttribute('content');
    if (!PUBLISHABLE || window.__stripePayWired) return;
    window.__stripePayWired = true;

    let stripe, elements, card;
    let modal, payBtn, cancelBtn, closeBtn, amtEl, curEl;
    let brModal, brRefundBtn, brCancelBtn, brCloseBtn, brPIEl, brAmtEl, brReasonEl, brAcctEl, brMsgEl, brErrEl;
    let invoiceId = null, progTimer = null, progressEl = null, backdropEl = null, fxHost = null;

    function qs(id) {
        return document.getElementById(id)
    }

    function show(el) {
        if (el) el.style.display = 'block'
    }

    function hide(el) {
        if (el) el.style.display = 'none'
    }

    function n(v) {
        return parseFloat(v) || 0
    }

    function getCsrf() {
        return $('meta[name="csrf-token"]').attr('content')
    }

    function resolveInvoiceId() {
        try {
            if (typeof window.invoiceId === 'function') return String(window.invoiceId() || '').trim() || null
        } catch {
        }
        if (window.INV_ID) return String(window.INV_ID).trim() || null;
        const m = document.querySelector('meta[name="invoice-id"]');
        if (m?.content) return String(m.content).trim() || null;
        const hid = qs('invoice_id');
        if (hid?.value) return String(hid.value).trim() || null;
        const host = document.querySelector('[data-invoice-id]') || document.querySelector('#invoiceView[data-id]');
        const val = host?.getAttribute('data-invoice-id') || host?.getAttribute('data-id');
        return val ? String(val).trim() : null
    }

    function ensureInvoiceIdOrThrow() {
        invoiceId = resolveInvoiceId() || invoiceId;
        if (!invoiceId) throw new Error('Missing invoice id');
        return invoiceId
    }

    function resetChargeModal() {
        const err = qs('stripe-card-errors');
        if (err) err.textContent = '';
        if (amtEl) amtEl.value = '';
        if (curEl) curEl.value = 'GBP';
        if (card?.clear) card.clear()
    }

    function resetRefundModal() {
        if (brPIEl) brPIEl.value = '';
        if (brAmtEl) brAmtEl.value = '';
        if (brReasonEl) brReasonEl.value = '';
        if (brAcctEl) brAcctEl.value = '';
        if (brMsgEl) {
            brMsgEl.textContent = '';
            brMsgEl.style.display = 'none'
        }
        if (brErrEl) {
            brErrEl.textContent = '';
            brErrEl.style.display = 'none'
        }
    }

    function ensureGlobalProgress() {
        let bar = qs('globalTopProgress');
        if (!bar) {
            bar = document.createElement('div');
            bar.id = 'globalTopProgress';
            document.body.appendChild(bar)
        }
        progressEl = bar
    }

    function ensureFX(host) {
        fxHost = host?.querySelector('.modal-content') || host || null;
        if (!fxHost) return;
        if (!fxHost.querySelector('.loading-backdrop')) {
            const b = document.createElement('div');
            b.className = 'loading-backdrop';
            b.innerHTML = '<div class="load-spinner"></div>';
            fxHost.appendChild(b)
        }
        backdropEl = fxHost.querySelector('.loading-backdrop')
    }

    function startProgress(btn, label, host) {
        ensureGlobalProgress();
        ensureFX(host);
        if (btn) {
            if (btn.dataset.busy === '1') return;
            btn.dataset.busy = '1';
            btn.classList.add('btn-busy');
            btn.setAttribute('disabled', 'disabled');
            btn.setAttribute('aria-busy', 'true');
            if (!btn.querySelector('.btn-loader')) {
                const l = document.createElement('span');
                l.className = 'btn-loader';
                l.innerHTML = '<i></i>';
                btn.appendChild(l)
            }
            if (label) {
                btn.dataset._oldText = btn.textContent;
                btn.textContent = label
            }
        }
        if (progressEl) {
            progressEl.classList.add('active');
            progressEl.classList.remove('almost')
        }
        if (backdropEl) backdropEl.classList.add('show');
        if (progTimer) clearInterval(progTimer);
        progTimer = setInterval(function () {
            if (progressEl && progressEl.classList.contains('active')) progressEl.classList.add('almost')
        }, 600)
    }

    function stopProgress(btn) {
        if (progTimer) clearInterval(progTimer);
        if (progressEl) progressEl.classList.remove('active', 'almost');
        if (backdropEl) backdropEl.classList.remove('show');
        if (btn) {
            btn.classList.remove('btn-busy');
            btn.removeAttribute('disabled');
            btn.removeAttribute('aria-busy');
            btn.dataset.busy = '';
            const loader = btn.querySelector('.btn-loader');
            if (loader) loader.remove();
            if (btn.dataset._oldText) {
                btn.textContent = btn.dataset._oldText;
                delete btn.dataset._oldText
            }
        }
    }

    function startGlobal(btn, label) {
        startProgress(btn, label, null)
    }

    function stopGlobal(btn) {
        stopProgress(btn)
    }

    function initElements() {
        stripe = Stripe(PUBLISHABLE);
        elements = stripe.elements();
        card = elements.create('card');
        card.mount('#stripe-card-element');
        card.on('change', function (e) {
            const err = qs('stripe-card-errors');
            if (err) err.textContent = e.error ? e.error.message : ''
        })
    }

    function outstanding() {
        const gross = n(qs('total_gross')?.value || '0');
        const bal = n(qs('invoice_balance')?.value || '0');
        return bal > 0.009 ? bal : gross
    }

    function getBalance() {
        return n(qs('invoice_balance')?.value || '0')
    }

    async function postJson(url, body) {
        const r = await fetch(url, {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCsrf()},
            body: JSON.stringify(body || {})
        });
        const j = await r.json().catch(() => ({}));
        if (!r.ok) throw new Error(j.message || 'error');
        return j
    }

    async function createIntent(amount, currency) {
        const id = ensureInvoiceIdOrThrow();
        return postJson(`/crm/invoices/${id}/stripe/intent`, {amount, currency})
    }

    async function allocate(pi) {
        const id = ensureInvoiceIdOrThrow();
        return postJson(`/crm/invoices/${id}/stripe/allocate`, {payment_intent: pi})
    }

    async function onPay() {
        startProgress(payBtn, 'Processing…', modal, false);

        let prevDisplay = '';
        let hiddenFor3DS = false;
        let resolved = false;

        try {
            const amount = parseFloat(amtEl.value || '0');
            const currency = curEl.value || 'GBP';
            if (!(amount > 0)) throw new Error('Enter a valid amount');

            const intent = await createIntent(amount, currency);

            const hideTimer = setTimeout(function () {
                if (resolved) return;
                if (modal && modal.style.display !== 'none') {
                    prevDisplay = modal.style.display || '';
                    modal.style.display = 'none';
                    hiddenFor3DS = true;
                }
            }, 1000);

            const res = await stripe.confirmCardPayment(intent.client_secret, {
                payment_method: { card }
            });

            resolved = true;
            clearTimeout(hideTimer);

            if (res.error) {
                if (modal && hiddenFor3DS) modal.style.display = prevDisplay || 'block';
                throw new Error(res.error.message || 'Card authorization failed');
            }

            const pi = res.paymentIntent;
            if (!pi) {
                if (modal && hiddenFor3DS) modal.style.display = prevDisplay || 'block';
                throw new Error('No payment intent returned');
            }

            if (pi.status === 'succeeded' || pi.status === 'processing') {
                await allocate(pi.id);
                resetChargeModal();
                hiddenFor3DS = false;

                if (modal) hide(modal);

                if (window.Swal) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        timer: 1700,
                        showConfirmButton: false,
                        title: 'Payment captured',
                        icon: 'success'
                    });
                }

                if (typeof fetchPayments === 'function') {
                    fetchPayments().then(function (p) {
                        if (typeof recalcAllClient === 'function') {
                            recalcAllClient(p.allocated);
                        }
                    });
                }
            } else {
                if (modal && hiddenFor3DS) modal.style.display = prevDisplay || 'block';
                throw new Error('Payment not completed (status: ' + pi.status + ')');
            }
        } catch (e) {
            const err = qs('stripe-card-errors');
            if (err) err.textContent = e.message || 'Error';
        } finally {
            stopProgress(payBtn);
        }
    }

    async function refundPayment(rowBtn, paymentId) {
        const tr = rowBtn.closest('tr');
        if (tr) tr.classList.add('refunding');
        rowBtn.setAttribute('disabled', 'disabled');
        rowBtn.insertAdjacentHTML('beforeend', ' <span class="badge-refunding">Refunding…</span>');
        startGlobal(rowBtn, 'Refunding…');
        try {
            const id = ensureInvoiceIdOrThrow();
            await postJson(`/crm/invoices/${id}/stripe/refund`, {payment_id: paymentId});
            if (window.Swal) Swal.fire({
                toast: true,
                position: 'top-end',
                timer: 1700,
                showConfirmButton: false,
                title: 'Refund issued',
                icon: 'success'
            });
            if (typeof fetchPayments === 'function') await fetchPayments()
        } catch (e) {
            if (window.Swal) Swal.fire({icon: 'error', title: 'Refund failed', text: e.message || 'Error'})
        } finally {
            if (tr) tr.classList.remove('refunding');
            rowBtn.removeAttribute('disabled');
            const b = rowBtn.querySelector('.badge-refunding');
            if (b) b.remove();
            stopGlobal(rowBtn)
        }
    }

    function confirmPay() {
        const amount = amtEl ? parseFloat(amtEl.value || '0') : 0;
        const currency = curEl?.value || 'GBP';
        if (window.Swal) {
            Swal.fire({
                icon: 'question',
                title: 'Proceed with charge?',
                html: `<div style="font-size:15px">Amount <b>${(amount || 0).toFixed(2)} ${currency}</b> will be charged.</div>`,
                showCancelButton: true,
                confirmButtonText: 'Charge now',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusConfirm: true,
                customClass: {confirmButton: 'swal2-confirm', cancelButton: 'swal2-cancel', popup: 'swal2-modern'}
            }).then(function (res) {
                if (res.isConfirmed) onPay()
            })
        } else {
            if (confirm('Proceed with charge?')) onPay()
        }
    }

    function confirmInlineRefund(go) {
        if (window.Swal) {
            Swal.fire({
                icon: 'warning',
                title: 'Issue refund?',
                html: '<div style="font-size:15px">This will refund the payment.</div>',
                showCancelButton: true,
                confirmButtonText: 'Refund',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {confirmButton: 'swal2-confirm', cancelButton: 'swal2-cancel', popup: 'swal2-modern'}
            }).then(function (res) {
                if (res.isConfirmed) go()
            })
        } else {
            const ok = confirm('Issue refund?');
            if (ok) go()
        }
    }

    function confirmModalRefund(execute) {
        const pid = (brPIEl?.value || '').trim();
        const amount = brAmtEl?.value ? parseFloat(brAmtEl.value) : null;
        const aTxt = amount && amount > 0 ? `<div style="margin-top:4px">Amount <b>${amount.toFixed(2)}</b></div>` : '';
        if (window.Swal) {
            Swal.fire({
                icon: 'warning',
                title: 'Confirm refund',
                html: `<div style="font-size:15px">PI: <b>${pid || '-'}</b>${aTxt}</div>`,
                showCancelButton: true,
                confirmButtonText: 'Refund',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {confirmButton: 'swal2-confirm', cancelButton: 'swal2-cancel', popup: 'swal2-modern'}
            }).then(function (res) {
                if (res.isConfirmed) execute()
            })
        } else {
            const ok = confirm('Confirm refund');
            if (ok) execute()
        }
    }

    function wire() {
        invoiceId = resolveInvoiceId() || null;

        modal = qs('stripeModal');
        payBtn = qs('stripePayBtn');
        cancelBtn = qs('stripeCancel');
        closeBtn = qs('stripeClose');
        amtEl = qs('stripe_amount');
        curEl = qs('stripe_currency');
        brModal = qs('stripeBRModal');
        brRefundBtn = qs('brRefund');
        brCancelBtn = qs('brCancel');
        brCloseBtn = qs('brClose');
        brPIEl = qs('br_pi');
        brAmtEl = qs('br_amount');
        brReasonEl = qs('br_reason');
        brAcctEl = qs('br_account_id');
        brMsgEl = qs('brMsg');
        brErrEl = qs('brErr');

        if (payBtn) payBtn.addEventListener('click', function (e) {
            e.preventDefault();
            confirmPay()
        }, {passive: false});
        if (cancelBtn) cancelBtn.addEventListener('click', function () {
            hide(modal);
            resetChargeModal()
        });
        if (closeBtn) closeBtn.addEventListener('click', function () {
            hide(modal);
            resetChargeModal()
        });

        if (brRefundBtn) {
            brRefundBtn.addEventListener('click', async function () {
                if (brRefundBtn.dataset.busy === '1') return;
                if (brMsgEl) brMsgEl.style.display = 'none';
                if (brErrEl) brErrEl.style.display = 'none';
                const execute = async function () {
                    ensureFX(brModal);
                    startProgress(brRefundBtn, 'Refunding…', brModal);
                    try {
                        ensureInvoiceIdOrThrow();
                        const id = (brPIEl?.value || '').trim();
                        const amount = brAmtEl?.value ? parseFloat(brAmtEl.value) : null;
                        const reason = (brReasonEl?.value || '').trim() || null;
                        const account_id = (brAcctEl?.value || '').trim() || null;
                        if (!id) throw new Error('Enter Payment ID');
                        const payload = {payment_intent: id};
                        if (amount && amount > 0) payload.amount = amount;
                        if (reason) payload.reason = reason;
                        if (account_id) payload.account_id = account_id;
                        const inv = ensureInvoiceIdOrThrow();
                        const r = await postJson(`/crm/invoices/${inv}/stripe/refund`, payload);
                        if (window.Swal) Swal.fire({
                            toast: true,
                            position: 'top-end',
                            timer: 1700,
                            showConfirmButton: false,
                            title: 'Refund issued',
                            icon: 'success'
                        });
                        if (brMsgEl) {
                            brMsgEl.textContent = 'Refund successful';
                            brMsgEl.style.display = 'block'
                        }
                        if (typeof fetchPayments === 'function') {
                            fetchPayments().then(function (p) {
                                if (typeof recalcAllClient === 'function') recalcAllClient(p.allocated);
                                if (typeof window.setAddPaymentState === 'function') window.setAddPaymentState(getBalance(), !!p.fully_paid)
                            })
                        } else {
                            if (typeof window.setAddPaymentState === 'function') window.setAddPaymentState(getBalance(), false)
                        }
                        hide(brModal);
                        resetRefundModal()
                    } catch (e) {
                        if (brErrEl) {
                            brErrEl.textContent = e.message || 'Error';
                            brErrEl.style.display = 'block'
                        }
                    } finally {
                        stopProgress(brRefundBtn)
                    }
                };
                confirmModalRefund(execute)
            })
        }
        if (brCancelBtn) brCancelBtn.addEventListener('click', function () {
            hide(brModal);
            resetRefundModal()
        });
        if (brCloseBtn) brCloseBtn.addEventListener('click', function () {
            hide(brModal);
            resetRefundModal()
        });

        const hookBtn = qs('btnTakePayment');
        if (hookBtn) {
            hookBtn.addEventListener('click', function () {
                invoiceId = resolveInvoiceId() || invoiceId;
                if (!invoiceId) {
                    alert('Missing invoice id');
                    return
                }
                if (!stripe) initElements();
                resetChargeModal();
                if (amtEl) amtEl.value = Math.max(0, outstanding()).toFixed(2);
                if (curEl) curEl.value = (qs('currency_in')?.value || 'GBP');
                ensureFX(modal);
                show(modal)
            })
        }

        document.addEventListener('click', function (e) {
            const trg = e.target.closest('[data-action="refund"]');
            if (!trg) return;
            e.preventDefault();
            e.stopPropagation();
            if (trg.tagName === 'BUTTON' && trg.type !== 'button') trg.type = 'button';
            if (trg.dataset.busy === '1' || trg.dataset.confirming === '1') return;
            const pid = trg.getAttribute('data-id');
            if (!pid) return;
            trg.dataset.confirming = '1';
            const go = function () {
                trg.dataset.confirming = '';
                refundPayment(trg, pid)
            };
            confirmInlineRefund(go)
        });

        document.addEventListener('submit', function (e) {
            if (e.target.querySelector('[data-action="refund"]')) {
                e.preventDefault();
                e.stopPropagation()
            }
        }, true)
    }

    document.addEventListener('DOMContentLoaded', wire);
})();

