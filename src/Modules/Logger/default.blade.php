<h1>Logs</h1>
@if (isset($logs) && count($logs))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Type</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td class="log-col-0"><span class="log-tag log-tag-{{ strtolower($log['type']) }}">{{ strtoupper($log['type']) }}</span></td>
            <td>{{ $log['message'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No log entries have been found for this request.</div>
@endif
