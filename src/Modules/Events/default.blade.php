<h1>Events</h1>
@if (isset($events) && count($events))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Type</th>
            <th>Fired</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td class="code">{{ $event[0] }}</td>
            <td>{{ number_format($event[1], 3) }}ms</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No events were fired during this request.</div>
@endif
