<form id="delegateForm" action="{{ url()->current() }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="__save_quit" id="__save_quit" value="0">
    <div class="mb-2">
        <span class="chip d-none">Delegate Code: <span id="chip_code">-</span></span>
    </div>
    <div class="panel">
        <div class="grid-main">
            <div class="col">
                <div class="rowline">
                    <div class="label">Name:</div>
                    <div class="input">
                        <input class="fx" name="name" data-f="name" placeholder="-" autocomplete="off">
                        <input class="fx" name="last_name" data-f="last_name" placeholder="-" autocomplete="off">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Unknown Delegate Name:</div>
                    <div class="input">
                        <input class="fx" name="unknown_delegate_name" data-f="unknown_delegate_name"
                            placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">House Number:</div>
                    <div class="input">
                        <input class="fx" name="house_number" data-f="house_number" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">House Name:</div>
                    <div class="input">
                        <input class="fx" name="house_name" data-f="house_name" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Address:</div>
                    <div class="input">
                        <input class="fx" name="address" data-f="address" placeholder="-">
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
                    <div class="label">Post Code:</div>
                    <div class="input">
                        <input class="fx" name="postal_code" data-f="postal_code_normalized" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Years at Address:</div>
                    <div class="input">
                        <input class="fx" name="years_at_address" data-f="years_at_address" placeholder="-">
                    </div>
                </div>
                <div class="divider"></div>
                <div class="rowline">
                    <div class="label">Start Date:</div>
                    <div class="input">
                        <input type="date" class="fx" name="start_date" data-f="start_date">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">VLE:</div>
                    <div class="input">
                        <input class="fx" name="vle" data-f="vle" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">External Login:</div>
                    <div class="input">
                        <select class="fx" name="external_login" data-f="external_login">
                            <option value="">-</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Exclude From Course Level Check:</div>
                    <div class="input">
                        <select class="fx" name="exclude_from_level_check" data-f="exclude_from_level_check">
                            <option value="">-</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Third Party Reference:</div>
                    <div class="input">
                        <input class="fx" name="third_party_reference" data-f="third_party_reference"
                            placeholder="-">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="rowline" style="grid-template-columns:180px auto;">
                    <div class="label">Date Created:</div>
                    <div class="input">
                        <input class="fx" name="created_at" data-f="created_at" readonly placeholder="-">
                    </div>
                </div>
                <div class="rowline d-none" style="grid-template-columns:180px auto;">
                    <div class="label">Status:</div>
                    <div><span class="hL" data-bind="status">-</span></div>
                </div>
                <div class="rowline">
                    <div class="label">Old Reference:</div>
                    <div class="input">
                        <input class="fx" name="old_reference" data-f="old_reference" placeholder="-">
                    </div>
                </div>
                <div class="divider"></div>
                <div class="rowline">
                    <div class="label">Telephone:</div>
                    <div class="input">
                        <input class="fx" name="telephone" data-f="telephone" placeholder="-">
                        <a class="mini-btn" href="#" data-call="telephone">CALL</a>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Work Tel:</div>
                    <div class="input">
                        <input class="fx" name="work_tel" data-f="work_tel" placeholder="-">
                        <a class="mini-btn" href="#" data-call="work_tel">CALL</a>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Mobile:</div>
                    <div class="input">
                        <input class="fx" name="mobile" data-f="mobile" placeholder="-">
                        <span style="display:flex;gap:6px">
                            <a class="mini-btn" href="#" data-call="mobile">CALL</a>
                            <a class="mini-btn" href="#" data-sms="mobile">SMS</a>
                        </span>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Email:</div>
                    <div class="input">
                        <input class="fx" name="email" data-f="email" placeholder="-" type="email"
                            readonly>
                        <a class="mini-btn" href="#" data-mail="email">E</a>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Work Email:</div>
                    <div class="input">
                        <input class="fx" name="work_email" data-f="work_email" placeholder="-" type="email">
                        <a class="mini-btn d-none" href="#" data-mail="work_email">E</a>
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Date of Birth:</div>
                    <div class="input">
                        <input type="date" class="fx" name="dob" data-f="dob">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">NI Number:</div>
                    <div class="input">
                        <input class="fx" name="ni_number" data-f="ni_number" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Payroll Reference:</div>
                    <div class="input">
                        <input class="fx" name="payroll_reference" data-f="payroll_reference" placeholder="-">
                    </div>
                </div>
                <div class="divider"></div>
                <div class="rowline">
                    <div class="label">Job Type:</div>
                    <div class="input">
                        <input class="fx" name="job_type" data-f="job_type" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Hours Worked:</div>
                    <div class="input">
                        <input class="fx" name="hours_worked" data-f="hours_worked" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Nationality:</div>
                    <div class="input">
                        <input class="fx" name="nationality" data-f="nationality" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Salutation:</div>
                    <div class="input">
                        <input class="fx" name="salutation" data-f="salutation" placeholder="-">
                    </div>
                </div>
                <div class="rowline">
                    <div class="label">Job Title:</div>
                    <div class="input">
                        <input class="fx" name="job_title" data-f="job_title" placeholder="-">
                    </div>
                </div>
            </div>
            <div class="col" style="display:flex;flex-direction:column;align-items:center;gap:10px">
                <div class="avatar" id="avatar_wrap">
                    <img id="avatar_img" src="https://mytraining4employment.co.uk/images/Staff_Photo_Default.png"
                        alt="avatar" style="width:100%;height:100%;object-fit:cover">
                </div>
                <small class="text-muted">Delegate Code:
                    <strong id="side_code">-</strong>
                </small>
                <div class="input" style="width:100%;flex-wrap:wrap;gap:6px">
                    <label for="image" class="mini-btn" style="cursor:pointer">Upload</label>
                    <input type="file" id="image" name="image" accept="image/*" hidden>
                </div>
                <small class="text-muted" id="file_name" style="display:none;font-size:.8rem"></small>
            </div>
        </div>
        <div class="divider"></div>
        <div id="customerRow" class="rowline">
            <div class="label">Customer:</div>
            <div class="input">
                <select class="fx" name="client_id">
                    <option value="">Select Customer</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}"
                            {{ old('client_id', $customerId ?? ($delegate->client_id ?? null)) == $client->id ? 'selected' : '' }}>
                            {{ $client->name }} {{ $client->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="rowline">
            <div class="label">Owner:</div>
            <div class="input">
                <input class="fx" name="owner_id" data-f="owner_id" placeholder="-">
            </div>
        </div>
        <div class="rowline">
            <div class="label">Funder:</div>
            <div class="input">
                <input class="fx" name="funder" data-f="funder" placeholder="-">
            </div>
        </div>
        <div class="rowline">
            <div class="label">Source:</div>
            <div class="input">
                <input class="fx" name="source" data-f="source" placeholder="-">
            </div>
        </div>
        <div class="rowline">
            <div class="label">Staff Link:</div>
            <div class="input">
                <input class="fx" name="staff_link" data-f="staff_link" placeholder="-">
            </div>
        </div>
        <div class="rowline" style="grid-template-columns:180px 1fr;">
            <div class="label">Learner-Delegate Type:</div>
            <div class="input">
                <input class="fx" name="learner_delegate_type" data-f="learner_delegate_type" placeholder="-">
            </div>
        </div>
        <div class="rowline" style="grid-template-columns:180px 1fr;">
            <div class="label">Notes:</div>
            <div class="input" style="padding:0">
                <textarea class="fx" id="notes_box" name="notes" data-f="notes" style="min-height:110px;resize:vertical"
                    placeholder="-"></textarea>
            </div>
        </div>
    </div>
</form>
