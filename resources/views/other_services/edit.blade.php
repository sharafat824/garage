@extends('layouts.app')

@section('content')
<style>
    .invalid-feedback {
        color: red;
    }
</style>

<!-- Page Content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                    <a href="{{ url('/service/list') }}">
                        <i class="fa fa-arrow-left"></i>
                        <span class="titleup">{{ trans('message.Edit Service') }}</span>
                    </a>
                </div>
                @include('dashboard.profile')
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel AddServiceDescription">
                <div class="x_content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>EDIT SERVICE DETAILS...</h3>
                        </div>
                        <form id="ServiceEditForm" method="post" action="{{ url('/other/service/update', $service->id) }}" enctype="multipart/form-data" class="form-horizontal">
                            @csrf <!-- Laravel CSRF Protection -->
                            @method('PUT') <!-- HTTP Method Override for Update -->

                            <!-- Name Field -->
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">{{ trans('message.Service Name') }}<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $service->name) }}" placeholder="{{ trans('message.Enter Service Name') }}" required>
                                    @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Short Description -->
                            <div class="row mb-3">
                                <label for="short_description" class="col-md-4 col-form-label">{{ trans('message.Short Description') }}</label>
                                <div class="col-md-8">
                                    <textarea id="short_description" name="short_description" class="form-control" placeholder="{{trans('message.Short Description') }}">{{ old('short_description', $service->short_description) }}</textarea>
                                    @error('short_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Cylinder -->
                            <div class="row mb-3">
                                <label for="cylinder" class="col-md-4 col-form-label">{{ trans('message.Cylinder') }}</label>
                                <div class="col-md-8">
                                    <input type="text" id="cylinder" name="cylinder" class="form-control" value="{{ old('cylinder', $service->cylinder) }}" placeholder="{{ trans('message.Enter Cylinder Info') }}">
                                    @error('cylinder')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Price -->
                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label">{{ trans('message.Price') }}<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $service->price) }}" step="0.01" placeholder="{{ trans('message.Enter Price') }}" required>
                                    @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-9 text-center">
                                    <button type="submit" class="btn btn-success">{{ trans('message.UPDATE') }}</button>     
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
