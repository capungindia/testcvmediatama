<div class='btn-group'>
    <a href="{{ route('videos.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    @if(Auth::user()->role == 'admin')
        <a href="{{ route('videos.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
        {!! Form::open(['route' => ['videos.destroy', $id], 'method' => 'delete']) !!}
            {!! Form::button('<i class="fa fa-trash"></i>', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-xs',
                'onclick' => "return confirm('Are you sure?')"
            ]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['videoRequests.store', $id], 'method' => 'post']) !!}
            {!! Form::hidden('video_id', $id, []) !!}
            {!! Form::hidden('user_id', Auth::user()->id, []) !!}
            @csrf
            {!! Form::button('<i class="fa fa-upload"></i>', [
                'type' => 'submit',
                'class' => 'btn btn-warning btn-xs',
            ]) !!}
        {!! Form::close() !!}
    @endif
</div>
