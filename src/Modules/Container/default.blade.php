<h1>Container Bindings</h1>
@if (isset($bindings) && count($bindings))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Binding</th>
            <th>Type</th>
            <th>Resolved</th>
            <th>Resolution</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bindings as $binding)
        <tr>
            <td class="code">{{ $binding['id'] }}</td>
            <td class="code">{{ $binding['description'] }}</td>
            <td class="{{ $binding['resolved'] ? 'green' : 'red' }}">{{ $binding['resolved'] ? 'true' : 'false' }}</td>
            <td>{{ $binding['time'] }}ms</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No bindings were found for this request.</div>
@endif
