@extends('settings::layout.settings')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <hr/>
        </div>
        <div class="col-md-6">
            <h3><i class="fa fa-th-list" aria-hidden="true"></i> Manage Settings</h3>
            <span class="help-block">
                list of all system settings
            </span>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <br/>
                <div class="btn-group">
                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Setting <span
                                class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($types as $key => $type)
                            <li><a href="{{ url(config('settings.route').'/create?type='.$key) }}">{{ $type }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                <tr class="">
                    <th>Code</th>
                    <th>Type</th>
                    <th>Label</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
                <tr class="">
                    <form method="get">
                        <th>
                            <input class="form-control" name="search[code]" placeholder="Code"
                                   value="{{ $search['code'] }}"/>
                        </th>
                        <th>
                            <select class="form-control" name="search[type]">
                                <option value="" {{ $search['type'] == '' ?'disabled selected':'' }}>
                                    Select Type
                                </option>
                                @foreach($types as $key => $type)
                                    <option value="{{ $key }}" {{ $search['type'] == $key?'selected':'' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <input class="form-control" name="search[label]" placeholder="Label"
                                   value="{{ $search['label'] }}"/>
                        </th>
                        <th>
                            <input class="form-control" name="search[value]" placeholder="Value"
                                   value="{{ $search['value'] }}"/>
                        </th>
                        <th>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            <a href="{{ url(config('settings.route')) }}"
                               class="btn btn-warning"><i class="fa fa-eraser"></i></a>
                        </th>
                    </form>
                </tr>
                </thead>
                <tbody>
                @forelse($settings as $setting)
                    <tr id="tr_{{ $setting->id }}" class="{{ $setting->hidden?'warning':'' }}">
                        <td>{{ $setting->code }}</td>
                        <td>{{ $setting->type }}</td>
                        <td>{{ $setting->label }}</td>
                        <td>{{ str_limit($setting->getOriginal('value'),50) }}</td>
                        <td>
                            <a href="{{ url(config('settings.route') . '/' . $setting->id . '/edit') }}"
                               class="text-primary">
                                <i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>

                            <a href="{{ url(config('settings.route') . '/' . $setting->id) }}" class="text-danger"
                               data-tr="tr_{{ $setting->id }}"
                               data-toggle="confirmation"
                               data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                               data-btn-ok-class="btn btn-sm btn-danger"
                               data-btn-cancel-label="Cancel"
                               data-btn-cancel-icon="fa fa-chevron-circle-left"
                               data-btn-cancel-class="btn btn-sm btn-default"
                               data-title="Are you sure?"
                               data-placement="left" data-singleton="true">
                                <i class="fa fa-2x fa-times-circle-o" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <i class="fa fa-info-circle" aria-hidden="true"></i> No settings found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-right">
                        {{ $settings->appends(\Request::except('page'))->links() }}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
                // other options
            });

            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();

                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                    success: function (data) {
                        if (data['success']) {
                            toastr.success(data['success'], 'Success');
                            $("#" + data['tr']).slideUp("slow");
                        } else if (data['error']) {
                            toastr.error(data['error'], 'Error');
                        } else {
                            toastr.error('Whoops Something went wrong!!', 'Error');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });

                return false;
            });
        });
    </script>
@endsection