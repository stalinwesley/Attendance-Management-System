<thead >
    <tr>
        <th>Employee</th>
        @for($i =1; $i <= $daysInMonth; $i++)
            <th>{{ $i }}</th>
        @endfor
        <th>Total</th>
    </tr>
</thead>
