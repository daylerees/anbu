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
            <td class="anbu-log-type">{{ $log[0] }}</td>
            <td>{{ $log[1] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
