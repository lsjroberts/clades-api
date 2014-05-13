@foreach ($data as $key => $value)
    @if (! is_array($value) and ! is_object($value))
        <dt>{{ $key }}</dt>
        <dd>{{ $value }}</dd>
    @endif
@endforeach