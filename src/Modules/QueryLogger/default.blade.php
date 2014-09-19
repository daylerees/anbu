<h1>Queries</h1>
@if (isset($queries) && count($queries))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Query</th>
            <th>Bindings</th>
            <th>Execution Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($queries as $query)
        <tr>
            <td class="code">{{ $query['query'] }}</td>
            <td class="code" style="word-break: break-all;">{{ json_encode($query['bindings']) }}</td>
            <td>{{ number_format($query['time'], 2) }}ms</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No queries have been executed during this request.</div>
@endif
