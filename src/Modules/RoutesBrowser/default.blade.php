<h1>Current Route</h1>
<table class="anbu-table">
    <thead>
        <tr>
            <th>Method</th>
            <th>Path</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span class="method-tag method-tag-{{ strtolower($current['methods'][0]) }}">{{ $current['methods'][0] }}</span></td>
            <td class="code">{{ $current['path'] }}</td>
            <td class="code">{{ $current['name'] }}</td>
            <td class="code">{{ $current['action'] }}</td>
        </tr>
    </tbody>
</table>

<h1>Routing Table</h1>
@if (isset($routes) && count($routes))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Method</th>
            <th>Path</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach(array_reverse($routes) as $route)
        <tr>
            <td>
            @foreach ($route['methods'] as $method)
            <span class="method-tag method-tag-{{ strtolower($method) }}">{{ $method }}</span>
            @endforeach
            </td>
            <td class="code">{{ $route['path'] }}</td>
            <td class="code">{{ $route['name'] }}</td>
            <td class="code">{{ $route['action'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">There are no defined routes for this request.</div>
@endif
