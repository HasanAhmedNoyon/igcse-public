@extends('admin.layouts.app')
@section('header-links')

@endsection

@section('contents')

@if(Auth::check() && Auth::user()->role_id == 1)
    <?php $url_group = 'superadmin' ?>
@elseif(Auth::check() && Auth::user()->role_id == 2)
    <?php $url_group = 'admin' ?>
@elseif(Auth::check() && Auth::user()->role_id == 3)
    <?php $url_group = 'staff' ?>
@endif

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            
                        </div>
                        <div class="custom-heading-wrapper">
                            <h1 class="m-0 p-0 custom-heading">System Setup</h1>
                            <div class="under-line-wrapper d-flex justify-content-around align-items-center">
                                <span class="left-line w-100"></span>
                                <span class="diamond"></span>
                                <span class="right-line w-100"></span>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route($url_group.'.system.settings') }}" class="btn btn-warning reload-btn">
                                <i class="fas fa-sync-alt reload-icon"></i> Reload
                            </a>
                        </div>
                    </div>

                    <div class="mt-5 from-wrapper">
                        <form action="{{ route($url_group.'.system.settings.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-sm-12 col-md-4 col-lg-4 d-flex flex-column h-100">
                                    <img id="system-logo" src="{{ asset('no-image.png') }}" alt="" srcset="" class="w-100 h-100 border">
                                    <input type="hidden" name="old_system_logo" value="{{ $row->system_logo }}">
                                    <input type="file" class="btn btn-dark w-100" name="system_logo"
                                        onchange="document.getElementById('system-logo').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-8">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon5">System Name</span>
                                            </div>
                                            <input 
                                                type="text" 
                                                class="form-control {{($errors->first('system_name') ? "border border-danger" : "")}}" 
                                                name="system_name" value="{{ old('system_name') ? old('system_name') : $row->system_name }}" 
                                                placeholder="Enter System Name" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon5">Email</span>
                                            </div>
                                            <input 
                                                type="email" 
                                                class="form-control {{($errors->first('email') ? "border border-danger" : "")}}" 
                                                name="email" value="{{ old('email') ? old('email') : $row->email }}" 
                                                placeholder="Enter Email" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon5">Phone</span>
                                            </div>
                                            <input 
                                                type="text" 
                                                class="form-control {{($errors->first('phone') ? "border border-danger" : "")}}" 
                                                name="phone" value="{{ old('phone') ? old('phone') : $row->phone }}" 
                                                placeholder="Enter Phone" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon5">Address</span>
                                            </div>
                                            <textarea id=""
                                                class="form-control {{($errors->first('address') ? "border border-danger" : "")}}"
                                                name="address"
                                                placeholder="Enter Address"
                                                >{{ old('address') ? old('address') : $row->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon5">Facebook Link</span>
                                            </div>
                                            <input 
                                                type="text" 
                                                class="form-control {{($errors->first('facebook_link') ? "border border-danger" : "")}}" 
                                                name="facebook_link" value="{{ old('facebook_link') ? old('facebook_link') : $row->facebook_link }}" 
                                                placeholder="Enter facebook link" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon5">Twitter Link</span>
                                            </div>
                                            <input 
                                                type="text" 
                                                class="form-control {{($errors->first('twitter_link') ? "border border-danger" : "")}}" 
                                                name="twitter_link" value="{{ old('twitter_link') ? old('twitter_link') : $row->twitter_link }}" 
                                                placeholder="Enter twitter link" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon5">Instagram Link</span>
                                            </div>
                                            <input 
                                                type="text" 
                                                class="form-control {{($errors->first('instagram_link') ? "border border-danger" : "")}}" 
                                                name="instagram_link" value="{{ old('instagram_link') ? old('instagram_link') : $row->instagram_link }}" 
                                                placeholder="Enter instagram link" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon5">Passing Mark(%)</span>
                                            </div>
                                            <input 
                                                type="number" 
                                                class="form-control {{($errors->first('passing_percentage') ? "border border-danger" : "")}}" 
                                                name="passing_percentage" value="{{ old('passing_percentage') ? old('passing_percentage') : $row->passing_percentage }}" 
                                                placeholder="Enter passing percentage(%)" >
                                        </div>
                                    </div>


                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check"></i> Save
                                        </button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>
@endsection

@section('footer-links')

@endsection