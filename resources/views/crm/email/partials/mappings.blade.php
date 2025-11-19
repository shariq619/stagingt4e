<div class="mapping-shell">
    <div class="mapping-shell-inner">
        <div class="mapping-shell-header">
            <div class="mapping-shell-title-main">
                <div class="mapping-shell-icon">
                    <i class="bi bi-link-45deg"></i>
                </div>
                <div>
                    <div class="mapping-shell-text-title">
                        Trigger–Template Mapping
                        <span>Routing rules</span>
                    </div>
                    <div class="mapping-shell-text-sub">
                        Choose which email template should fire when a specific trigger occurs.
                    </div>
                </div>
            </div>
            <div class="mapping-shell-meta">
                <div class="mapping-shell-meta-pill">
                    <i class="bi bi-lightning-charge"></i>
                    <span>Works with Triggers & Templates</span>
                </div>
            </div>
        </div>

        <form id="mappingForm">
            @csrf
            <div class="mapping-form-grid">
                <div>
                    <label class="form-label-compact">Trigger</label>
                    <select class="form-control form-control-compact" name="trigger_id" id="mf_trigger"></select>
                </div>

                <div>
                    <label class="form-label-compact">Template</label>
                    <select class="form-control form-control-compact" name="template_id" id="mf_template"></select>
                </div>

                <div class="d-none">
                    <label class="form-label-compact">Scope</label>
                    <select class="form-control form-control-compact" name="scope" id="mf_scope">
                        <option value="global">global</option>
                        <option value="category">category</option>
                        <option value="course">course</option>
                    </select>
                </div>

                <div class="d-none" id="group_course_category">
                    <label class="form-label-compact">Course Category</label>
                    <input class="form-control form-control-compact"
                           name="course_category"
                           id="mf_course_category"
                           placeholder="e.g. Health">
                </div>

                <div class="d-none" id="group_course_id">
                    <label class="form-label-compact">Course ID</label>
                    <input class="form-control form-control-compact"
                           name="course_id"
                           id="mf_course_id"
                           placeholder="ID">
                </div>

                <div class="d-none">
                    <label class="form-label-compact">Recipients JSON</label>
                    <input class="form-control form-control-compact"
                           name="recipients"
                           id="mf_recipients"
                           placeholder='[{"role":"user"},{"role":"admin"}]'>
                </div>

                <div>
                    <label class="form-label-compact">Enabled</label>
                    <select class="form-control form-control-compact" name="enabled">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div>
                    <label class="form-label-compact">Priority</label>
                    <input class="form-control form-control-compact"
                           name="priority"
                           value="100">
                </div>

                <div class="d-none">
                    <label class="form-label-compact">Learner Status (optional)</label>
                    <select class="form-control form-control-compact"
                            name="learner_status"
                            id="mf_learner_status">
                        <option value="">-- Any --</option>
                    </select>
                </div>
            </div>

            <div class="mapping-form-footer">
                <div class="mapping-form-helper">
                    <i class="bi bi-info-circle"></i>
                    Higher priority numbers win if multiple mappings match.
                </div>
                <button class="btn btn-primary btn-mapping-primary" type="submit">
                    <i class="bi bi-plus-circle-fill"></i>
                    Create Mapping
                </button>
            </div>
        </form>
    </div>
</div>

<div class="mapping-table-shell">
    <div class="mapping-table-inner">
        <div class="mapping-table-header">
            <div class="mapping-table-header-left">
                <div class="mapping-table-title">Mapping Rules</div>
                <div class="mapping-table-sub">Current trigger to template connections</div>
            </div>
            <div class="mapping-table-header-right">
                <div class="mapping-count-pill">
                    <i class="bi bi-diagram-3"></i>
                    <span id="mappingCountLabel">All mappings</span>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0" id="mappingsTable">
                <thead>
                <tr>
                    <th>Trigger</th>
                    <th>Template</th>
                    <th class="d-none">Scope</th>
                    <th>Priority</th>
                    <th>Enabled</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
