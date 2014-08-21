<table class="anbu-table">
    <thead>
        <tr>
            <th>Request</th>
        </tr>
    </thead>
    <tbody>
        @foreach($history as $storage)
        <tr>
            <td><a href="/anbu/{{ $storage['id'] }}">{{ $storage['created_at'] }}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
