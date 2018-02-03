
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <title>Laravel</title>
    </head>
    <body>
        <div class="row">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                @foreach ($cases as $user)
                <tr>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </body>
</html