<table>
    <thead>
    <tr>
        @foreach($columns as $column)
            <th>{{$column['column']}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($lots as $lot)
        <tr>
            @foreach($columns as $column)
                <td>{{ isset($column['field']) ? $lot[$column['field']] : ''  }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
