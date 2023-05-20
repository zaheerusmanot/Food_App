@extends('layouts.app')
@section('content')
<div class="container">
    @include('response')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ isset($user) ? __('Edit Office Boy') : __('Create Office Boy') }}</div>
                <div class="card-body">
                    <form id="office-boy-form" enctype="multipart/form-data" method="POST" @if(isset($user)) action="{{ route('officeBoy.update', $user->id) }}" @else action="{{ route('officeBoy.store') }}" @endif>
                        @csrf
                        @isset($user)
                            @method('PUT')
                        @endisset
                        {{-- @method('POST') --}}
                        <div class="form-group mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{ isset($user) ? $user->name : old('name') }}" maxlength="255" required>
                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ isset($user) ? $user->email :  old('email') }}" maxlength="255" required>
                              <span class="text-danger">
                                  @error('email')
                                  {{ $message }}
                                  @enderror
                              </span>
                        </div>

                        <div class="form-group mb-3 {{ isset($user) ? 'd-none' : '' }}">
                            <label for="productPrice" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="{{ old('password') }}" minlength="8" required>
                                <span class="input-group-text eye-icon"><i class="fa fa-eye"></i></span>
                            </div>
                                <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">{{ isset($user) ? "Update" : "Create" }}</button>
                        <a class="btn btn-danger btn-lg" href="{{ url()->previous() }}" role="button">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.eye-icon').on('click', function(e) {
                e.stopPropagation();
                var input = $(this).prev('input');
                var type = input.attr('type');
                if (type === 'password') {
                    input.attr('type', 'text');
                    $(this).html('<i class="fa fa-eye-slash"></i>');
                } else {
                    input.attr('type', 'password');
                    $(this).html('<i class="fa fa-eye"></i>');
                }
            });
        });
    </script>

@endsection


