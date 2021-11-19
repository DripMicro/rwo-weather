@extends('main.app')

@section('content')
        <div class="main-content">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="ik ik-edit bg-blue"></i>
                                <div class="d-inline">
                                    <h5>Weather</h5>
                                    <span>longforecast</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Create Data</h3></div>
                            <form class="sample-form" method="POST" action="{{ route('admin.createData') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Year </label>
                                                        <select class="form-control select2" name="year">
                                                            <option value="{{now()->year+2}}">{{now()->year+2}}</option>
                                                            <option value="{{now()->year+1}}">{{now()->year+1}}</option>
                                                            <option value="{{now()->year}}" selected="">{{now()->year}}</option>
                                                            <option value="{{now()->year-1}}">{{now()->year-1}}</option>
                                                            <option value="{{now()->year-2}}">{{now()->year-2}}</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Month </label>
                                                        <select class="form-control select2" name="month">
                                                            @for($i = 1 ; $i < 13; $i++) 
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                            </div>
                                       
                                    </div>
                                </div>

                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Region</th>
                                                    <th>Temp</th>
                                                    <th>Humidity</th>
                                                    <th>Rainfall</th>
                                                    <th>Snowfall</th>
                                                    <th>Daylight</th>
                                                    <th>Sunshine</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datas as $data)
                                                    <tr>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->id}}_0" value="{{$data->id}}" style="display: none">{{ $data->name }}</td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->id}}_1" value="-999"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->id}}_2" value="-999"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->id}}_3" value="-999"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->id}}_4" value="-999"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->id}}_5" value="-999"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->id}}_6" value="-999"></td>
                                                    </tr> 
                                                @endforeach
                                                <tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        </div>
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection