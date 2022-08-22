{!! Form::open(['route' => ['videoRequests.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('videoRequests.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    @if(Auth::user()->role == 'admin')
        <a href="{{ route('videoRequests.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endif
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
