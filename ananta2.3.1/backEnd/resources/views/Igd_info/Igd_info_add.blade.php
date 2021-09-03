@extends('master')

@section('style')
<link href="{{ asset('css/igd_info/Igd_info_add_style.css') }}" rel="stylesheet">
@endsection

@section('title')
เพิ่มข้อมูลวัตถุดิบใหม่
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 colblock">
        <div class="row">
            <div class="col-md-12 line3">
                <span class="haedline">เพิ่มข้อมูลวัตถุดิบใหม่</span>
            </div>
        </div>

        <!-- @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul> @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif -->

        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success')}}</p>
        </div>
        @endif

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <form action="{{url('/igd-info/add')}}" method="POST" role="form" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="">ชื่อวัตถุดิบ</label>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control ipMIGD mb-3" name="name" value="{{ old('name') }}">

                        <label for="">ประเภท</label>
                        @error('category')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <select class="form-control mb-3" name="category" id="selecter" onChange="goAddCate()">
                            <option selected>เลือกประเภท</option>
                            @foreach($cate_igd as $key => $value)
                            <option value="{{ $value->cate_igd_id }}">{{ $value->name }}</option>
                            @endforeach
                            <option value="-5">เพิ่มประเภท</option>
                        </select>

                        <img src="" onClick="triggerClick()" id="profileDisplay">
                        <label for="">อัพโหลดรูป</label>
                        @error('img')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="custom-file mb-3">
                            <input type="file" class="form-control custom-file-input" onChange="displayImage(this)" id="profileImage" name="img">
                            <label class="custom-file-label" for="profileImage">เลือกรูปภาพ</label>
                        </div>
                        
                        <label for="">ที่มาของรูปภาพ</label>
                        @error('addess_img')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <label for="">(เช่น https://www.maeban.co.th/) </label>
                        <input type="text" class="form-control ipMIGD mb-3" name="addess_img" value="{{ old('addess_img') }}">

                        <label for="">แคลอรี่</label>
                        @error('cal')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="number" step="0.0001" min="0" max="9999" class="form-control ipMIGD mb-3 fontcolorpower" name="cal" value="0">

                        <label for="">ไขมัน</label>
                        @error('fat')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="number" step="0.0001" min="0" max="9999" class="form-control ipMIGD mb-3 fontcolorpower" name="fat" value="0">

                        <label for="">โปรตีน</label>
                        @error('pro')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="number" step="0.0001" min="0" max="9999" class="form-control ipMIGD mb-3 fontcolorpower" name="pro" value="0">

                        <label for="">คาร์โบไฮเดรต</label>
                        @error('car')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="number" step="0.0001" min="0" max="9999" class="form-control ipMIGD mb-3 fontcolorpower" name="car" value="0">

                        <label for="">ใยอาหาร</label>
                        @error('fib')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="number" step="0.0001" min="0" max="9999" class="form-control ipMIGD mb-3 fontcolorpower" name="fib" value="0">

                        <label for="">ที่มาของข้อมูล</label>
                        @error('addess')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <label for="">(เช่น https://www.maeban.co.th/) </label>
                        <input type="text" class="form-control ipMIGD mb-3" name="addess" value="{{ old('addess') }}">

                        <a href="{{url('/igd-info/index')}}"><button type="button" class="btn btn-primary">ย้อนกลับ</button></a>
                        <a hidden href="{{url('/igd-info/cate/create')}}" id="add_cate"><button type="button" class="btn btn-primary">เพิ่มประเภท</button></a>
                        <button type="submit" class="btn btn-success">บันทึก</button>


                    </div>

                </form>


            </div>
            <div class="col-md-2"></div>
        </div>


    </div>
</div>


@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

<script>
    function triggerClick(e) {
        document.querySelector('#profileImage').click();
    }

    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);

        }
    }

    $(document).ready(function() {
        bsCustomFileInput.init()
    })

    function goAddCate(e) {
        var value = document.getElementById("selecter").value;
        console.log(value);
        if (value == -5) {
            document.querySelector('#add_cate').click();
        }
    }
</script>
@endsection