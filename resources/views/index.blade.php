<table border="2">
    <tr>
        <th>id</th>
        <th>Пользователь</th>
        <th>Баланс</th>
        <th>Транзакции</th>
        <th>Сообщение</th>
    </tr>
    @foreach($users as $user)

        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->profile->balance}}</td>
          <td>{{$user->transaction->value}}</td>
            <td>{{$user->transaction->description}}</td>
            @endforeach
           <td> <a href="add">Добавить транзакцию</a></td> //Добавляем транзакцию
        </tr>

</table>
