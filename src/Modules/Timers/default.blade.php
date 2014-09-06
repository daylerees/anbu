<h1>Timers</h1>
@if (isset($times) && count($times))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Key</th>
            <th>Execution Time</th>
            <th>Comment</th>
        </tr>
    </thead>
    <tbody>
        @foreach($times as $time)
        <tr>
            <td class="code">{{ $time['key'] }}</td>
            <td>{{ number_format($time['duration'], 5) }}ms</td>
            <td>{{ $time['comment'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No timers have been executed during this request.</div>
@endif
