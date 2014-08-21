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
            <td>{{ $query[0] }}</td>
            <td>{{ $query[2] }}ms</td>
        </tr>
        @endforeach
    </tbody>
</table>
