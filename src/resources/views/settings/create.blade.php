@extends('settings::layout.settings')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <hr/>
        </div>
        <div class="col-md-6">
            <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Setting</h3>
            <span class="help-block">create new record</span>
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-12">
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form method="POST" action="{{ url(config('settings.route')) }}" accept-charset="UTF-8"
                  class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="{{ $type }}"/>

                @include('settings::shared_input')
                
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2 text-right">
                        <a href="{{ url(config('settings.route')) }}" class="btn btn-default">
                            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                            Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save" aria-hidden="true"></i> Save & Continue
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection