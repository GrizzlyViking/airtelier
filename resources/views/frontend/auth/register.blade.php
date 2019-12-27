@extends('frontend.layout.standard')

@section('content')
    <div class="container p-6 mt-4">
        <div class="card">
            <div class="card-header p-6">
                <h3>Register</h3>
            </div>
            <div class="card-body p-6">
                <form>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Confirm password</label>
                        <input type="text" class="form-control" id="password_confirm" name="password_confirm">
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
                    </div>

                    <button class="btn btn-outline-grey w-100 mt-5">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
