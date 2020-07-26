<div class="form-group {{ $errors->has('value') ? ' has-error' : '' }}">
    <label class="control-label col-md-2" for="value">Value <sup class="text-danger">*</sup></label>
    <div class="col-md-10">
        <textarea class="form-control ck-editor" name="value" id="value" type="text" placeholder="Value">
            {{ old('value',$setting->value) }}
        </textarea>
        <span class="help-block">
                            the value that assigned to this setting
                        </span>
    </div>
</div>