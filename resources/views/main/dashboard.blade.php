@extends('main.app')

@section('content')
    <style>
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .imgPreview img {
            padding: 8px;
            max-width: 100px;
        } 
    </style>
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
                            <div class="card-header"><h3>Predict</h3></div>
                            <div class="card-body">
                                <form class="sample-form" method="POST" action="{{ route('getData') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Country </label>
                                                    <select class="form-control select2">
                                                        <option value="cheese">United State</option>
                                                        <option value="pepperoni">France</option>
                                                        <option value="tomatoes">China</option>
                                                        <option value="mozarella">Corea</option>
                                                        <option value="mushrooms">Japan</option>
                                                    </select>
                                                </div>
                                            
                                        </div>
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
                       <!--      <div class="card-body template-demo">
                                <a href=""><button type="button" class="btn btn-icon btn-danger btn-rounded">Y</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-secondary">1</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-success">2</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-primary">3</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-warning">4</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-info">5</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-dark">6</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-secondary">7</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-success">8</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-primary">9</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-warning">10</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-info">11</button></a>
                                <a href=""><button type="button" class="btn btn-icon btn-outline-dark">12</button></a>
                            </div> -->

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
                                                    <td>
                                                        @foreach ($region as $r)
                                                            @if($r->id == $data->region)
                                                                {{$r->name}}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>@if($data->temp != -999) {{ $data->temp }} @else - @endif</td>
                                                    <td>@if($data->humidity != -999) {{ $data->humidity }} @else - @endif</td>
                                                    <td>@if($data->rainfall != -999) {{ $data->rainfall }} @else - @endif</td>
                                                    <td>@if($data->snowfall != -999) {{ $data->snowfall }} @else - @endif</td>
                                                    <td>@if($data->daylight != -999) {{ $data->daylight }} @else - @endif</td>
                                                    <td>@if($data->sunshine != -999) {{ $data->sunshine }} @else - @endif</td>
                                                </tr> 
                                            @endforeach
                                            <tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Blogs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Post</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <div class="profiletimeline mt-0">
                                            @if($blogs)
                                            @foreach ($blogs as $blog)
                                            <div class="sl-item">
                                                <div class="sl-left"> <img src="../img/users/{{$blog->user}}.jpg" alt="user" class="rounded-circle" /> </div>
                                                <div class="sl-right">
                                                    <div> <a href="javascript:void(0)" class="link">{{$blog->user}} -  <b>{{$blog->title}}</b></a> <span class="sl-date"> {{$blog->created_at}}</span>
                                                        <div class="mt-20 row">
                                                            @if($blog->image_path != null)
                                                                <?php $images = json_decode($blog->image_path,TRUE); ?>
                                                                @for ($i = 0 ; $i < sizeof($images) ; $i++ )
                                                                    <div class="col-md-3 col-xs-12">
                                                                        <a onclick="showImage(this)" id ="{{$images[$i]}}" data-toggle="modal" data-target=".bd-example-modal-lg">
                                                                            <img src="../uploads/{{$images[$i]}}" alt="user" class="img-fluid rounded" />
                                                                        </a>
                                                                    </div>
                                                                @endfor
                                                            @endif
                                                            <div class="col-md-12 col-xs-12 mt-3">
                                                                <p> {{$blog->content}} </p>
                                                            </div>
                                                        </div>
                                                        <div class="like-comm mt-20"> 
                                                            <a href="javascript:void(0)" class="link mr-10">2 comment</a> 
                                                            <a href="javascript:void(0)" class="link mr-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">
                                        <form class="forms-sample" action="{{route('imageUpload')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @if ($message = Session::get('success'))
                                                <div class="alert alert-success">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @endif

                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="exampleInputName1">Title</label>
                                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Title" name = "title">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>File upload</label>
                                                <input type="file" name="imageFile[]" class="file-upload-default"  id="images" multiple="multiple">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                    <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                    </span>
                                                </div>
                                                <div class="user-image mb-3 text-center">
                                                    <div class="imgPreview"> </div>
                                                </div>            

                                               <!--  <div class="custom-file">
                                                    <input type="file" name="" class="custom-file-input" id="images" multiple="multiple">
                                                    <label class="custom-file-label" for="images">Choose image</label>
                                                </div>

                                                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                                    Upload Images
                                                </button> -->
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleTextarea1">Comment</label>
                                                <textarea class="form-control" id="exampleTextarea1" rows="4" name = "content"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <button class="btn btn-light">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id = "img_modal">
                
            </div>
          </div>
        </div>
        <script type="text/javascript">
            function showImage (obj) {
                // $('#img_modal').modal('show');   
                $('#img_modal').html('<img src="../uploads/'+$(obj).attr('id')+'" alt="user" class="img-fluid rounded" />');
            }
        </script>
        <script src="../js/jquery-3.5.1.slim.min.js"></script>
        <script>
            $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
            
            });    
            
    </script>
@endsection