<h1>Logs</h1>
@if (count($logs))
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
            <td class="log-col-0"><span class="log-tag log-tag-{{ strtolower($log[0]) }}">{{ strtoupper($log[0]) }}</span></td>
            <td>{{ $log[1] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No log entries have been found for this request.</div>
@endif
