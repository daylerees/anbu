<h1>Dashboard</h1>

@if (isset($widgets) && count($widgets))
<div class="widgets">
    @foreach($widgets as $widget)
    <div class="widget">
        <span class="widget-badge"><span class="widget-badge-count">{{ $widget->badge }}</span></span>
        <h1>{{ $widget->name }}</h1>
        {{ $widget->view }}
    </div>
    @endforeach
@else
<div class="empty">There are no widgets!</div>
@endif
</div>
