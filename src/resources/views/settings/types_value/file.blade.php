<div class="form-group {{ $errors->has('value') ? ' has-error' : '' }}">
    <label class="control-label col-md-2" for="value">Value <sup class="text-danger">*</sup></label>
    <div class="col-md-10">
        <input class="form-control" name="value" id="value" type="file" placeholder="Value"/>
        <span class="help-block">
                            the value that assigned to this setting
                        </span>
        @if(!empty($setting->value))
            <a style="margin-bottom: 5px;" class="btn btn-info"
               href="{{ url(config('settings.route').'/download/'.$setting->id) }}"
               target="_blank">
                <i class="fa fa-download"></i> Download {{ $setting->getOriginal('value') }}
            </a>
        @endif
    </div>
</div>