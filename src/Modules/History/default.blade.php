<h1>Latest Request</h1>

<a href="{{ url('/anbu') }}" class="latest-request">View Latest Request</a>

<h1>Request History</h1>
@if (isset($history) && count($history))
<p>Click on a title to replay a request and view debug information.</p>
<table class="anbu-table">
    <thead>
        <tr>
            <th>Time</th>
            <th>URI</th>
        </tr>
    </thead>
    <tbody>
        @foreach($history as $storage)
        <tr>
            <?php $storage = $storage->toArray(); ?>
            <?php $date = new Carbon\Carbon($storage['created_at']); ?>
            <td><a href="{{ url('/anbu') .'/'. $storage['id'] }}">{{ $date->format('l jS F g:i:s A') }}</a><span class="friendly-time">({{ $date->diffForHumans() }})</span></td>
            <td class="code">{{ $storage['uri'] }}</td>
        </tr>
        @endforeach

    </tbody>
</table>
{{ $history->links() }}
@else
<div class="empty">No previous requests are present.</div>
@endif
