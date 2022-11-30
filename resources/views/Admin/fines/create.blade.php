@extends('layouts.master')



@section('content')


</div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Fine</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('fines.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('fines.store') }}" method="POST">
    	@csrf



            <div class="form-group ml-5">

                <label for="user" class="col-sm-2 col-form-label">Select a User</label>

                <div class="col-sm-9">

                    <select name='user' class="form-control {{$errors->first('user') ? "is-invalid" : "" }} " id="user">
                        <option disabled selected>Choose One!</option>
                        @foreach ($user  as $fines)
                            <option value="{{ $fines->id }}">{{ $fines->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>

                </div>
                <div class="form-group ml-5">

                    <label for="booking" class="col-sm-2 col-form-label">Select a Booking</label>

                    <div class="col-sm-9">

                        <select name='booking' class="form-control {{$errors->first('booking') ? "is-invalid" : "" }} " id="booking">
                            <option disabled selected>Choose One!</option>
                            @foreach ($booking as $book)
                                <option value="{{ $book->id }}">{{ $book->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('booking') }}
                        </div>

                    </div>

                </div>
		    </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        <input type="text" name="status" class="form-control" placeholder="Status">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Amount:</strong>
                            <input type="text" name="amount" class="form-control" placeholder="Amount">
                        </div>
                    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>
    @endsection
