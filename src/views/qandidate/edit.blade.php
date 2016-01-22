<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<a href="{{ route('qandidate.toggle.index') }}" class="btn btn-primary">Back to the list</a>
<table>
    <tr>
        <th>Toggle name</th>
        <th>Toggle status</th>
        <th>Actions</th>
    </tr>
    <tr>
        {!! Form::model($toggle, ['route' => ['qandidate.toggle.update', $toggle->id], 'method' => 'PUT'], ['class' => 'form-horizontal']) !!}
            <td>{!! Form::text('name', null, ['class' => 'form-control']) !!}</td>
            <td>{!! Form::select('status', ['always-active' => 'Always active', 'inactive' => 'Inactive', 'conditionally-active' => 'Conditionally active'], null, ['class' => 'form-control']) !!}</td>
            <td>
                <button class="btn btn-primary">Update</button>
            </td>
        {!! Form::close() !!}
        <td>
            {!! Form::open(['route' => ['qandidate.toggle.delete', $toggle->id], 'method' => 'DELETE']) !!}
                <button class="btn btn-danger">Delete</button>
            {!! Form::close() !!}
        </td>
    </tr>
</table>
<table>
    <tr>
        <th>Name</th>
        <th>Key</th>
        <th>Operator</th>
        <th>Value</th>
        <th colspan="2">Action</th>
    </tr>
    @foreach($conditions as $condition)
            <tr>
                {!! Form::model($condition, ['route' => ['qandidate.condition.update', $condition->id], 'method' => 'PUT'], ['class' => 'form-horizontal']) !!}
                    <td>operator-condition</td>
                    <td>{!! Form::text('key', $condition->key, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('operator', ['less-than' => 'Less than', 'greater-than' => 'Greater than', 'less-than-equal' => 'Less than equal', 'greater-than-equal' => 'Greater than equal', 'percentage' => 'Percentage', 'in-set' => 'In set'], $condition->operator, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::text('value', $condition->value, ['class' => 'form-control']) !!}</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                    </td>
                {!! Form::close() !!}
                {!! Form::open(['route' => ['qandidate.condition.delete', $condition->id], 'method' => 'DELETE']) !!}
                    <td>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                {!! Form::close() !!}
            </tr>
    @endforeach
    {!! Form::open(['route' => 'qandidate.condition.store'], ['class' => 'form-horizontal']) !!}
        {!! Form::hidden('toggle_id', $toggle->id) !!}
        <tr>
            <td>operator-condition</td>
            <td>{!! Form::text('key', null, ['required', 'class' => 'form-control']) !!}</td>
            <td>{!! Form::select('operator', ['less-than' => 'Less than', 'greater-than' => 'Greater than', 'less-than-equal' => 'Less than equal', 'greater-than-equal' => 'Greater than equal', 'percentage' => 'Percentage', 'in-set' => 'In set'], null, ['class' => 'form-control']) !!}</td>
            <td>{!! Form::text('value', null, ['required', 'class' => 'form-control']) !!}</td>
            <td>
                <button class="btn btn-success">Create</button>
            </td>
        </tr>
    {!! Form::close() !!}
</table>
