<table>
    <thead>
    <tr>
        @foreach($columns as $column)
            <th>{{$column->title}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($lots as $lot)
        <tr>
            @foreach($columns as $column)
                <td>{{ $lot[$column->field] }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
