@if ($errors->any())
<script>
    $(function () {
        @foreach ($errors->all() as $error)
        notify('{{$error}}','error');
        @endforeach
    })
</script>
@elseif(session()->has('message'))
<script>
    $(function () {
        notify('{{session()->pull("message")}}','success');
    })
</script>
@endif
