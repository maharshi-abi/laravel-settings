<div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
    <label class="control-label col-md-2" for="code">Code <sup class="text-danger">*</sup></label>
    <div class="col-md-10">
        <input class="form-control" name="code" id="code" type="text" placeholder="Code"
               value="{{ old('code',isset($setting)?$setting->code:null) }}"/>
        <span class="help-block">
                            code will be used for getting the setting value
                        </span>
    </div>
</div>
<div class="form-group {{ $errors->has('label') ? ' has-error' : '' }}">
    <label class="control-label col-md-2" for="label">Label <sup class="text-danger">*</sup></label>
    <div class="col-md-10">
        <input class="form-control" name="label" id="label" type="text" placeholder="Label"
               value="{{ old('label',isset($setting)?$setting->label:null) }}"/>
        <span class="help-block">
                            label describes the setting
                        </span>
    </div>
</div>
<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        <input type="checkbox" name="hidden" value="1" {{ isset($setting) && $setting->hidden?'checked':'' }}
        data-toggle="toggle" data-onstyle="danger" data-offstyle="success"
               data-on="Hidden" data-off="Visible"/>
        <span class="help-block">
                            <i class="fa fa-warning"></i>
                            click to switch option
                            <br/><b>Visible:</b>
                            <br/>available for editing and shown in list.
                            <br/><b>Hidden:</b>
                            <br/>readonly and not shown in list
                            <br/>unless <b>show_hidden_records</b> in settings config file is enabled.
                        </span>
    </div>
</div>