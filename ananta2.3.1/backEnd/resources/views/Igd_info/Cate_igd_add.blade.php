@extends('master')

@section('style')
<link href="{{ asset('css/igd_info/Igd_info_add_style.css') }}" rel="stylesheet">
@endsection

@section('title')
เพิ่มประเภทวัตถุดิบใหม่
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 colblock">
        <div class="row">
            <div class="col-md-12 line3">
                <span class="haedline">เพิ่มประเภทวัตถุดิบใหม่</span>
            </div>
        </div>

        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success')}}</p>
        </div>
        @endif

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <form action="{{url('/igd-info/cate/add')}}" method="POST" role="form" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="">ชื่อประเภทวัตถุดิบ</label>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control ipMIGD mb-3" name="name" value="{{ old('name') }}">

                        <a href="{{url('igd-info/cate/index')}}"><button type="button" class="btn btn-primary">ย้อนกลับ</button></a>
                        <button type="submit" class="btn btn-success">บันทึก</button>
                    </div>

                </form>


            </div>
            <div class="col-md-2"></div>
        </div>


    </div>
</div>


@endsection
