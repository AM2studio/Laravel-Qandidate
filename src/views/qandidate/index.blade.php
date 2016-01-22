<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
{!! Form::open(['route' => 'qandidate.toggle.store'], ['class' => 'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::text('name', null, ['required', 'class' => 'form-control', 'placeholder' => 'Name']) !!}
    </div>
    <div class="form-group">
        {!! Form::select('status', ['always-active' => 'Always active', 'inactive' => 'Inactive', 'conditionally-active' => 'Conditionally active'], null, ['class' => 'form-control']) !!}
    </div>
    <button class="btn btn-success">Create</button>
{!! Form::close() !!}
<table>
    <tr>
        <th>Name</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach($toggles as $toggle)
        <tr>
            <td>{{ $toggle->name }}</td>
            <td>{{ $toggle->status }}</td>
            <td>
                {!! Form::open(['route' => ['qandidate.toggle.delete', $toggle->id], 'method' => 'DELETE']) !!}
                    <a class="btn btn-primary" href="{{ route('qandidate.toggle.edit', $toggle->id) }}">Edit</a>
                    <button class="btn btn-danger">Delete</button>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>
