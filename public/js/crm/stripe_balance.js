(function () {
    function qs(id) {
        return document.getElementById(id);
    }

    function showEl(el) {
        if (el) el.style.display = 'block';
    }

    function hideEl(el) {
        if (el) el.style.display = 'none';
    }

    function renderBalance(res) {
        const div = qs('brResult');
        if (!div) return;

        if (!res || (!res.available && !res.pending)) {
            div.innerHTML = '';
            hideEl(div);
            return;
        }

        let html = '';
        html += '<div><b>Available</b></div>';
        if (res.available && res.available.length) {
            html += '<ul>';
            res.available.forEach(x => {
                html += '<li>' + Number(x.amount).toFixed(2) + ' ' + x.currency + '</li>';
            });
            html += '</ul>';
        } else {
            html += '<div>None</div>';
        }

        html += '<div style="margin-top:6px"><b>Pending</b></div>';
        if (res.pending && res.pending.length) {
            html += '<ul>';
            res.pending.forEach(x => {
                html += '<li>' + Number(x.amount).toFixed(2) + ' ' + x.currency + '</li>';
            });
            html += '</ul>';
        } else {
            html += '<div>None</div>';
        }

        div.innerHTML = html;
        showEl(div);
    }

    async function checkBalance() {
        const accEl = qs('br_account_id');
        const acc = accEl ? accEl.value.trim() : '';
        const url = acc ? '/crm/stripe/balance?account_id=' + encodeURIComponent(acc) : '/crm/stripe/balance';

        const r = await fetch(url, {headers: {'Accept': 'application/json'}});

        if (!r.ok) {
            const j = await r.json().catch(() => ({message: 'error'}));
            const err = qs('brErr');
            if (err) {
                err.textContent = j.message || 'error';
                showEl(err);
            }
            return;
        }

        const j = await r.json();
        renderBalance(j);
        const err = qs('brErr');
        if (err) {
            err.textContent = '';
            hideEl(err);
        }
    }

    async function verifyPasswordAndContinue() {
        const pwdInput = qs('verifyPasswordInput');
        const errBox = qs('verifyPasswordErr');
        const pwdModal = qs('passwordConfirmModal');
        const stripeModal = qs('stripeBRModal');

        if (!pwdInput) return;

        const password = pwdInput.value.trim();

        // basic required check
        if (!password) {
            if (errBox) {
                errBox.textContent = 'Password is required.';
                errBox.style.display = 'block';
            }
            return;
        }

        let respJson = {ok: false, message: 'Unable to verify'};
        try {
            const resp = await fetch('/crm/training-courses/verify-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({password})
            });
            respJson = await resp.json();
        } catch (e) {
            respJson = {ok: false, message: 'Network error'};
        }

        if (!respJson.ok) {
            if (errBox) {
                errBox.textContent = respJson.message || 'Incorrect password.';
                errBox.style.display = 'block';
            }
            return;
        }

        hideEl(pwdModal);

        pwdInput.value = '';
        if (errBox) {
            errBox.textContent = '';
            errBox.style.display = 'none';
        }

        if (stripeModal) {
            showEl(stripeModal);

            const msg = qs('brMsg');
            const err = qs('brErr');
            if (msg) {
                msg.textContent = '';
                hideEl(msg);
            }
            if (err) {
                err.textContent = '';
                hideEl(err);
            }
            const res = qs('brResult');
            if (res) {
                res.innerHTML = '';
                hideEl(res);
            }
        }
    }

    function wire() {
        const stripeModal = qs('stripeBRModal');
        const pwdModal = qs('passwordConfirmModal');

        const refundBtn = document.getElementById('btnStripeBR') || document.querySelector('.btn-stripe-br');
        if (refundBtn) {
            refundBtn.addEventListener('click', () => {
                if (pwdModal) {
                    showEl(pwdModal);

                    const errBox = qs('verifyPasswordErr');
                    if (errBox) {
                        errBox.textContent = '';
                        errBox.style.display = 'none';
                    }
                }
            });
        }

        const pwdCancel = qs('verifyPasswordCancel');
        if (pwdCancel && pwdModal) {
            pwdCancel.addEventListener('click', () => {
                hideEl(pwdModal);
            });
        }

        const pwdContinue = qs('verifyPasswordContinue');
        if (pwdContinue && pwdModal) {
            pwdContinue.addEventListener('click', verifyPasswordAndContinue);
        }

        const cancel = qs('brCancel');
        if (cancel && stripeModal) {
            cancel.addEventListener('click', () => hideEl(stripeModal));
        }

        const close = qs('brClose');
        if (close && stripeModal) {
            close.addEventListener('click', () => hideEl(stripeModal));
        }

        const checkBtn = qs('brCheck');
        if (checkBtn) {
            checkBtn.addEventListener('click', checkBalance);
        }
    }

    document.addEventListener('DOMContentLoaded', wire);
})();
