{{-- Success --}}
<audio id="sound-success" style="display:none">
    <source src="{{asset(config('constants.sound_dir').'/success.mp3')}}" type="audio/mpeg">
    <source src="{{asset(config('constants.sound_dir').'/success.ogg')}}" type="audio/ogg">
    Your browser does not support the HTML5 Audio element.
</audio>
{{-- Warning --}}
<audio id="sound-warning" style="display:none">
    <source src="{{asset(config('constants.sound_dir').'/warning.mp3')}}" type="audio/mpeg">
    <source src="{{asset(config('constants.sound_dir').'/warning.ogg')}}" type="audio/ogg">
    Your browser does not support the HTML5 Audio element.
</audio>
{{-- Error --}}
<audio id="sound-error" style="display:none">
    <source src="{{asset(config('constants.sound_dir').'/error.mp3')}}" type="audio/mpeg">
    <source src="{{asset(config('constants.sound_dir').'/error.ogg')}}" type="audio/ogg">
    Your browser does not support the HTML5 Audio element.
</audio>
<audio id="sound-beep" style="display:none">
    <source src="{{asset(config('constants.sound_dir').'/beep.mp3')}}" type="audio/mpeg">
    <source src="{{asset(config('constants.sound_dir').'/beep.wav')}}" type="audio/wav">
    Your browser does not support the HTML5 Audio element.
</audio>
