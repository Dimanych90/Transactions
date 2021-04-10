
@foreach($users as $user)
<form method="post" action="done">
  User_id  <input name="id" value="{{$user->id}}">
User_balance <input name="balance" value="{{$user->profile->balance}}">
    Value <select multiple name="value">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="cancel">Cancel last action</option>
    </select>
    User_transactions <input name="transaction" value="">
    <input  type="submit">
</form>
@endforeach
