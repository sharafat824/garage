@extends('layouts.app')
@section('content')
<style>
  .removeimage {
    float: left;
    padding: 5px;
    height: 70px;
  }

  .removeimage .text {
    position: relative;
    bottom: 45px;
    display: block;
    left: 20px;
    font-size: 18px;
    color: red;
    visibility: hidden;
  }

  .removeimage:hover .text {
    visibility: visible;
  }

  @media (min-width: 320px) and (max-width: 522px) {
    .newAddLine::before {
      white-space: pre;
      content: "\a";
    }

    .newAddForButton {
      margin-top: 20px;
      margin-right: 30px;
    }
  }

  @media (max-width: 320px) and (min-width: 360px) {
    .newAddForButton {
      margin-top: 20px;
    }
  }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{{ URL::previous() }}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
              {{ trans('message.Edit Vehicle') }}</span></a>
        </div>
        @include('dashboard.profile')
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
      <div class="x_panel mb-0">
        <div class="x_content">
          <form id="vehicleEdit-Form" action="update/{{ $vehicaledit->id }}" method="post" enctype="multipart/form-data" class="form-horizontal upperform">

            <div class="row">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Vehicle Type') }} <label class="color-danger">*</label></label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select class="form-control select_vehicaltype form-select" name="vehical_id" vehicalurl="{!! url('/vehicle/vehicaltypefrombrand') !!}">
                    <!-- <option value="">{{ trans('message.Select Vehicle Type') }}</option> -->
                    @if (!empty($vehical_type))
                    @foreach ($vehical_type as $vehical_types)
                    <option value="{{ $vehical_types->id }}" <?php if ($vehical_types->id == $vehicaledit->vehicletype_id) {
                                                                echo 'selected';
                                                              } ?>>{{ $vehical_types->vehicle_type }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                  <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-target="#responsive-modal" data-bs-toggle="modal">{{ trans('message.Add/Remove') }}</button>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Number Plate') }} <label class="text-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="number_plate" value="{{ $vehicaledit->number_plate }}" placeholder="{{ trans('message.Enter Number Plate') }}" maxlength="30" class="form-control">
                </div>
              </div>

             
            </div>

            <div class="row mt-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Vehicle Brand') }} <label class="color-danger">*</label></label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select class="form-control select_vehicalbrand form-select" name="vehicabrand" url="{!! url('/vehicle/vehicalmodelfrombrand') !!}">
                    <!-- <option value="">{{ trans('message.Select Vehicle Brand') }}</option> -->
                    @if (!empty($vehical_brand))
                    @foreach ($vehical_brand as $vehical_brands)
                    <option value="{{ $vehical_brands->id }}" <?php if ($vehical_brands->id == $vehicaledit->vehiclebrand_id) {
                                                                echo 'selected';
                                                              } ?>>{{ $vehical_brands->vehicle_brand }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                  <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-target="#responsive-modal-brand" data-bs-toggle="modal">{{ trans('message.Add/Remove') }}</button>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_branch form-select" name="branch">
                    @foreach ($branchDatas as $branchData)
                    <option value="{{ $branchData->id }}" <?php if ($vehicaledit->branch_id == $branchData->id) {
                                                            echo 'selected';
                                                          } ?>>{{ $branchData->branch_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              
            </div>

            <div class="row mt-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Fuel Type') }} <label class="color-danger">*</label></label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select class="form-control select_fueltype form-select" name="fueltype">
                    <!-- <option value="">{{ trans('message.Select fuel type') }}</option> -->
                    @if (!empty($fueltype))
                    @foreach ($fueltype as $fueltypes)
                    <option value="{{ $fueltypes->id }}" <?php if ($fueltypes->id == $vehicaledit->fuel_id) {
                                                            echo 'selected';
                                                          } ?>> {{ $fueltypes->fuel_type }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                  <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-target="#responsive-modal-fuel" data-bs-toggle="modal">{{ trans('message.Add/Remove') }}</button>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Number of Gear') }} <label class="text-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="gearno" value="{{ $vehicaledit->nogears }}" placeholder="{{ trans('message.Enter Number of Gear') }}" maxlength="30" class="form-control">
                </div>
              </div>
            </div>

            <div class="row mt-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Model Name') }} <label class="color-danger">*</label></label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">

                  <select class="form-control model_addname form-select" name="modelname" required>
                    <!-- <option value="{{ $vehicaledit->modelname }}">{{ $vehicaledit->modelname }}</option> -->
                    @if (!empty($model_name))
                    @foreach ($model_name as $model_names)
                    <option value="{{ $model_names->model_name }}" <?php if ($model_names->model_name == $vehicaledit->modelname) {
                                                                      echo 'selected';
                                                                    } ?>>{{ $model_names->model_name }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                  <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-target="#responsive-modal-vehi-model" data-bs-toggle="modal">{{ trans('message.Add/Remove') }}</button>
                </div>
              </div>

              <div class="row {{ $errors->has('price') ? ' has-error' : '' }} col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="price" value="{{ $vehicaledit->price ?? trans('0') }}" placeholder="{{ trans('message.Enter Price') }}" maxlength="10" class="form-control">
                </div>
              </div>
            </div>

            <div class="row mt-0">
              <div class="row {{ $errors->has('odometerreading') ? ' has-error' : '' }} col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Odometer Reading') }} <label class="text-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="odometerreading" value="{{ $vehicaledit->odometerreading }}" placeholder="{{ trans('message.Enter Odometer Reading') }}" class="form-control" maxlength="30">
                  @if ($errors->has('odometerreading'))
                  <span class="help-block">
                    <strong>{{ $errors->first('odometerreading') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6" id="customer-field">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="customer">{{ trans('message.Select Customer') }} <label class="color-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_customer form-select" name="customer">
                    <option value="">{{ trans('message.Select Customer') }}</option>
                    @if (!empty($customer))
                    @foreach ($customer as $customers)
                    <option value="{{ $customers->id }}" <?php if ($customers->id == $vehicaledit->customer_id) {
                                                                      echo 'selected';
                                                                    } ?>>{{ getCustomerName($customers->id) }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
            </div>
            <div class="row mt-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6"> 
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Gear Box') }} <label class="text-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="gearbox" value="{{ $vehicaledit->gearbox }}" placeholder="{{ trans('message.Enter Grear Box') }}" maxlength="20" class="form-control">
                </div>
              </div>
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Gear Box No') }}. </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="gearboxno" value="{{ $vehicaledit->gearboxno }}" placeholder="{{ trans('message.Enter Gearbox No.') }}" maxlength="20" class="form-control">
                </div>
              </div>
            </div>

            <div class="row mt-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Engine No') }}. <label class="text-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="engineno" value="{{ $vehicaledit->engineno }}" placeholder="{{ trans('message.Enter Engine No.') }}" maxlength="30" class="form-control">
                </div>
              </div>
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Engine Size') }} <label class="text-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="enginesize" value="{{ $vehicaledit->enginesize }}" placeholder="{{ trans('message.Enter Engine Size') }}" maxlength="30" class="form-control">
                </div>
              </div>
            </div>
            <div class="row mt-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Key No') }}. <label class="text-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="keyno" value="{{ $vehicaledit->keyno }}" placeholder="{{ trans('message.Enter Key No.') }}" maxlength="30" class="form-control">
                </div>
              </div>
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Engine') }} <label class="text-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="engine" value="{{ $vehicaledit->engine }}" placeholder="{{ trans('message.Enter Engine') }}" maxlength="30" class="form-control">
                </div>
              </div>
            </div>

            <div class="row mt-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Model Years') }} <label class="text-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 input-group-date date" id="">
                  <input type="text" name="modelyear" autocomplete="off" value="{{ $vehicaledit->modelyear }}" class="form-control myDatepicker2" readonly />
                </div>
              </div>
             
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Chassis No') }}. <label class="text-danger"></label> </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" name="chasicno" value="{{ $vehicaledit->chassisno }}" placeholder="{{ trans('message.Enter Chassis No.') }}" maxlength="30" class="form-control">
                </div>
              </div>
            </div>

            <div class="row mt-2">
              <!-- Vehical images  -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 mt-0">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Select Multiple Images') }}
                </label>
                <div class="form-group col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="file" name="image[]" class="form-control imageclass" data-max-file-size="5M" id="images" onchange="preview_images();" multiple>

                  <div class="row mt-2" id="image_preview">
                    @if (!empty($images1))
                    @foreach ($images1 as $images2)
                    <div class="col-md-4 col-sm-4 col-xs-12 removeimage delete_image" id="image_remove_<?php echo $images2->id; ?>" imgaeid="{{ $images2->id }}" delete_image="{!! url('vehicle/delete/getImages') !!}">
                      <a href=""><img src="{{ url('public/vehicle/' . $images2->image) }}" width="100px" height="60px">
                        <p class="text">{{ trans('message.Remove') }}</p>
                      </a>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
              </div>
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Date of Manufacturing') }} <label class="text-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 input-group-date date ">
                  @if ($vehicaledit->dom)
                  <input type="text" name="dom" autocomplete="off" placeholder="<?php echo getDateFormat(); ?>" value="{{ date(getDateFormat(), strtotime($vehicaledit->dom)) }}" class="form-control datepicker" onkeypress="return false;" />
                  @else
                  <input type="text" id="datepicker " autocomplete="off" class="form-control datepicker" placeholder="<?php echo getDateFormat(); ?>" value="" name="dom" onkeypress="return false;" />
                  @endif
                </div>
              </div>
             
            </div>

            <div class="row mt-3">
              <!-- Vehical Description  -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                  <h2 class="fw-bold">{{ trans('message.Vehicle Description') }}</h2><br>
                  <button type="button" id="add_new_description" class="btn btn-outline-secondary newaddvehicledescription btn-sm float-end addbutton" url="{!! url('vehicle/add/getDescription') !!}">{{ trans('+') }}
                    </button>
                </div>
                <div class="table-responsive mt-3 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 table-bordered">
                  <table class="table table-bordered addtaxtype" id="tab_decription_detail" align="center">
                    <thead>
                      <tr>
                        <th class="all">{{ trans('message.Description') }}</th>
                        <th>{{ trans('message.Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (!empty($vehicaldes))
                      @foreach ($vehicaldes as $vehicaldess)
                      <tr id="row_id_{{ $vehicaldess->id }}">
                        
                        <td>
                          <textarea name="description[]" class="form-control" id="tax_{{ $vehicaldess->id }}" maxlength="100">{{ $vehicaldess->vehicle_description }}</textarea>
                        </td>
                        <td class="text-center">
                          <span class="delete_description" data-id="{{ $vehicaldess->id }}" delete_description="{!! url('vehicle/delete/getDescription') !!}"><i class="fa fa-trash fa-2x"></i></span>
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>

              <!--vehicle color-->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group ms-1">
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <h2 class="fw-bold">{{ trans('message.Vehicle Color') }} </h2></span><br>
                                    <button type="button" id="add_new_color" class="btn btn-outline-secondary newaddvehicledescription btn-sm float-end addbutton mb-1" url="{!! url('vehicle/add/getcolor') !!}">{{ trans('+') }}
                                        </button>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 text-end mb-3">
                                    <button type="button" data-bs-target="#responsive-modal-color" data-bs-toggle="modal" class="btn btn-outline-secondary btn-sm newaddvehicledescription mt-0">{{ trans('message.Add/Remove') }}</button><br>
                                </div>
                                <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                                    <table class="table table-bordered addtaxtype" id="tab_color">
                                        <thead>
                                            <tr>
                                                <th class="all">{{ trans('message.Colors') }}</th>
                                                <th>{{ trans('message.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="color_id_1">
                                                <td>
                                                    <select name="color[]" class="form-control color form-select" id="tax_1" data-id="1">
                                                        <option value="">{{ trans('message.Select Color') }}
                                                        </option>
                                                        
                                                        @if (!empty($color))
                                                        @foreach ($color as $colors)
                                                        <option value="{{ $colors->id }}" style="background-color:{{ $colors->color_code }}; color: #ffffff;">
                                                            {{ $colors->color }}
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
            </div>

            <!-- Custom Filed data value -->
            @if (!empty($tbl_custom_fields))
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
              <h4><b>{{ trans('message.Custom Fields') }}</b></h4>
              <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
            </div>
            <?php
            $subDivCount = 0;
            ?>
            @foreach ($tbl_custom_fields as $myCounts => $tbl_custom_field)
            <?php
            if ($tbl_custom_field->required == 'yes') {
              $required = 'required';
              $red = '*';
            } else {
              $required = '';
              $red = '';
            }

            $tbl_custom = $tbl_custom_field->id;
            $userid = $vehicaledit->id;
            $datavalue = getCustomDataVehicle($tbl_custom, $userid);

            $subDivCount++;
            ?>
            @if ($myCounts % 2 == 0)
            <div class="row">
              @endif

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 error_customfield_main_div_{{ $myCounts }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  @if ($tbl_custom_field->type == 'textarea')
                  <textarea name="custom[{{ $tbl_custom_field->id }}]" class="form-control textarea_{{ $tbl_custom_field->id }} textarea_simple_class common_simple_class common_value_is_{{ $myCounts }}" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="100" isRequire="{{ $required }}" type="textarea" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>{{ $datavalue }}</textarea>

                  <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger"></span>
                  @elseif($tbl_custom_field->type == 'radio')
                  <?php
                  $radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id);
                  ?>
                  @if (!empty($radioLabelArrayList))
                  <div class="mt-1">
                    @foreach ($radioLabelArrayList as $k => $val)
                    <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php
                                                                                                                            //$formName = "product";
                                                                                                                            $getRadioValue = getRadioLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $vehicaledit->id, $tbl_custom_field->id);

                                                                                                                            if ($k == $getRadioValue) {
                                                                                                                              echo 'checked';
                                                                                                                            } ?>> {{ $val }} &nbsp;
                    @endforeach
                  </div>
                  @endif
                  @elseif($tbl_custom_field->type == 'checkbox')
                  <?php
                  $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                  ?>
                  @if (!empty($checkboxLabelArrayList))
                  <?php
                  $getCheckboxValue = getCheckboxLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $vehicaledit->id, $tbl_custom_field->id);
                  ?>
                  <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }} mt-1">
                    @foreach ($checkboxLabelArrayList as $k => $val)
                    <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}" <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($val == getCheckboxValForAllModule($tbl_custom_field->form_name, $vehicaledit->id, $tbl_custom_field->id, $val)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                  echo 'checked';
                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>> {{ $val }} &nbsp;
                    @endforeach
                    <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger"></span>
                  </div>
                  @endif
                  @elseif($tbl_custom_field->type == 'textbox')
                  <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" value="{{ $datavalue }}" maxlength="30" class="form-control textDate_{{ $tbl_custom_field->id }} textdate_simple_class common_value_is_{{ $myCounts }} common_simple_class" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>

                  <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger"></span>
                  @elseif($tbl_custom_field->type == 'date')
                  <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" value="{{ $datavalue }}" maxlength="30" class="form-control textDate_{{ $tbl_custom_field->id }} date_simple_class common_value_is_{{ $myCounts }} common_simple_class" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" onkeydown="return false" {{ $required }}>

                  <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger"></span>
                  @endif
                </div>
              </div>
              @if ($myCounts % 2 != 0)
            </div>
            @endif
            @endforeach
            <?php
            if ($subDivCount % 2 != 0) {
              echo '</div>';
            }
            ?>
            @endif
            <!-- Custom Filed data value End-->

            <div class="row">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
              </div> -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <button type="submit" class="btn btn-success updateVehicleButton">{{ trans('message.UPDATE') }}</button>
              </div>
            </div>
          </form>
        </div>

        <!-- Vehical Type  -->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
          <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"> {{ trans('message.Add Vehicle Type') }}</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal formaction" action="" method="">
                    <div class="row">
                      <div class="col-md-8 form-group data_popup">
                        <input type="text" class="form-control model_input vehical_type" name="vehical_type" id="vehical_type" placeholder="Enter Vehical Type" maxlength="20" required />
                      </div>
                      <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 data_popup">
                        <button type="button" class="btn btn-success vehicaltypeadd model_submit" id="vehicleTypeSubmit" url="{!! url('/vehicle/vehicle_type_add') !!}">{{ trans('message.Submit') }}</button>
                      </div>
                    </div>
                    <table class="table vehical_type_class" align="center">
                      <tbody>
                        @if (!empty($vehical_type))
                        @foreach ($vehical_type as $vehical_types)
                        <tr class="del-{{ $vehical_types->id }} data_of_type row mx-1">
                          <td class="text-start col-6">{{ $vehical_types->vehicle_type }}</td>
                          <td class="text-end col-6">

                            <button type="button" vehicletypeid="{{ $vehical_types->id }}" deletevehical="{!! url('/vehicle/vehicaltypedelete') !!}" class="btn btn-danger text-white border-0 deletevehicletype"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End  Vehical Type  -->

        <!-- Vehical Brand -->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
          <div id="responsive-modal-brand" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">{{ trans('message.Add Vehicle Brand') }}</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal">
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 form-group data_popup">
                      <select class="form-control model_input vehical_id form-select" id="vehicleTypeSelect" name="vehical_id" vehicalurl="{!! url('/vehicle/vehicalformtype') !!}">
                        <option value="">{{ trans('message.Select Vehicle Type') }}</option>
                        @if (!empty($vehical_type))
                        @foreach ($vehical_type as $vehical_types)
                        <option value="{{ $vehical_types->id }}">{{ $vehical_types->vehicle_type }}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 form-group data_popup">
                        <input type="text" class="form-control model_input vehical_brand" name="vehical_brand" id="vehical_brand" placeholder="Enter Vehical brand" maxlength="30" required />
                      </div>
                      <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 form-group data_popup">
                        <button type="button" class="btn btn-success model_submit vehicalbrandadd" vehiclebrandurl="{!! url('/vehicle/vehicle_brand_add') !!}">{{ trans('message.Submit') }}</button>
                      </div>
                    </div>
                    <table class="table vehical_brand_class" align="center">
                      <tbody>
                        @if (!empty($vehical_brand))
                        @foreach ($vehical_brand as $vehical_brands)
                        <tr class="del-{{ $vehical_brands->id }} data_of_type row mx-1">
                          <td class="text-start col-6">{{ $vehical_brands->vehicle_brand }}</td>
                          <td class="text-end col-6">
                            <button type="button" brandid="{{ $vehical_brands->id }}" deletevehicalbrand="{!! url('/vehicle/vehicalbranddelete') !!}" class="btn btn-danger text-white border-0 deletevehiclebrands"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Vehical Brand -->

        <!-- Fuel Type -->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
          <div id="responsive-modal-fuel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">{{ trans('message.Add Fuel Type') }}</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" action="" method="post">
                    <div class="row">
                      <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 form-group data_popup">
                        <input type="text" class="form-control model_input fuel_type" name="fuel_type" id="fuel_type" placeholder="{{ trans('message.Enter Fuel Type') }}" maxlength="30" required />
                      </div>
                      <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 form-group data_popup">
                        <button type="button" class="btn btn-success model_submit fueltypeadd" fuelurl="{!! url('/vehicle/vehicle_fuel_add') !!}">{{ trans('message.Submit') }}</button>
                      </div>
                    </div>
                    <table class="table fuel_type_class" align="center">
                      <tbody>
                        @if (!empty($fueltype))
                        @foreach ($fueltype as $fueltypes)
                        <tr class="del-{{ $fueltypes->id }} data_of_type row mx-1">
                          <td class="text-start col-6">{{ $fueltypes->fuel_type }}</td>
                          <td class="text-end col-6">
                            <button type="button" fuelid="{{ $fueltypes->id }}" deletefuel="{!! url('/vehicle/fueltypedelete') !!}" class="btn btn-danger text-white border-0 fueldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end Fuel Type -->

        <!-- Model Name -->
        <div class="col-md-6">
          <div id="responsive-modal-vehi-model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('message.Add Model Name') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
              <div class="modal-body">
                <form class="form-horizontal" action="" method="post">
                  <div class="row">
                    <div class="col-md-5 form-group data_popup">
                      <select class="form-control vehical_id model_input form-select vehi_brand_id" name="vehical_id" id="vehicleTypeSelect" vehicalurl="{!! url('/vehicle/vehicalformtype') !!}" required>
                        <option value="">{{ trans('message.Select Brand') }}</option>
                        @if (!empty($vehical_brand))
                        @foreach ($vehical_brand as $vehical_brands)
                          <option value="{{ $vehical_brands->id }}">{{ $vehical_brands->vehicle_brand }}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 form-group data_popup">
                      <input type="text" class="form-control model_input vehi_modal_name" name="model_name" id="model_name" placeholder="{{ trans('message.Enter Model Name') }}" maxlength="20" required />
                    </div>
                    <div class="col-md-4 form-group data_popup">
                      <button type="button" class="btn btn-success model_submit vehi_model_add" modelurl="{!! url('/vehicle/vehicle_model_add') !!}">{{ trans('message.Submit') }}</button>
                    </div>
                  </div>
                  <table class="table vehi_model_class">                     
                    <tbody>
                      @if (!empty($model_name))
                      @foreach ($model_name as $model_names)
                        <tr class="mod-{{ $model_names->id }} data_color_name row mx-1">
                          <td class="text-start col-6">{{ $model_names->model_name }}</td>
                          <td class="text-end col-6">
                            <button type="button" modelid="{{ $model_names->id }}" deletemodel="{!! url('/vehicle/vehicle_model_delete') !!}" class="btn btn-danger text-white border-0 modeldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </td>
                        </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>                  
                </form>
              </div>
            </div>
          </div>
        </div>
        </div>
        <!-- End Model Name -->

        <!-- Color Add/Remove Model Start-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
          <div id="responsive-modal-color" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">{{ trans('message.Add Color Name') }}</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal">
                    <div class="row">
                      <div class="col-md-5 form-group data_popup">
                        <input type="text" id="c_name" class="form-control model_input c_name" name="c_name" placeholder="{{ trans('message.Enter color name') }}"  maxlength="20"/>
                      </div>
                      <div class="col-md-3 form-group data_popup">
                        <input type="color" id="c_code" name="c_code" class="form-control model_input w-150 c_code">
                      </div>
                      <div class="col-md-4 form-group data_popup">
                        <button type="button" class="btn btn-success model_submit addcolor" colorurl="{!! url('/color_name_add') !!}">{{ trans('message.Submit') }}</button>
                      </div>
                    </div>
                    <table class="table colornametype" align="center">
                      <tbody>
                        @foreach ($color as $colors)
                        <tr class="del-{{ $colors->id }} data_color_name row mx-1">
                          <td class="text-first col-6">{{ $colors->color }}</td>
                          <td class="text-end col-6">
                            <div class="color_code d-inline-block" style="background-color:{{ getColor($colors->id) }};">{{ $colors->color_code }}</div>
                            <button type="button" id="{{ $colors->id }}" deletecolor="{!! url('colortypedelete') !!}" class="btn btn-danger text-white border-0 deletecolors d-inline-block"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Color Add/Remove Model End-->

      </div>
    </div>
  </div>
</div>
<!-- /page content -->



<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
  var msg35 = "{{ trans('message.OK') }}"
  $(document).ready(function() {



    $('.myDatepicker2').datetimepicker({
      format: "yyyy",
      endDate: new Date(),
      minView: 4,
      autoclose: true,
      startView: 4,
      language: "{{ getLangCode() }}",
    });

    $(".datepicker").datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      minDate: new Date(),
      todayBtn: true,
      autoclose: 1,
      minView: 2,
      language: "{{ getLangCode() }}",
    });


    var msg14 = "{{ trans('message.Please enter only alphanumeric data') }}";
    var msg15 = "{{ trans('message.Only blank space not allowed') }}";
    var msg16 = "{{ trans('message.This Record is Duplicate') }}";

    /*vehical type*/
    $('.vehicaltypeadd').click(function() {

      var vehical_type = $('.vehical_type').val();
      var url = $(this).attr('url');

      var msg13 = "{{ trans('message.Please enter vehicle type') }}";

      function define_variable() {
        return {
          vehicle_type_value: $('.vehical_type').val(),
          vehicle_type_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
          vehicle_type_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
        };
      }

      var call_var_vehicletypeadd = define_variable();

      if (vehical_type == "") {
        swal({
          title: msg13,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      } else if (!call_var_vehicletypeadd.vehicle_type_pattern.test(call_var_vehicletypeadd
          .vehicle_type_value)) {
        $('.vehical_type').val("");
        swal({
          title: msg14,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      } else if (!vehical_type.replace(/\s/g, '').length) {
        $('.vehical_type').val("");
        swal({
          title: msg15,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      } else if (!call_var_vehicletypeadd.vehicle_type_pattern2.test(call_var_vehicletypeadd
          .vehicle_type_value)) {
        $('.vehical_type').val("");
        swal({
          title: msg34,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      } else {
        $.ajax({
          type: 'GET',
          url: url,
          data: {
            vehical_type: vehical_type
          },
          success: function(data) {
            var newd = $.trim(data);
            var classname = 'del-' + newd;

            if (data == '01') {
              swal({
                title: msg16,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });

            } else {
              $('.vehical_type_class').append('<tr class=" row mx-1 ' + classname +
                ' data_of_type"><td class="text-start">' + vehical_type +
                '</td><td class="text-end"><button type="button" vehicletypeid=' + data +
                ' deletevehical="{!! url(' / vehicle / vehicaltypedelete ') !!}" class="btn btn-danger text-white border-0 deletevehicletype"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
              );
              $('.select_vehicaltype').append('<option value=' + data + '>' + vehical_type + '</option>');
              $('.vehical_type').val('');
            }
          },
        });
      }
    });

    var msg1 = "{{ trans('message.Are You Sure?') }}";
    var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
    var msg3 = "{{ trans('message.Cancel') }}";
    var msg4 = "{{ trans('message.Yes, delete!') }}";
    var msg5 = "{{ trans('message.Done!') }}";
    var msg6 = "{{ trans('message.It was succesfully deleted!') }}";
    var msg7 = "{{ trans('message.Cancelled') }}";
    var msg8 = "{{ trans('message.Your data is safe') }}";
    var vtypedelete = "{{ trans('message.Vehicle Type Deleted Successfully') }}";
    var vbranddelete = "{{ trans('message.Vehicle Brand Deleted Successfully') }}";
    var fueldelete = "{{ trans('message.Fuel Type Deleted Successfully') }}";
    var modeldelete = "{{ trans('message.Model Deleted Successfully') }}";
    var colordelete = "{{ trans('message.Color Deleted Successfully') }}";

    /*vehical Type delete*/
    $('body').on('click', '.deletevehicletype', function() {

      var vtypeid = $(this).attr('vehicletypeid');
      var url = $(this).attr('deletevehical');
      swal({
        title: msg1,
        text: msg2,
        icon: "warning",
        buttons: [msg3, msg4],
        dangerMode: true,
        cancelButtonColor: "#C1C1C1",
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              vtypeid: vtypeid
            },
            success: function(data) {
              $('.del-' + vtypeid).remove();
              $(".select_vehicaltype option[value=" + vtypeid + "]")
                .remove();
              swal({
                title: msg5,
                text: vtypedelete,
                icon: 'success',
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
            }
          });
        } else {
          swal({
            title: msg7,
            text: msg8,
            icon: 'error',
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        }
      })
    });


    /*vehical brand*/
    $('.vehicalbrandadd').click(function() {

      var vehical_id = $('.vehical_id').val();
      var vehical_brand = $('.vehical_brand').val();
      var url = $(this).attr('vehiclebrandurl');

      var msg17 = "{{ trans('message.Please first select vehicle type') }}";
      var msg18 = "{{ trans('message.Please enter vehicle brand') }}";

      function define_variable() {
        return {
          vehicle_brand_value: $('.vehical_brand').val(),
          vehicle_brand_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
          vehicle_brand_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
        };
      }

      var call_var_vehiclebrandadd = define_variable();

      if ($("#vehicleTypeSelect")[0].selectedIndex <= 0) {

        swal({
          title: msg17,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      } else {
        if (vehical_brand == "") {
          swal({
            title: msg18,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        } else if (!call_var_vehiclebrandadd.vehicle_brand_pattern.test(call_var_vehiclebrandadd
            .vehicle_brand_value)) {
          $('.vehical_brand').val("");
          swal({
            title: msg14,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });

        } else if (!vehical_brand.replace(/\s/g, '').length) {
          // var str = "    ";
          $('.vehical_brand').val("");
          swal({
            title: msg15,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        } else if (!call_var_vehiclebrandadd.vehicle_brand_pattern2.test(call_var_vehiclebrandadd
            .vehicle_brand_value)) {
          $('.vehical_brand').val("");
          swal({
            title: msg34,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });

        } else {
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              vehical_id: vehical_id,
              vehical_brand: vehical_brand
            },
            success: function(data) {
              var newd = $.trim(data);
              var classname = 'del-' + newd;

              if (data == '01') {
                swal({
                  title: msg16,
                  cancelButtonColor: '#C1C1C1',
                  buttons: {
                    cancel: msg35,
                  },
                  dangerMode: true,
                });
              } else {
                $('.vehical_brand_class').append('<tr class=" row mx-1 ' + classname +
                  ' data_of_type"><td class="text-start">' + vehical_brand +
                  '</td><td class="text-end"><button type="button" brandid=' + data +
                  ' deletevehicalbrand="{!! url(' / vehicle / vehicalbranddelete ') !!}" class="btn btn-danger text-white border-0 deletevehiclebrands"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                );
                $('.select_vehicalbrand').append('<option value=' + data + '>' + vehical_brand +
                  '</option>');
                $('.vehical_brand').val('');
              }
            },
          });
        }
      }
    });


    /*vehical brand delete*/
    $('body').on('click', '.deletevehiclebrands', function() {

      var vbrandid = $(this).attr('brandid');
      var url = $(this).attr('deletevehicalbrand');
      swal({
        title: msg1,
        text: msg2,
        icon: "warning",
        buttons: [msg3, msg4],
        dangerMode: true,
        cancelButtonColor: "#C1C1C1",
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              vbrandid: vbrandid
            },
            success: function(data) {
              $('.del-' + vbrandid).remove();
              $(".select_vehicalbrand option[value=" + vbrandid + "]")
                .remove();
              swal({
                title: msg5,
                text: vbranddelete,
                icon: 'success',
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
            }
          });
        } else {
          swal({
            title: msg7,
            text: msg8,
            icon: 'error',
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        }
      })

    });


    /*Fuel type*/
    $('.fueltypeadd').click(function() {
      var fuel_type = $('.fuel_type').val();
      var url = $(this).attr('fuelurl');

      var msg21 = "{{ trans('message.Please enter fuel type') }}";

      function define_variable() {
        return {
          vehicle_fuel_value: $('.fuel_type').val(),
          vehicle_fuel_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
          vehicle_fuel_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
        };
      }

      var call_var_vehiclefueladd = define_variable();

      if (fuel_type == "") {
        swal({
          title: msg21,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });

      } else if (!call_var_vehiclefueladd.vehicle_fuel_pattern.test(call_var_vehiclefueladd
          .vehicle_fuel_value)) {
        $('.fuel_type').val("");
        swal({
          title: msg14,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });


      } else if (!fuel_type.replace(/\s/g, '').length) {
        // var str = "    ";
        $('.fuel_type').val("");
        swal({
          title: msg15,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });

      } else if (!call_var_vehiclefueladd.vehicle_fuel_pattern2.test(call_var_vehiclefueladd
          .vehicle_fuel_value)) {
        $('.fuel_type').val("");
        swal({
          title: msg34,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });


      } else {
        $.ajax({
          type: 'GET',
          url: url,
          data: {
            fuel_type: fuel_type
          },
          success: function(data) {
            var newd = $.trim(data);
            var classname = 'del-' + newd;

            if (data == '01') {
              swal({
                title: msg16,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });

            } else {
              $('.fuel_type_class').append('<tr class=" row mx-1 ' + classname +
                ' data_of_type"><td class="text-start">' + fuel_type +
                '</td><td class="text-end"><button type="button" fuelid=' + data +
                ' deletefuel="{!! url('/vehicle/fueltypedelete ') !!}" class="btn btn-danger text-white border-0 fueldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
              );
              $('.select_fueltype').append('<option value=' + data + '>' + fuel_type + '</option>');
              $('.fuel_type').val('');
            }
          },
        });
      }
    });


    /*Fuel  Type delete*/
    $('body').on('click', '.fueldeletes', function() {

      var fueltypeid = $(this).attr('fuelid');
      var url = $(this).attr('deletefuel');
      swal({
        title: msg1,
        text: msg2,
        icon: "warning",
        buttons: [msg3, msg4],
        dangerMode: true,
        cancelButtonColor: "#C1C1C1",
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              fueltypeid: fueltypeid
            },
            success: function(data) {
              $('.del-' + fueltypeid).remove();
              $(".select_fueltype option[value=" + fueltypeid + "]")
                .remove();
              swal({
                title: msg5,
                text: fueldelete,
                icon: 'success',
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
            }
          });
        } else {
          swal({
            title: msg7,
            text: msg8,
            icon: 'error',
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        }
      })


    });


    /*Add Vehicle Model*/
    $('.vehi_model_add').click(function() {
      var model_name = $('.vehi_modal_name').val();
      var model_url = $(this).attr('modelurl');
      var brand_id = $('.vehi_brand_id').val();

      var msg9 = "{{ trans('message.Please enter model name') }}";

      function define_variable() {
        return {
          vehicle_model_value: $('.vehi_modal_name').val(),
          vehicle_model_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
          vehicle_model_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
        };
      }

      var call_var_vehiclemodeladd = define_variable();

      if (model_name == "") {
        swal({
          title: msg9,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });

      } else if (!call_var_vehiclemodeladd.vehicle_model_pattern.test(call_var_vehiclemodeladd
          .vehicle_model_value)) {
        $('.vehi_modal_name').val("");
        swal({
          title: msg14,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });

      } else if (!model_name.replace(/\s/g, '').length) {
        $('.vehi_modal_name').val("");
        swal({
          title: msg15,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      } else if (!call_var_vehiclemodeladd.vehicle_model_pattern2.test(call_var_vehiclemodeladd
          .vehicle_model_value)) {
        $('.vehi_modal_name').val("");
        swal({
          title: msg34,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      } else {
        $.ajax({
          type: 'GET',
          url: model_url,
          data: {
            model_name: model_name,
            brand_id: brand_id
          },
          success: function(data) {
            var newd = $.trim(data);
            var classname = 'mod-' + newd;
            if (data == '01') {
              swal({
                title: msg16,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
            } else {
              $('.vehi_model_class').append('<tr class=" row mx-1 ' + classname + ' data_of_type"><td class="text-start">' +
                model_name + '</td><td class="text-end"><button type="button" modelid=' + data +
                ' deletemodel="{!! url(' / vehicle / vehicle_model_delete ') !!}" class="btn btn-danger text-white border-0 modeldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
              );
              $('.model_addname').append('<option value=' + data + '>' + model_name + '</option>');
              $('.vehi_modal_name').val('');
            }
          },
        });
      }
    });


    $('body').on('click', '.modeldeletes', function() {

      var mod_del_id = $(this).attr('modelid');
      var del_url = $(this).attr('deletemodel');

      swal({
        title: msg1,
        text: msg2,
        icon: "warning",
        buttons: [msg3, msg4],
        dangerMode: true,
        cancelButtonColor: "#C1C1C1",
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'GET',
            url: del_url,
            data: {
              mod_del_id: mod_del_id
            },
            success: function(data) {
              $('.mod-' + mod_del_id).remove();
              $(".model_addname option[value=" + mod_del_id + "]")
                .remove();
              swal({
                title: msg5,
                text: modeldelete,
                icon: 'success',
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
            }
          });
        } else {
          swal({
            title: msg7,
            text: msg8,
            icon: 'error',
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        }
      })

    });


    /*vehical Type from brand*/
    $('.select_vehicaltype').change(function() {
            vehical_id = $(this).val();
            var url = $(this).attr('vehicalurl');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    vehical_id: vehical_id
                },
                success: function(response) {
                    $('.select_vehicalbrand').html(response);

                    $('.select_vehicalbrand').trigger('change');
                }
            });
        });

        /*vehical Model from brand*/
        $('.select_vehicalbrand').change(function() {
            id = $(this).val();
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    id: id
                },
                success: function(response) { 
                    $('.model_addname').html(response);
                }
            });
        });

    var msg100 = "{{ trans('message.An error occurred :') }}";

    /*Vehical Description*/
    $("#add_new_description").click(function() {
      var row_id = $("#tab_decription_detail > tbody > tr").length;
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          row_id: row_id
        },
        success: function(response) {
          $("#tab_decription_detail > tbody").append(response.html);
          return false;
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });


    $('body').on('click', '.delete_description', function() {

      var description = $(this).attr('data-id');
      var url = $(this).attr('delete_description');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          description: description
        },
        beforeSend: function() {
          $("#add_new_description").prop('disabled', true); // disable button
        },
        success: function(response) {
          $('table#tab_decription_detail tr#row_id_' + description).remove();
          $("#add_new_description").prop('disabled', false); // enable button
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });


    /*vehical color*/
    $("#add_new_color").click(function() {

      var color_id = $("#tab_color > tbody > tr").length;
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          color_id: color_id
        },
        beforeSend: function() {
          $("#add_new_color").prop('disabled', true); // disable button
        },
        success: function(response) {
          $("#tab_color > tbody").append(response.html);
          $("#add_new_color").prop('disabled', false); // disable button
          return false;
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });



    $('body').on('click', '.remove_color', function() {
      var color_id = $(this).attr('data-id');
      var url = $(this).attr('colordelete');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          color_id: color_id
        },
        success: function(response) {
          $('table#tab_color tr#color_id_' + color_id).remove();
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });


    // Basic
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
      messages: {
        default: 'Glissez-déposez un fichier ici ou cliquez',
        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
        remove: 'Supprimer',
        error: 'Désolé, le fichier trop volumineux'
      }
    });

    // Used events
    var drEvent = $('#input-file-events').dropify();


    drEvent.on('dropify.beforeClear', function(event, element) {
      return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element) {
      alert('File deleted');
    });

    drEvent.on('dropify.errors', function(event, element) {
      console.log('Has Errors');
    });

    var drDestroy = $('#input-file-to-destroy').dropify();

    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e) {
      e.preventDefault();
      if (drDestroy.isDropified()) {
        drDestroy.destroy();
      } else {
        drDestroy.init();
      }
    })

    /*show  images in multiple selected*/
    $(".imageclass").click(function() {
      $(".classimage").empty();
    });


    function preview_images() {
      var total_file = document.getElementById("images").files.length;
      for (var i = 0; i < total_file; i++) {
        $('#image_preview').append(
          "<div class='col-md-3 col-sm-3 col-xs-12 removeimage delete_image classimage'><img src='" + URL
          .createObjectURL(event.target.files[i]) + "' width='100px' height='60px'> </div>");
      }
    }


    /*new image append*/
    $("#add_new_images").click(function() {
      var image_id = $("#tab_images > tbody > tr").length;
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          image_id: image_id
        },
        success: function(response) {
          $("#tab_images > tbody").append(response);
          return false;
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });



    $('body').on('click', '.delete_image', function() {

      var delete_image = $(this).attr('imgaeid');
      var url = $(this).attr('delete_image');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          delete_image: delete_image
        },
        success: function(response) {
          $('div#image_preview div#image_remove_' + delete_image).remove();
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
      return false;
    });

    /*If put firstly any white space then clear textbox*/
    $('body').on('keyup', '.vehical_type', function() {

      var vehical_typeVal = $(this).val();

      if (!vehical_typeVal.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });

    $('body').on('keyup', '.vehical_brand', function() {

      var vehical_brandVal = $(this).val();

      if (!vehical_brandVal.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });

    $('body').on('keyup', '.fuel_type', function() {

      var fuel_typeVal = $(this).val();

      if (!fuel_typeVal.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });

    $('body').on('keyup', '.vehi_modal_name', function() {

      var vehi_modal_nameVal = $(this).val();

      if (!vehi_modal_nameVal.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });


    /*Custom Field manually validation*/
    var msg31 = "{{ trans('message.field is required') }}";
    var msg32 = "{{ trans('message.Only blank space not allowed') }}";
    var msg33 = "{{ trans('message.Special symbols are not allowed.') }}";
    var msg34 = "{{ trans('message.At first position only alphabets are allowed.') }}";

    /*Form submit time check validation for Custom Fields */
    $('body').on('click', '.updateVehicleButton', function(e) {
      $('#vehicleEdit-Form input, #vehicleEdit-Form select, #vehicleEdit-Form textarea').each(

        function(index) {
          var input = $(this);

          if (input.attr('name') == "vehical_id" || input.attr('name') == "vehicabrand" || input.attr(
              'name') == "fueltype" || input.attr('name') == "modelname" || input.attr('name') == "price") {
            if (input.val() == "") {
              return true;
            } else {
              return true;
            }
          } else if (input.attr('isRequire') == 'required') {
            var rowid = (input.attr('rows_id'));
            var labelName = (input.attr('fieldnameis'));

            if (input.attr('type') == 'textbox' || input.attr('type') == 'textarea') {
              if (input.val() == '' || input.val() == null) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              } else if (!input.val().replace(/\s/g, '').length) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg32);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              } else if (!input.val().match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              }
            } else if (input.attr('type') == 'checkbox') {
              var ids = input.attr('custm_isd');
              if ($(".required_checkbox_" + ids).is(':checked')) {
                $('#common_error_span_' + rowid).css({
                  "display": "none"
                });
                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                $('.required_checkbox_parent_div_' + ids).css({
                  "color": ""
                });
                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
              } else {
                $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                $('.required_checkbox_' + ids).css({
                  "outline": "2px solid #a94442"
                });
                $('.required_checkbox_parent_div_' + ids).css({
                  "color": "#a94442"
                });
                e.preventDefault();
                return false;
              }
            } else if (input.attr('type') == 'date') {
              if (input.val() == '' || input.val() == null) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              } else {
                $('#common_error_span_' + rowid).css({
                  "display": "none"
                });
                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
              }
            }
          } else if (input.attr('isRequire') == "") {
            //Nothing to do
          }
        }
      );
    });


    /*Anykind of input time check for validation for Textbox, Date and Textarea*/
    $('body').on('keyup', '.common_simple_class', function() {

      var rowid = $(this).attr('rows_id');
      var valueIs = $('.common_value_is_' + rowid).val();
      var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
      var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
      var inputTypes = $('.common_value_is_' + rowid).attr('type');

      if (requireOrNot != "") {
        if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
          if (valueIs == "") {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          } else if (valueIs.match(/^\s+/)) {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg34);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          } else {
            $('#common_error_span_' + rowid).css({
              "display": "none"
            });
            $('.error_customfield_main_div_' + rowid).removeClass('has-error');
          }
        } else if (inputTypes == 'date') {
          if (valueIs != "") {
            $('#common_error_span_' + rowid).css({
              "display": "none"
            });
            $('.error_customfield_main_div_' + rowid).removeClass('has-error');
          } else {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          }
        } else {
          //alert("Yes i am radio and checkbox");
        }
      } else {
        if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
          if (valueIs != "") {
            if (valueIs.match(/^\s+/)) {
              $('.common_value_is_' + rowid).val("");
              $('#common_error_span_' + rowid).text(labelName + " : " + msg34);
              $('#common_error_span_' + rowid).css({
                "display": ""
              });
              $('.error_customfield_main_div_' + rowid).addClass('has-error');
            } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
              $('.common_value_is_' + rowid).val("");
              $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
              $('#common_error_span_' + rowid).css({
                "display": ""
              });
              $('.error_customfield_main_div_' + rowid).addClass('has-error');
            } else {
              $('#common_error_span_' + rowid).css({
                "display": "none"
              });
              $('.error_customfield_main_div_' + rowid).removeClass('has-error');
            }
          } else {
            $('#common_error_span_' + rowid).css({
              "display": "none"
            });
            $('.error_customfield_main_div_' + rowid).removeClass('has-error');
          }
        }
      }
    });


    /*For required checkbox checked or not*/
    $('body').on('click', '.checkbox_simple_class', function() {

      var rowid = $(this).attr('rows_id');
      var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
      var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
      var inputTypes = $('.common_value_is_' + rowid).attr('type');
      var custId = $('.common_value_is_' + rowid).attr('custm_isd');

      if (requireOrNot != "") {
        if ($(".required_checkbox_" + custId).is(':checked')) {
          $('.required_checkbox_' + custId).css({
            "outline": ""
          });
          $('.required_checkbox_' + custId).css({
            "color": ""
          });
          $('#common_error_span_' + rowid).css({
            "display": "none"
          });
          $('.required_checkbox_parent_div_' + custId).css({
            "color": ""
          });
          $('.error_customfield_main_div_' + rowid).removeClass('has-error');
        } else {
          $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
          $('.required_checkbox_' + custId).css({
            "outline": "2px solid #a94442"
          });
          $('.required_checkbox_' + custId).css({
            "color": "#a94442"
          });
          $('#common_error_span_' + rowid).css({
            "display": ""
          });
          $('.required_checkbox_parent_div_' + custId).css({
            "color": "#a94442"
          });
          $('.error_customfield_main_div_' + rowid).addClass('has-error');
        }
      }
    });



    $('body').on('change', '.date_simple_class', function() {

      var rowid = $(this).attr('rows_id');
      var valueIs = $('.common_value_is_' + rowid).val();
      var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
      var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
      var inputTypes = $('.common_value_is_' + rowid).attr('type');
      var custId = $('.common_value_is_' + rowid).attr('custm_isd');

      if (requireOrNot != "") {
        if (valueIs != "") {
          $('#common_error_span_' + rowid).css({
            "display": "none"
          });
          $('.error_customfield_main_div_' + rowid).removeClass('has-error');
        } else {
          $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
          $('#common_error_span_' + rowid).css({
            "display": ""
          });
          $('.error_customfield_main_div_' + rowid).addClass('has-error');
        }
      }
    });

    // added by arjun for color module dynamic add item and remove item

    var msg51 = "{{ trans('message.Please enter only alphanumeric data') }}";
    var msg52 = "{{ trans('message.Only blank space not allowed') }}";
    var msg53 = "{{ trans('message.This Record is Duplicate') }}";
    var msg54 = "{{ trans('message.An error occurred :') }}";

    /*color add  model*/
    $('.addcolor').click(function() {
            var c_name = $('.c_name').val();
            var c_code = $('.c_code').val();
            var url = $(this).attr('colorurl');

            var msg55 = "{{ trans('message.Please enter color name') }}";
            
            function define_variable() {
                return {
                    addcolor_value: $('.c_name').val(),
                    addcolor_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    addcolor_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_addcoloradd = define_variable();

            if (c_name == "") {
                swal({
                    title: msg55,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_addcoloradd.addcolor_pattern.test(call_var_addcoloradd
                    .addcolor_value)) {
                $('.c_name').val("");
                swal({
                    title: msg51,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!c_name.replace(/\s/g, '').length) {
                $('.c_name').val("");
                swal({
                    title: msg52,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_addcoloradd.addcolor_pattern2.test(call_var_addcoloradd
                    .addcolor_value)) {
                $('.c_name').val("");
                swal({
                    title: msg34,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!colorPickerChanged) {
                swal({
                    title: "Please Select color",
                    cancelButtonColor: "#C1C1C1",
                    buttons: {
                        cancel: "OK",
                    },
                    dangerMode: true,
                });
                return;
            } else {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        c_name: c_name,
                        c_code: c_code
                    },

                    //Form submit at a time only one for addColorModel
                    beforeSend: function() {
                        $(".addcolor").prop('disabled', true);
                    },

                    success: function(data) {
                        var newd = $.trim(data);
                        var classname = 'del-' + newd;

                        if (data == '01') {
                            swal({
                                title: msg53,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                        } else {
                            $('.colornametype').append('<tr class="data_color_name row mx-1 ' + classname +
                                '"><td class="text-start col-6">' + c_name +
                                '</td><td class="text-end col-6"><div class="color_code d-inline-block" style="background-color:' + c_code + '; margin-right:4px;">' + c_code + '</div><button type="button" id=' +
                                data +
                                ' deletecolor="{!! url('colortypedelete') !!}" class="btn btn-danger text-white border-0 deletecolors"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                            );

                            $('.color').append('<option value=' + data + ' style="background-color:' + c_code + ';color: #ffffff;">' + c_name +
                                '</option>');

                            $('.c_name').val('');
                        }

                        //Form submit at a time only one for addColorModel
                        $(".addcolor").prop('disabled', false);
                        return false;
                    },
                    error: function(e) {
                        alert(mag20 + ' ' + e.responseText);
                        console.log(e);
                    }
                });
            }
        });


    var msg101 = "{{ trans('message.Are You Sure?') }}";
    var msg102 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
    var msg103 = "{{ trans('message.Cancel') }}";
    var msg104 = "{{ trans('message.Yes, delete!') }}";
    var msg105 = "{{ trans('message.Done!') }}";
    var msg106 = "{{ trans('message.It was succesfully deleted!') }}";
    var msg107 = "{{ trans('message.Cancelled') }}";
    var msg108 = "{{ trans('message.Your data is safe') }}";

    /*color Delete  model*/
    $('body').on('click', '.deletecolors', function() {
      var colorid = $(this).attr('id');
      var url = $(this).attr('deletecolor');
      swal({
        title: msg1,
        text: msg2,
        icon: "warning",
        buttons: [msg3, msg4],
        dangerMode: true,
        cancelButtonColor: "#C1C1C1",
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              colorid: colorid
            },
            success: function(data) {
              $('.del-' + colorid).remove();
              $(".color_name_data option[value=" + colorid + "]")
                .remove();
              swal({
                title: msg5,
                text: colordelete,
                icon: 'success',
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
            }
          });
        } else {
          swal({
            title: msg7,
            text: msg8,
            icon: 'error',
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        }
      })



    });
  });
</script>

<script>
    // Color name to HTML color value mapping
    const colorMap = {
        "red": "#ff0000",
        "blue": "#0000FF",
        "green": "#008000",
        "black": "#000000",
        "brown": "#A52A2A",
        "grey": "#808080",
        "pink": "#FFC0CB",
        "purple": "#800080",
        "yellow": "#FFFF00",
    };
    let colorPickerChanged = false;
    function removeSpecialSymbols(str) {
        return str.replace(/[^a-zA-Z0-9]/g, '');
    }

    // Get references to the color input and text input
    const colorInput = document.getElementById("c_code");
    const textInput = document.getElementById("c_name");

    // Add an event listener to the color input to update the text input
    colorInput.addEventListener("input", function () {
        const cleanedColorCode = removeSpecialSymbols(colorInput.value);
        textInput.value = `custom${cleanedColorCode}`;
        colorPickerChanged = true;
    });
</script>


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\VehicleAddEditFormRequest', '#vehicleEdit-Form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
@endsection