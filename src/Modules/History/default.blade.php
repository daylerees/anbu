<h1>Previous Requests</h1>
@if (count($history))
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
            <?php $date = new Carbon\Carbon($storage['created_at']); ?>
            <td><a href="/anbu/{{ $storage['id'] }}">{{ $date->format('l jS F g:i:s A') }}</a><span class="friendly-time">({{ $date->diffForHumans() }})</span></td>
            <td class="code">{{ $storage['uri'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="empty">No previous requests are present.</div>
@endif
