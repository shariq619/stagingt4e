<div class="email-template-shell">
    <div class="email-template-inner">
        <div class="email-template-header">
            <div class="email-template-title-main">
                <div class="email-template-icon">
                    <i class="bi bi-envelope-paper-fill"></i>
                </div>
                <div>
                    <div class="email-template-text-title">
                        Newsletter Composer
                        <span>Templates and recipients</span>
                    </div>
                    <div class="email-template-text-sub">
                        Create and manage reusable email layouts for your training communications.
                    </div>
                </div>
            </div>
            <div class="email-template-meta">
                <div class="email-template-meta-pill">
                    <i class="bi bi-diagram-3"></i>
                    <span>Connected to Email Triggers</span>
                </div>
            </div>
        </div>

        <div class="top-bar-wrap">
            <div class="top-bar-actions">
                <button class="btn-top btn-top-primary" id="tplSaveBtn">
                    <i class="bi bi-save"></i>
                    <span>Save Newsletter</span>
                </button>
                <button class="btn-top btn-top-gray" id="tplSaveDraftBtn">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Save Draft</span>
                </button>
                <button class="btn-top d-none" id="tplAttachBtn">
                    <i class="bi bi-paperclip"></i>
                    <span>Attach Files</span>
                </button>
                <button class="btn-top d-none" id="tplPlainBtn">
                    <i class="bi bi-file-earmark-code"></i>
                    <span>Plain Text</span>
                </button>
                <button class="btn-top" id="tplPreviewBtn">
                    <i class="bi bi-eye"></i>
                    <span>Preview</span>
                </button>
                <button class="btn-top d-none" id="tplSendBtn">
                    <i class="bi bi-send-fill"></i>
                    <span>Send Newsletter</span>
                </button>
                <button class="btn-top btn-top-gray" id="tplClearBtn">
                    <i class="bi bi-x-circle"></i>
                    <span>Clear</span>
                </button>
            </div>
        </div>

        <div class="email-template-body">
            <div class="flex-row">
                <div class="col-left">
                    <form id="templateForm" style="max-width:900px;">
                        @csrf

                        <div class="section-heading">Details</div>

                        <div class="row-tight">
                            <div class="col-md-6 form-group">
                                <label class="form-label-compact">Newsletter Name</label>
                                <input class="form-control" id="tpl_newsletter_name" name="newsletter_name"
                                       placeholder="Emergency First Aid reminder batch #42">
                            </div>

                            <div class="col-md-6 form-group d-none">
                                <label class="form-label-compact">Disable Footer Variant</label>
                                <div class="footer-variant-row">
                                    <select class="select-compact" id="tpl_footer_variant" name="footer_variant">
                                        <option value="">Default</option>
                                        <option value="no_marketing">No Marketing Footer</option>
                                        <option value="minimal">Minimal Footer</option>
                                    </select>
                                    <div class="footer-variant-note">from EMarketing Footer</div>
                                </div>
                            </div>
                        </div>

                        <div class="row-tight">
                            <div class="col-md-6 form-group">
                                <label class="form-label-compact">Subject</label>
                                <input class="form-control" id="tpl_subject" name="subject"
                                       placeholder="Reminder: Your course starts tomorrow at 9:00am">
                            </div>

                            <div class="col-md-6 d-none">
                                <label class="form-label-compact">Created By</label>
                                <div class="inline-duo">
                                    <div class="form-group w-fixed-180 mb-0">
                                        <input class="form-control" id="tpl_created_by_name" name="created_by_name"
                                               placeholder="John Smith">
                                    </div>
                                    <div class="form-group w-flex-grow mb-0">
                                        <input class="form-control" id="tpl_created_by_email" name="created_by_email"
                                               placeholder="john.smith@t4e-hub.co.uk">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-tight">
                            <div class="col-md-6 form-group d-none">
                                <label class="form-label-compact">Data Source</label>
                                <input class="form-control" id="tpl_data_source" name="data_source" value="TrainingCourse"
                                       placeholder="e.g. TrainingCourse / LeadList / Custom CSV">
                            </div>

                            <div class="col-md-6 d-none">
                                <label class="form-label-compact">From</label>
                                <div class="inline-duo">
                                    <div class="form-group w-fixed-180 mb-0">
                                        <input class="form-control" id="tpl_from_name" name="from_name"
                                               placeholder="Training 4 Employment">
                                    </div>
                                    <div class="form-group w-flex-grow mb-0">
                                        <input class="form-control" id="tpl_from_email" name="from_email"
                                               placeholder="no-reply@t4e-hub.co.uk">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-tight">
                            <div class="col-md-12 form-group d-none">
                                <label class="form-label-compact">Send To</label>
                                <div class="pill-input-area" id="tpl_to_area"></div>
                                <div class="addr-actions">
                                    <button class="addr-add-btn" data-field="to" type="button">A-Z</button>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="form-label-compact">CC To</label>
                                <div class="pill-input-area" id="tpl_cc_area"></div>
                                <div class="addr-actions">
                                    <button class="addr-add-btn" data-field="cc" type="button">Press Enter to mark Cc</button>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="form-label-compact">BCC To</label>
                                <div class="pill-input-area" id="tpl_bcc_area"></div>
                                <div class="addr-actions">
                                    <button class="addr-add-btn" data-field="bcc" type="button">Press Enter to mark Bcc</button>
                                </div>
                            </div>
                        </div>

                        <div class="row-tight">
                            <div class="col-md-6 form-group d-none">
                                <label class="form-label-compact">Mail Merge Field</label>
                                <select class="form-control" id="tpl_merge_field" name="merge_field" style="height:38px;">
                                    <option value="">Select...</option>
                                    <option value="DelegateName">@{{DelegateName}}</option>
                                    <option value="CourseDescription">@{{CourseDescription}}</option>
                                    <option value="CourseStartDateFull">@{{CourseStartDateFull}}</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="form-label-compact">Attachments</label>
                                <div id="tpl_attach_list" class="attachments-bar">
                                    <div class="attachments-empty">
                                        <i class="bi bi-paperclip" style="font-size:1.1rem;opacity:.6;margin-right:6px;"></i>
                                        Click to upload attachments
                                    </div>
                                </div>
                                <input type="file" id="tpl_asset" style="display:none;">
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="form-label-compact">Code</label>
                                <input class="form-control" id="tpl_code" name="code"
                                       placeholder="course.reminder.first_aid.2025">
                            </div>
                        </div>

                        <div class="section-heading" style="margin-top:16px;">Email Body</div>

                        <div class="editor-wrapper">
                            <div class="editor-toolbar-strip">
                                <div class="editor-toolbar-left">
                                    <div class="editor-toolbar-title">Insert Variable</div>
                                    <select id="tpl_var_insert"></select>
                                    <button type="button" id="tpl_var_help" class="editor-help-btn">Help</button>
                                </div>

                                <div class="editor-toolbar-right">
                                    <div class="bulk-insert-wrap">
                                        <button type="button" class="bulk-btn" id="bulkInsertBtn">
                                            Bulk insert
                                            <span class="caret">▼</span>
                                        </button>
                                        <div class="bulk-menu" id="bulkMenu"></div>
                                    </div>
                                    <button type="button" class="bulk-btn" id="tplFooterImgBtn">
                                        Add Footer Image
                                    </button>
                                </div>
                            </div>

                            <div class="editor-area">
                                <textarea id="tpl_editor_html" name="html_body" data-rich="1"
                                          placeholder="Dear @{{user.first_name}},&#10;&#10;This is a reminder for @{{course.title}} on @{{course.start_at}}.&#10;Please arrive 10 minutes early for registration.&#10;&#10;Thank you,&#10;Training 4 Employment"></textarea>
                            </div>

                            <div class="editor-mode-bar">
                                <button type="button" class="editor-mode-btn d-none" data-mode="design">Design</button>
                                <button type="button" class="editor-mode-btn d-none" data-mode="html">HTML</button>
                                <button type="button" class="editor-mode-btn" data-mode="preview" id="tplPreviewBtn2">
                                    Preview
                                </button>
                            </div>
                        </div>

                        <div id="tpl_plain_wrap" style="display:none;">
                            <div class="plain-head-row">
                                <span>Plain Text Version</span>
                                <small class="plain-head-hint">Shown if user's client can't render HTML</small>
                            </div>
                            <textarea id="tpl_plaintext" name="text_body"
                                      placeholder="Dear @{{user.first_name}},&#10;&#10;Reminder for @{{course.title}} on @{{course.start_at}}.&#10;Location: [Training Centre Address]&#10;&#10;Reply to this email if you have any questions.&#10;&#10;Thank you,&#10;Training 4 Employment"></textarea>
                        </div>

                        <div class="section-heading d-none" style="margin-top:24px;">Layout Wrapper</div>

                        <div class="row-tight d-none">
                            <div class="col-md-6 form-group">
                                <label class="form-label-compact">Layout HTML (wrapper)</label>
                                <textarea
                                    value="@{{content}}"
                                    class="form-control"
                                    id="tpl_layout_html"
                                    name="layout_html"
                                    style="min-height:160px;font-family:ui-monospace,monospace;font-size:12px;line-height:1.4;white-space:pre-wrap;"
                                    placeholder="<div style='font-family:sans-serif;color:#1f2937;font-size:14px;line-height:1.5'>
                                            @{{content}}
                                            <hr style='border:0;border-top:1px solid #e5e7eb;margin:24px 0'>
                                            <div style='font-size:12px;color:#6b7280;line-height:1.4;text-align:center'>
                                                <img src='https://jetbrains.com/crm/assets/img/logo.png' alt='Training4Employment' style='max-width:140px;display:block;margin:0 auto 8px auto'>
                                                Training4Employment · Automated Notification<br>
                                                Please do not reply directly to this email.
                                            </div>
                                            </div>"
                                ></textarea>

                                <div style="font-size:11px;color:#6b7280;margin-top:4px;line-height:1.4;">
                                    Must include
                                    <code style="font-size:11px;background:#f3f4f6;border:1px solid #d1d5db;border-radius:4px;padding:1px 4px;display:inline-block;">@{{content}}</code>
                                    exactly. The rendered email body will be injected in that spot.
                                </div>
                            </div>

                            <div class="col-md-6 form-group d-none">
                                <label class="form-label-compact">Layout Text (wrapper)</label>
                                <textarea
                                    class="form-control"
                                    id="tpl_layout_text"
                                    name="layout_text"
                                    style="min-height:160px;font-family:ui-monospace,monospace;font-size:12px;line-height:1.4;white-space:pre-wrap;"
                                    placeholder="@{{content}}

--
Training4Employment
Automated Notification
Please do not reply directly to this message."
                                ></textarea>

                                <div style="font-size:11px;color:#6b7280;margin-top:4px;line-height:1.4;">
                                    Must include
                                    <code style="font-size:11px;background:#f3f4f6;border:1px solid #d1d5db;border-radius:4px;padding:1px 4px;display:inline-block;">@{{content}}</code>.
                                    Plaintext fallback uses this wrapper.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="templates-table-wrap">
                    <div class="templates-shell">
                        <div class="templates-inner">
                            <div class="templates-header">
                                <div class="templates-header-left">
                                    <div class="templates-title">Templates</div>
                                    <div class="templates-sub">Saved versions for this newsletter code</div>
                                </div>
                                <div class="templates-header-right">
                                    <div class="templates-count-pill">
                                        <i class="bi bi-collection"></i>
                                        <span id="tplCountLabel">0 versions</span>
                                    </div>
                                    <div class="templates-badge-status">
                                        <i class="bi bi-check-circle"></i>
                                        <span id="tplActiveLabel">0 active</span>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sm table-hover align-middle mb-0" id="templatesTable">
                                    <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Version</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
