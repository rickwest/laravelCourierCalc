@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="header">
                    <h4 class="title">Customer Charge</h4>
                    <p class="category">Details</p>
                </div>
                <div class="content">
                    <h1>&pound;{{ $total['price'] }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="header">
                    <h4 class="title">Driver Pay</h4>
                    <p class="category">Details</p>
                </div>
                <div class="content">
                    <h1> &pound;{{ $total['driverCost'] }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="header">
                    <h4 class="title">Margin</h4>
                    <p class="category">Details</p>
                </div>
                <div class="content">
                    <h1> {{ $total['marginPercent'] }}&percnt;</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Journey Summary</h4>
                    <p class="category"></p>
                </div>
                <div class="content">
                    <p><strong>Start:</strong> {{ $start }} </p>
                    <p><strong>Destination:</strong> {{ $destination }}</p>
                    <p><strong>Via:</strong></p>
                    <p><strong>Total Distance:</strong> {{ $distance. 'miles' }}</p>
                    <p><strong>Estimated Time:</strong> {{ $route['duration']['text'] }}</p>
                    <p><strong>Fee Scale:</strong></p>
                    <p><strong>Vehicle Type:</strong></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Quote</h4>
                    <p class="category">Calculated costs</p>
                </div>
                <div class="content">
                    <div id="map" style="width:100%;height:500px"></div>
                </div>
                <div class="footer">
                    <button class="btn btn-success btn-fill">Accept</button>
                    <button class="btn btn-info btn-fill">Email</button>
                    <button class="btn btn-danger btn-fill">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="header">
                    <h4 class="title">Fees</h4>
                    <p class="category"></p>
                </div>
                <div class="content">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="header">
                    <h4 class="title">Email Quote</h4>
                    <p class="category">Email quote to customer</p>
                </div>
                <div class="content">
                    <form id="emailQuote" action="/quote/email">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Enter customer email..." name="email" id="email">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-fill">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        // Attach a submit handler to the form
        $( "#emailQuote" ).submit(function( event ) {

            // Stop form from submitting normally
            event.preventDefault();

//            $.ajaxSetup({
//                headers: {
//                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                }
//            });

            // Get some values from elements on the page:
            var $form = $( this ),
                email = $form.find( "input[name='email']" ).val(),
                url = $form.attr( "action" );

            // Send the data using post
            var posting = $.post( url, { email: email, _token:token  } );

            // Put the results in a div
            posting.done(function( data ) {
//                var content = $( data ).find( "#content" );
//                $( "#result" ).empty().append( content );
            console.log(data.success)
            });
        });
    </script>




@endsection