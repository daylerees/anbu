<h1>Database Queries</h1>
@if (count($queries))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Query</th>
            <th>Execution Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($queries as $query)
        <tr>
            <td class="code">{{ $query[0] }}</td>
            <td>{{ $query[2] }}ms</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No queries have been executed during this request.</div>
@endif
