<!-- {{ $tests }} -->
@foreach ($tests as $username)
    <p>{{$username->id .'.'. $username->username}}</p>
@endforeach
<form action ="/mysql" method="POST">
    @csrf
    <input type = "text" name="username">
    <input type = "text" name="email">
    <input type = "text" name="phone">
    <input type = "submit">
</form>    
    