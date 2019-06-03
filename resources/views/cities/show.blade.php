@extends('layout.master')
@section('content')

<div class="weather_box">
    <div class="col-md-12 pb-0 pt-0">
        <div class="row p-0 ">
            <div class="col-md-7 p-3" id="unblur">
                <h4 class="text-right mb-0"> {{ $city->display_name ? $city->display_name : $city->api_name }} </h4>
                <p class="mt-0 text-right situation"> {{ $current_day["weather"]->weather[0]->description }}</p>
                <div class="footer_content">
                    <div class="row">
                        <div class="col-md-4">
                            <h2 class="temperture">
                                <span>{{ round($current_day["weather"]->temp->max, 0) }}°</span>
                            </h2>
                        </div>
                        <div class="col-md-8 pt-5 pl-5 info">
                            <p class="mb-0"> <strong>{{ $current_day["week_day"] ." | ". $current_day["date"] }}</strong> </p>
                            <p class="mt-0">
                                Humidade: {{ $current_day["weather"]->humidity }} %
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 p-3">
                <center>
                    <img src="{{ asset("/img")."/".str_replace("n","d",$current_day["weather"]->weather[0]->icon)}}.png" width="90px"
                </center>
                    <p class="min-max">
                        Mín: {{ $current_day["weather"]->temp->min }}  /  Máx: {{ $current_day["weather"]->temp->max }} 
                    </p>    
                <hr>
                <?php $i=0; ?>
                @foreach($temperture as $key => $t)
                    @if($i > 0)
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                    <center>
                                        <img src="http://openweathermap.org/img/w/{{$t["weather"]->weather[0]->icon}}.png" width="35px" class="api_icon">
                                    </center>
                                </div>
                                <div class="col-6">
                                    <p class="week_day"> {{ $key }}  </p>
                                    <p class="date_week"> {{ $t["date"]}}</p>
                                </div>
                                <div class="col-4">
                                    <p class="f_week"> <b>Mín:</b> {{  round($t["weather"]->temp->min,0) }}° </p>
                                    <p class="f_week"> <b>Máx:</b> {{  round($t["weather"]->temp->max,0) }}° </p>
                                </div>
                            </div>
                           
                        </div>
                        
                    @endif
                    <?php $i++ ?>
                @endforeach
                <a href="{{ url('cities/list') }}" class="float-right btn-small"> Mais Cidades</a>
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="daybg" value="{{  $current_day["bg"]["day"] }}">
<input type="hidden" id="naightbg" value="{{  $current_day["bg"]["night"] }}">
<script>
    $(document).ready(function(){
        let localtime = new Date();
        let hours = localtime.getHours();
        let bg;
        if(hours > 18)
           bg = $("#naightbg").val();
        else
           bg = $("#daybg").val();
        
        $("#background").css("background","url("+bg+")");
        $("#unblur").css("background","url("+bg+")");
    });
</script>
@endsection