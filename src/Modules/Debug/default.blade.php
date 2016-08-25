<h1>Debug</h1>
@if (isset($debugs) && count($debugs))
        @foreach($debugs as $debug)
        <div class="debug">{!! $debug !!}</div>
        @endforeach
@else
<div class="empty">No values were debugged during this request.</div>
@endif
