<label for="" class="text-left">{{ucfirst($name)??'Status'}}</label><br>
<input
    type="checkbox"
    class=" form-control w-100"
    id="customCheck1"
    name="{{$name??'status'}}"
    data-toggle="toggle"
    data-width="100"
    data-onstyle="success"
    data-offstyle="danger"
    data-on="{{$on?? 'on'}}"
    data-off="{{$off??'off'}}"
    >
