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
            <td class="code">{{ $binding[0] }}</td>
            <td class="code">{{ $binding[1] }}</td>
            <td class="{{ $binding[2] ? 'green' : 'red' }}">{{ $binding[2] ? 'true' : 'false' }}</td>
            <td>{{ $binding[3] }}ms</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No bindings were found for this request.</div>
@endif
