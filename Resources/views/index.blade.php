@extends('exchanger1c::layouts.master')

@section('content')
    <div class="container">

        <nav class="mt-5">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-config" role="tab" aria-controls="nav-config" aria-selected="true">Config</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-import" role="tab" aria-controls="nav-import" aria-selected="false">Import</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-export" role="tab" aria-controls="nav-export" aria-selected="false">Export</a>
            </div>
        </nav>
        <div class="tab-content pt-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-config" role="tabpanel" aria-labelledby="nav-home-tab">
                <form action="{{ url('/plugins/exchange1c/config') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exchange_path">Exchange URL</label>
                        <input class="form-control" type="text" name="exchange_path" id="exchange_path" value="{{ config('exchange1c.exchange_path') }}">
                    </div>
                    <div class="form-group">
                        <label for="import_dir">Import directory</label>
                        <input class="form-control" type="text" name="import_dir" id="import_dir" value="{{ env('EXCHANGER1C_IMPORT_DIR') }}">
                    </div>
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input class="form-control" type="text" name="login" id="login" value="{{ config('exchange1c.login') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" value="{{ config('exchange1c.password') }}">
                    </div>
                    <div class="form-group">
                        <label for="file_part">File part</label>
                        <input class="form-control" type="text" name="file_part" id="file_part" value="{{ config('exchange1c.file_part') }}">
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" value="false" name="use_zip">
                        <input class="form-check-input" type="checkbox" value="true" @if(config('exchange1c.use_zip')) checked @endif id="use_zip" name="use_zip">
                        <label class="form-check-label" for="use_zip">
                            Use Zip
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-import" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="{{ url('/1c_exchanger') }}" method="POST">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Mode</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="mode">
                                    <option value="import">import</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Type</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="type">
                                    <option value="catalog">catalog</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">File</label>
                                <select class="form-control" id="exampleFormControlSelect3" name="filename">
                                    @foreach($files as $file)
                                        <option value="{{$file}}">{{$file}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-export" role="tabpanel" aria-labelledby="nav-contact-tab">
                Export
            </div>
        </div>
@endsection


