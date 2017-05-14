@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Create New Quote</h4>
            </div>
            <div class="content">
                @include('partials.errors')
                <form action="/quote" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" class="form-control" placeholder="Choose starting point..." name="start" id="start" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Destination</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" class="form-control" placeholder="Choose destination..." name="destination" id="destination" required>
                                </div>
                                @if ($errors->has('destination'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('destination') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <a id="toggleVia">Add Via Point <i class="fa fa-plus"></i></a>
                            <div id="viaInput" class="form-group hidden">
                                <label>Via</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" class="form-control" placeholder="Choose via point..." name="via" id="via">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fee Scale</label>
                                <select class="form-control"  name="feeScaleId" required>
                                    @foreach($feeScales as $feeScale)
                                    <option value="{{ $feeScale->id }}">{{ $feeScale->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Vehicle Type</label>
                                <select class="form-control" name="vehicleTypeId" required>
                                    @foreach($vehicleTypes as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-fill pull-right">Get Quote</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqACoKPqvIrZ1EQp-njyExDg0oYaG_64o&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">
    var startInput = document.getElementById('start');
    var destinationInput = document.getElementById('destination');
    var viaInput = document.getElementById('via');

    startAutocomplete = new google.maps.places.Autocomplete(startInput);
    destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);
    viaAutocomplete = new google.maps.places.Autocomplete(viaInput);

    startAutocomplete.addListener('place_changed', function(){
        var startLocation =  startAutocomplete.getPlace();
        var startLat = startLocation.geometry.location.lat();
        var startlon = startLocation.geometry.location.lng();
    });

    destinationAutocomplete.addListener('place_changed', function(){
        var finishLocation =  destinationAutocomplete.getPlace();
        var finishLat = finishLocation.geometry.location.lat();
        var finishlon = finishLocation.geometry.location.lng();
    });

    viaAutocomplete.addListener('place_changed', function(){
        var viaLocation =  viaAutocomplete.getPlace();
        var viaLat = viaLocation.geometry.location.lat();
        var vialon = finishLocation.geometry.location.lng();
    });
</script>


<script>
    $(document).ready(function(){
        //toggle via input
        $("#toggleVia").click(function(){
            var via = $("#viaInput");
            if (via.hasClass('hidden')){
                via.removeClass('hidden');
            } else {
                via.addClass('hidden');
            }
        });
    })
</script>

@endsection