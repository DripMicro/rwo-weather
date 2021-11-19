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
                            <div class="card-header"><h3>Update Data</h3></div>
                            
                                <div class="card-body">
                                    <form class="sample-form" method="POST" action="{{ route('getUpdateData') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Year </label>
                                                    <select class="form-control select2" name="year">
                                                        @if($year == now()->year)
                                                            <option value="{{now()->year}}"  selected="">{{now()->year}}</option>
                                                        @else
                                                            <option value="{{now()->year}}">{{now()->year}}</option>
                                                        @endif
                                                        @if($year == now()->year+1)
                                                            <option value="{{now()->year+1}}"  selected="">{{now()->year+1}}</option>
                                                        @else
                                                            <option value="{{now()->year+1}}">{{now()->year+1}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Month </label>
                                                        <select class="form-control select2" name="month">
                                                            @for($i = 1 ; $i < 13; $i++)
                                                                @if($month == $i)
                                                                    <option value="{{$i}}" selected="">{{$i}}</option>
                                                                @else
                                                                    <option value="{{$i}}">{{$i}}</option>
                                                                @endif
                                                            @endfor
                                                        </select>
                                                    </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">See</button>
                                    </form>
                                </div>
                            <form class="sample-form" method="POST" action="{{ route('admin.updateData') }}">
                            @csrf
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" style="text-align: center;">
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
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->region}}_0" value="{{$data->id}}" style="display: none">
                                                            @foreach ($region as $r)
                                                                @if($r->id == $data->region)
                                                                    {{$r->name}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->region}}_1" value="{{$data->temp}}"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->region}}_2" value="{{$data->humidity}}"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->region}}_3" value="{{$data->rainfall}}"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->region}}_4" value="{{$data->snowfall}}"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->region}}_5" value="{{$data->daylight}}"></td>
                                                        <td><input type="number" class="form-control form-control-default" name="data_{{$data->region}}_6" value="{{$data->sunshine}}"></td>
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