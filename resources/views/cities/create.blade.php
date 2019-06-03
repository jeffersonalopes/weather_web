@extends('layout.master')
@section('content')

<div class="t_container container">
    <div class="col-md-12 p-4">
        <form method="POST" action="{{ url('/city/store') }}">
            <div class="row">
                
                    {{ csrf_field() }}
                    <div class="col-md-12 mb-3">
                        <h4 class="title">
                            Cadastro de Cidades
                        </h4>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country">País</label>
                            <select name="country" id="country" class="form-control select_2" required>
                                <option selected disabled>Selecione um País</option>
                                @foreach($countries as $c)
                                    <option value={{ $c->code }}> {{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="api_id">Cidade</label>
                            <select name="api_id" id="api_id" class="form-control select_2" required>
                                <option selected disabled>Selecione uma Cidade</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cidade">Nome Alternativo</label>
                            <input type="text" name="display_name" id="display_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="day">Imagem Dia</label>
                                    <input type="text" name="day" id="day" class="form-control" placeholder="opcional">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cloudy_day">Imagem Dia Nublado</label>
                                    <input type="text" name="cloudy_day" id="cloudy_day" class="form-control" placeholder="opcional">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rainy_day">Imagem Dia Chuvoso</label>
                                    <input type="text" name="rainy_day" id="rainy_day" class="form-control" placeholder="opcional">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="night">Imagem Noite</label>
                                    <input type="text" name="night" id="night" class="form-control" placeholder="opcional">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cloudy_night">Imagem Noite Nublada </label>
                                    <input type="text" name="cloudy_night" id="cloudy_night" class="form-control" placeholder="opcional">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rainy_night">Imagem Noite Chuvosa </label>
                                    <input type="text" name="rainy_night" id="rainy_night" class="form-control" placeholder="opcional">
                                </div>
                            </div>

                            <div class="col-md-4 offset-md-4 pt-4">
                                <a href="{{ url('cities/list') }}" class="button mt-2 col-md-12 float-left text-center">Todas Cidades</a>
                            </div>
                            <div class="col-md-4 pt-4">
                                <input type="hidden" name="active" value="true">
                                <button class="button mt-2 col-md-12">Adicionar Cidade</button>
                            </div>
                        </div>
                    </div>
                
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#country").change(function(){
            var country_code = $(this).val();
            $.getJSON("{{ url('/') }}/ajx/cities_by_country/"+country_code, function(data){
                $("#api_id").html("<option disabled selected>Selecione uma Cidade</option>");
                $.each(data, function(key, city){
                    $("#api_id").append("<option value='"+city.api_id+"'>"+city.api_name+"</option>");
                });
            });
        });
       
    });
</script>

@endsection