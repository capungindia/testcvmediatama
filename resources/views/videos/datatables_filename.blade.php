@if(Auth::user()->role == 'admin')
    <a href="{{ asset('storage/videos') . '/' . $filename }}">
        {{ $filename }}
    </a>
@else
    {{ $filename }}
@endif