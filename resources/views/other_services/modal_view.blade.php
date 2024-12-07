<div class="modal-header">
    <h4 class="modal-title">{{ trans($logo->system_name) }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="row mt-2">
        <!-- Name Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-label">{{ trans('message.Name') }}</label>
                <input type="text" id="name" class="form-control" value="{{ $service->name }}" disabled>
            </div>
        </div>

        <!-- Short Description Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="short_description" class="form-label">{{ trans('message.Short Description') }}</label>
                <input type="text" id="short_description" class="form-control" value="{{ $service->short_description }}" disabled>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <!-- Cylinder Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="cylinder" class="form-label">{{ trans('message.Cylinder') }}</label>
                <input type="text" id="cylinder" class="form-control" value="{{ $service->cylinder }}" disabled>
            </div>
        </div>

        <!-- Price Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="price" class="form-label">{{ trans('message.Price') }}</label>
                <input type="number" id="price" class="form-control" value="{{ $service->price }}" disabled>
            </div>
        </div>
    </div>
</div>
