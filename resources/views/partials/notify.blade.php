@if ($errors->any())
<script>
    @foreach ($errors->all() as $error)
    notify('{{$error}}','error');
    @endforeach
</script>
@elseif(session()->has('message'))
<script>
    notify('{{session()->pull("message")}}','success');
</script>
@endif
