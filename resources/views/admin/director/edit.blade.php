@extends('admin.layouts.app',['title' => $title])
@section('content')
<div class="row">
    <div class="col">

        <!-- **************************************************  Edit Form ************************************************** -->
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{$title}}</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="live-preview">
                    <form action="{{ route('director.update',$member->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">Full Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control" name="name" value="{{ $member->name }}">
                                </div>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phonenumberInput" class="form-label">Phone Number</label><span
                                        class="text-danger">*</span>
                                    <input pattern="[56789][0-9]{9}" title="Please enter valid phone number"  type="tel" class="form-control" value="{{ $member->phone }}" name="phone">
                                </div>
                                @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailidInput" class="form-label">Email Address</label><span
                                        class="text-danger">*</span>
                                    <input type="email" class="form-control" value="{{ $member->email }}" name="email">
                                </div>
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Password (Leave Blank For No change)</label>
                                    <input type="password" class="form-control"  name="password" >
                                </div>
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                             <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">PAN Card</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" value="{{ $member->PAN }}"
                                        placeholder="Enter PAN" name="PAN" required>
                                </div>
                                @error('PAN')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <!--end col-->
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label><span class="text-danger">*</span>
                                    <input type="password" class="form-control"
                                        placeholder="Leave empty to keep the same" name="password">
                                </div>
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">User's Code</label>
                                    <input type="text" class="form-control" value={{ $member->user_id }}
                                    name="user_id">
                                </div>
                                @error('user_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                             <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">Profile Pic</label>
                                    <input type="file" accept="image/*" class="form-control" name="profile_dp">
                                </div>
                                @error('profile_dp')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <!--end col-->
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ForminputState" class="form-label">Society</label><span
                                        class="text-danger">*</span>
                                    <select id="ForminputState" class="form-select" data-choices=""
                                        data-choices-sorting="true" name="society">
                                        <option selected="" value="{{ $member->society }}">{{
                                            $member->society_name->name ?? ''}}</option>
                                        @foreach ($societies as $society )
                                        <option value="{{ $society->id }}">{{ $society->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('society')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            <!--end col-->
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ForminputState" class="form-label">Role</label><span
                                        class="text-danger">*</span>
                                    <select id="ForminputState" class="form-select" data-choices=""
                                        data-choices-sorting="true" name="role_id">
                                        <option selected="" value="{{ $member->role_id }}">{{
                                            $member->role->display_name }}</option>
                                        @foreach ($roles as $role )
                                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
