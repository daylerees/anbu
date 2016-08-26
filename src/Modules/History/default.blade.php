<h1>History</h1>

<h2>Latest Request</h2>

<a href="{{ url('/anbu') }}" class="latest-request"><i class="fa fa-reply"></i>&nbsp;&nbsp; View Latest Request</a>

<h2>Request History</h2>
@if (isset($history) && count($history))
<p>Click on a title to replay a request and view debug information.</p>
<table class="anbu-table">
    <thead>
        <tr>
            <th>Time</th>
            <th>Duration</th>
            <th>URI</th>
        </tr>
    </thead>
    <tbody>
        <?php $start = ($history->currentPage() - 1) * $history->perPage(); ?>
        @foreach(array_slice($history->all(), $start, $history->perPage()) as $storage)
        <tr>
            <?php $storage = $storage->toArray(); ?>
            <?php $date = new Carbon\Carbon($storage['created_at']); ?>
            <td><a href="{{ url('/anbu') .'/'. $storage['id'] }}">{{ $date->format('l jS F g:i:s A') }}</a><span class="friendly-time">({{ $date->diffForHumans() }})</span></td>
            <td>{{ number_format($storage['time'], 3) }}ms</td>
            <td class="code">{{ $storage['uri'] }}</td>
        </tr>
        @endforeach

    </tbody>
</table>
{!! $history->render() !!}
<br /> <br />
@else
<div class="empty">No previous requests are present.</div>
@endif
