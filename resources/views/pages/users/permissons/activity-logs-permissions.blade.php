<h5 class="fw-bold mb-3">
    <input class="form-check-input me-2" type="checkbox" id="toggleActivityLogsSection" name="permissions[toggle_Activity_LogsSection]" value="1"
        {{ isset($permissionsArray['toggle_Activity_LogsSection']) && $permissionsArray['toggle_Activity_LogsSection'] == 1 ? 'checked' : '' }}>
    Activity Logs 
</h5>
<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input activity-logs-section-checkbox" type="checkbox" id="myActivityLogs" name="permissions[my_activity_logs]" value="1"
                {{ isset($permissionsArray['my_activity_logs']) && $permissionsArray['my_activity_logs'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="myActivityLogs">My Activity Logs</label>
        </div>
        <div class="form-check">
            <input class="form-check-input activity-logs-section-checkbox" type="checkbox" id="allActivityLogs" name="permissions[all_activity_logs]" value="1"
                {{ isset($permissionsArray['all_activity_logs']) && $permissionsArray['all_activity_logs'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="allActivityLogs">All Activity Logs</label>
        </div>
    </div>
</div>