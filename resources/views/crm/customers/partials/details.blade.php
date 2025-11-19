<form id="customerForm" action="{{ url()->current() }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="__save_quit" id="__save_quit" value="0">

    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">
                <i class="bi bi-building"></i> Customer Details
            </div>

            <label class="b2b-toggle">
                B2B Customer:
                <input type="checkbox" name="b2b_customer" class="form-check-input" data-f="b2b_customer"
                       value="1">
            </label>
        </div>

        <div class="grid-main">
            <div class="col-card">
                <div class="rowline">
                    <div class="label">Name:</div>
                    <div class="input">
                        <input class="fx" name="name" data-f="name" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Post Code:</div>
                    <div class="input">
                        <input class="fx" name="postal_code" data-f="postal_code_normalized" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Address 1:</div>
                    <div class="input">
                        <input class="fx" name="address" data-f="address" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Address 2:</div>
                    <div class="input">
                        <input class="fx" name="address2" data-f="address2" placeholder="">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Town:</div>
                    <div class="input">
                        <input class="fx" name="town" data-f="town" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">County:</div>
                    <div class="input">
                        <input class="fx" name="county" data-f="county" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Country:</div>
                    <div class="input">
                        <input class="fx" name="country" data-f="country" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Customer Group:</div>
                    <div class="input">
                        <input class="fx" name="customer_group" data-f="customer_group"
                               placeholder="Corporate Client">
                    </div>
                </div>
            </div>

            <div class="col-card">
                <div class="rowline">
                    <div class="label">Date Created:</div>
                    <div class="input">
                        <input class="fx" name="created_at" data-f="created_at" readonly placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Old Reference:</div>
                    <div class="input">
                        <input class="fx" name="old_reference" data-f="old_reference" placeholder="-">
                    </div>
                </div>
                <div class="rowline d-none">
                    <div class="label">Customer Status:</div>
                    <div class="input">
                        <select class="fx" name="status" data-f="status">
                            <option value="">-</option>
                            <option value="Customer">Customer</option>
                            <option value="Prospect">Prospect</option>
                            <option value="On Hold">On Hold</option>
                        </select>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Currency:</div>
                    <div class="input">
                        <select class="fx" name="currency" data-f="currency">
                            <option value="">-</option>
                            <option value="GBP">GBP (£)</option>
                            <option value="EUR">EUR (€)</option>
                            <option value="USD">USD ($)</option>
                        </select>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">External Login:</div>
                    <div class="input">
                        <input type="checkbox" class="form-check-input" name="external_login_checkbox"
                               id="external_login_checkbox">
                        <input type="hidden" name="external_login" data-f="external_login">
                    </div>
                </div>

                <div class="divider"></div>

                <div class="rowline">
                    <div class="label">Telephone:</div>
                    <div class="input">
                        <input class="fx" name="telephone" data-f="telephone" placeholder="-">
                        <a class="mini-btn d-none" href="#" data-call="telephone">CALL</a>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Fax:</div>
                    <div class="input">
                        <input class="fx" name="fax" data-f="fax" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Mobile:</div>
                    <div class="input">
                        <input class="fx" name="mobile" data-f="mobile" placeholder="-">
                        <div style="display:flex;gap:6px">
                            <a class="mini-btn d-none" href="#" data-call="mobile">CALL</a>
                            <a class="mini-btn d-none" href="#" data-sms="mobile">SMS</a>
                        </div>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Email:</div>
                    <div class="input">
                        <input class="fx" type="email" name="email" data-f="email" placeholder="-" readonly>
                        <div style="display:flex;gap:6px">
                            <a class="mini-btn" href="#" data-mail="email">E</a>
                        </div>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Website:</div>
                    <div class="input">
                        <input class="fx" type="url" name="website" data-f="website" placeholder="https://">
                    </div>
                </div>
            </div>
        </div>

        <div class="contacts-wrap mt-3">
            <div class="contacts-head">
                <div style="display:flex;align-items:center;gap:12px;">
                    <span>Contacts</span>

                    <label style="display:flex;align-items:center;gap:6px;font-size:0.85rem;">
                        <input type="checkbox" id="toggleContactsTable" class="form-check-input">

                    </label>
                </div>

                <button type="button" class="btn btn-sm btn-outline-secondary" id="btnAddContact">
                    <i class="bi bi-plus"></i> Add Contact
                </button>
            </div>

            <table class="contacts-table" id="contactsTable">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Direct Number</th>
                    <th>Direct Email</th>
                    <th>Mobile</th>
                    <th>Opt-out</th>
                    <th style="width:150px;">Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="mc-shell">
            <div>
                <div class="rowline" style="margin-top:.9rem;">
                    <div class="label">Staff Code:</div>
                    <div class="input">
                        <input class="fx" name="staff_code" data-f="staff_code" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Supervisor–Confirmer:</div>
                    <div class="input">
                        <input class="fx" name="supervisor_confirmer" data-f="supervisor_confirmer"
                               placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Source:</div>
                    <div class="input">
                        <input class="fx" name="source" data-f="source" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Source Affiliate:</div>
                    <div class="input">
                        <input class="fx" name="source_affiliate" data-f="source_affiliate" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Source Campaign:</div>
                    <div class="input">
                        <input class="fx" name="source_campaign" data-f="source_campaign" placeholder="-">
                    </div>
                </div>

                <div class="rowline" style="grid-template-columns:150px 1fr;margin-top:.9rem;">
                    <div class="label">Notes:</div>
                    <div class="input" style="padding:.3rem .6rem;">
                        <textarea class="fx notes-box" name="notes" data-f="notes" placeholder="-"></textarea>
                    </div>
                </div>
            </div>

            <div class="mc-card" id="mcCard">
                <div class="mc-header" id="mcHeader">
                    <span>Multi-Contacts</span>
                    <i class="bi bi-chevron-down" id="mcChevron"></i>
                </div>
                <div class="mc-body" id="mcBody">
                    <div class="mc-table">
                        <div class="mc-row">
                            <label>CCTV</label>
                            <input type="checkbox" name="ct_cctv" value="1">
                        </div>
                        <div class="mc-row">
                            <label>Close Protection</label>
                            <input type="checkbox" name="ct_close_protection" value="1">
                        </div>
                        <div class="mc-row">
                            <label>CSCS</label>
                            <input type="checkbox" name="ct_cscs" value="1">
                        </div>
                        <div class="mc-row">
                            <label>Door Supervisor</label>
                            <input type="checkbox" name="ct_door_supervisor" value="1">
                        </div>
                        <div class="mc-row">
                            <label>Fire Marshall</label>
                            <input type="checkbox" name="ct_fire_marshall" value="1">
                        </div>
                        <div class="mc-row">
                            <label>First Aid Courses</label>
                            <input type="checkbox" name="ct_first_aid" value="1">
                        </div>
                        <div class="mc-row">
                            <label>Vehicle Banksman</label>
                            <input type="checkbox" name="ct_vehicle_banksman" value="1">
                        </div>

                        <div class="mc-row">
                            <label>Letter</label>
                            <input type="checkbox" name="pm_letter" value="1">
                        </div>
                        <div class="mc-row">
                            <label>Email</label>
                            <input type="checkbox" name="pm_email" value="1">
                        </div>
                        <div class="mc-row">
                            <label>SMS</label>
                            <input type="checkbox" name="pm_sms" value="1">
                        </div>
                    </div>
                </div>
                <button type="button" class="mc-footer-btn" id="mcSelectedOnly">
                    Selected ONLY
                </button>
            </div>
        </div>
    </div>
</form>

