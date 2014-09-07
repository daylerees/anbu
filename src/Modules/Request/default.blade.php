<h1>Request Information</h1>
<h2>Request Data</h2>
@if (isset($request) && count($request))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Key</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($request as $key => $value)
        <tr>
            <td>{{ $key }}</td>
            <td>{{ str_limit($value) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty"><i class="fa fa-exclamation-triangle"></i>No data has been provided with this request.</div>
@endif

<h2>Request Headers</h2>
@if (isset($requestHeaders) && count($requestHeaders))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requestHeaders as $key => $value)
        <tr>
            <td>{{ $key }}</td>
            <td class="code">{{ str_limit($value[0]) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No headers are attached to this request.</div>
@endif

<h2>Response Headers</h2>
@if (isset($responseHeaders) && count($responseHeaders))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($responseHeaders as $key => $value)
        <tr>
            <td>{{ $key }}</td>
            <td class="code">{{ str_limit($value[0]) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No headers are attached to this request.</div>
@endif

<h2>Server Variables</h2>
@if (isset($server) && count($server))
<table class="anbu-table">
    <thead>
        <tr>
            <th>Key</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($server as $key => $value)
        <tr>
            <td>{{ $key }}</td>
            <td class="code">{{ str_limit($value) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No server variables are present within this request.</div>
@endif
