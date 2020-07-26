<div class="form-group">
    <label class="control-label col-md-2" for="value">Value <sup class="text-danger">*</sup></label>
    <div class="col-md-10">
        <input type="checkbox" name="value" value="1" {{ $setting->value == 'true'?'checked':'' }}
        data-toggle="toggle" data-onstyle="success" data-offstyle="default"
               data-on="True" data-off="False"/>
        <span class="help-block">
                            the value that assigned to this setting
                        </span>
    </div>
</div>