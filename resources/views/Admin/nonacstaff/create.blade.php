@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="container">
        <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('nonacstaff.index') }}"> Back</a>
         </div><br>

        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Non Acadamic Staff Member Details</h3>
        </div>
    </div>

    <!-- Form creation -->
    <section>
    <div class="container">
    <form action="{{ route('nonacstaff.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold" style="align:center">Non Acadamic staff member Registration</p>
                </div>

                <div class="card-body" style="margin-bottom: 5px; padding-bottom: 0px;">

                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="mb-3"><label class="form-label" for="name"><strong>Name with Initials:&nbsp;</strong></label>
                            <input class="form-control" type="text" id="service_name" placeholder="A.A.A Dissanayaka" name="name" required>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="mb-3"><label class="form-label" for="nonacempnumb"><strong>EMP Number:&nbsp;</strong></label>
                            <input class="form-control" type="text" id="nonacempnumb" placeholder="EMP/000000" name="nonacempnumb" maxlength="12" required>
                        </div>
                        @error('nonacempnumb')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="age"><strong>Age:</strong><br></label>
                            <input class="form-control" type="number" name="age" placeholder="25 years" min="20" max="80">
                        </div>
                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div> --}}

                    {{-- <div class="mb-3"><label class="form-label" for="gender"><strong>Gender:</strong><br></label>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="service_client_payment_validated-2" name="gender" value="male" required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="service_client_payment_validated-1" name="gender" value="female" required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                        </div>
                    </div> --}}

                    {{-- <div class="col-md-4">
                        <label class="form-label" for="client_description"><strong>Address:</strong><br></label>
                        <textarea class="form-control" id="service_description" rows="5" name="address" placeholder="No.31, Market Road, Main-Street, Matara." required=""></textarea>
                        @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                    </div>
                    <br> --}}

                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="mb-3"><label class="form-label" for="email"><strong>Email:&nbsp;</strong></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="mb-3"><label class="form-label" for="telephone_no"><strong>Telephone Number:</strong></label>
                            <input class="form-control" type="telno" id="telno" placeholder="07X XXX XXXX" name="phone" maxlength="12" required>
                        </div>
                        @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                    </div>

                    {{-- <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="mb-3"><label class="form-label" for="Position"><strong>Position</strong><br></label>
                            <input class="form-control" type="text" id="position" placeholder="Grade I" name="position" required>
                        </div>
                        @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div> --}}

                    {{-- <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="mb-3"><label class="form-label" for="qualification"><strong>"Specialization:</strong><br></label>
                            <input class="form-control" type="text" id="qualification" placeholder="GCE A/L Qualified" name="specialization" required>
                        </div>
                        @error('specialization')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div> --}}

                    {{-- <div class="mb-3"><label class="form-label" for="service_client_payment_validated"><strong>Status:</strong><br></label>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="formCheck-1">
                                <label class="form-check-label" for="formCheck-1">Active</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="formCheck-2">
                              <label class="form-check-label" for="formCheck-2">Inactive</label>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-lg-4">
                        <div class="mb-3"><label class="form-label" for="service_client_start_date"><strong>Uplaod a Photo:</strong><br></label>
                        <input class="form-control" type="file" name="file">
                        @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                    </div>

                </div>

                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="service_client_start_date"><strong>Set Password:</strong><br></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="service_client_start_date"><strong>Confirm Password:</strong><br></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

        </div>

        <div class="text-center mb-3">
            <button class="btn btn-primary btn-lg" type="submit">Save</button>
            <button class="btn btn-danger btn-lg" type="reset">Reset</button>
        </div>

    </form>
    </div>
    </section>

</div>
</div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
@endsection
