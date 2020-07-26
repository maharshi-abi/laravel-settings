<table id="values-table" width="100%" class="table table-striped table-responsive">
    <thead>
    <tr>
        <th width="50%">Key</th>
        <th width="50%">Value</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;?>
    @foreach($setting->value as $key => $value)
        <tr id="tr_{{ $i }}" data-index="{{ $i }}">
            <td>
                <input name="{{ $setting->code."[$i][key]" }}" type="text"
                       value="{{ $key }}" class="form-control"/>
            </td>
            <td>
                <input name="{{ $setting->code."[$i][value]" }}" type="text"
                       value="{{ $value }}" class="form-control"/>
            </td>
            <td>
                <button type="button" class="btn btn-danger remove-value"
                        data-index="{{ $i }}"><i
                            class="fa fa-remove"></i>
                </button>
            </td>
        </tr>
        <?php $i++;?>
    @endforeach
    </tbody>
</table>

<div class="">
    <button type="button" class="btn btn-success" id="add-value"><i
                class="fa fa-plus"></i>
    </button>
    <span class="help-block">
                            click to add new key value pair.
                        </span>
</div>