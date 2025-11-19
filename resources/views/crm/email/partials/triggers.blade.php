<div class="trigger-shell">
    <div class="trigger-shell-inner">
        <div class="trigger-shell-header">
            <div class="trigger-shell-title-main">
                <div class="trigger-shell-icon">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <div>
                    <div class="trigger-shell-text-title">
                        Triggers
                        <span>Automation rules</span>
                    </div>
                    <div class="trigger-shell-text-sub">
                        Define when emails should automatically fire for a given learner status or event.
                    </div>
                </div>
            </div>
            <div class="trigger-shell-meta">
                <div class="trigger-shell-meta-pill">
                    <i class="bi bi-diagram-3"></i>
                    <span>Connected to Email Templates</span>
                </div>
            </div>
        </div>

        <form id="triggerForm">
            @csrf
            <div class="trigger-form-grid">
                <div>
                    <label class="form-label-compact">Key</label>
                    <select class="form-control form-control-compact" name="key" id="trigger_key_select"></select>
                    <small class="field-hint">
                        Select learner-status keys or type a custom key.
                    </small>
                </div>

                <div>
                    <label class="form-label-compact">Entity</label>
                    <input class="form-control form-control-compact" name="entity" value="Course">
                </div>

                <div>
                    <label class="form-label-compact">Type</label>
                    <select class="form-control form-control-compact" name="type">
                        <option value="status">Status</option>
                        <option value="time">Time</option>
                        <option value="event">Event</option>
                    </select>
                </div>

                <div>
                    <label class="form-label-compact">Active</label>
                    <select class="form-control form-control-compact" name="active">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="trigger-form-footer">
                <div class="trigger-form-helper">
                    <i class="bi bi-info-circle"></i>
                    Triggers will only fire for courses that have an attached email template.
                </div>

                <button class="btn btn-primary btn-pill-primary" type="submit">
                    <i class="bi bi-plus-circle-fill"></i>
                    Create Trigger
                </button>
            </div>
        </form>
    </div>
</div>

<div class="trigger-table-shell mt-3">
    <div class="trigger-table-inner">
        <div class="trigger-table-header">
            <div class="trigger-table-header-left">
                <div>
                    <div class="trigger-table-title">Trigger List</div>
                    <div class="trigger-table-sub">Overview of all automation rules</div>
                </div>
            </div>
            <div class="trigger-table-header-right">
                <div class="trigger-count-pill">
                    <i class="bi bi-lightning-charge"></i>
                    <span id="triggerCountLabel">Active &amp; inactive</span>
                </div>
                <div class="trigger-table-filter-chip">
                    <i class="bi bi-sliders"></i>
                    <span>Sorted by key</span>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0" id="triggersTable">
                <thead>
                <tr>
                    <th scope="col">Key</th>
                    <th scope="col">Entity</th>
                    <th scope="col">Type</th>
                    <th scope="col">Active</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
