@extends('Users\master_user')

@section('style')
<link href="{{ asset('css/igd_info/Igd_info_index_style.css') }}" rel="stylesheet">
@endsection

@section('nav')
<li class="nav-item">

</li>
@endsection

@section('title')
เพิ่มเมนูอาหาร
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 colblock">
        <div class="row">
            <div class="col-md-9 col-sm-8 colhead1">
                <span class="haedline1">เพิ่มคะแนนในเมนูอาหาร</span>
            </div>
        </div>

        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success')}}</p>
        </div>
        @endif

        @if(\Session::has('error'))
        <div class="alert alert-danger">
            <p>{{ \Session::get('error')}}</p>
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul> @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        

        <div class="row">
            <div class="col-md-12">

            <form action="{{url('/show_food_data')}}" method="GET" role="form">
                    <div class="input-group">
                        <input type="search" class="form-control" name="search" placeholder="ป้อนข้อมูลที่ต้องการค้นหา">
                        <select class="input-group-prepend" name="category">
                            <option value="0">ทั้งหมด</option>
                            @foreach($cate_food as $key => $value)
                            <option value="{{ $value->cate_food_id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-prepend"><button type="submit" class="btn btn-primary" style="border-radius: 5px;">ค้นหา</button></span>
                    </div>

                </form>

                
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <span>ผลลัพธ์: {{$count}}</span>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-md-9 col-sm-8 colhead1">
                <div class="col-md-12">
                    <span>การให้คะแนนเมนูอาหาร</span>
                </div>    
                <div class="col-md-12">
                    <span>1 = น้อยที่สุด</span>
                </div>    
                <div class="col-md-12">
                    <span>2 = น้อย</span>
                </div>    
                <div class="col-md-12">
                    <span>3 = ปานกลาง</span>
                </div>  
                <div class="col-md-12">
                    <span>4 = มาก</span>
                </div>  
                <div class="col-md-12">
                    <span>5 = มากที่สุด</span>
                </div>    
               
            </div>
        </div> -->


        <div class="row">
            <div class="col-md-12">

                <div class="table-responsive">
                    <table class="table tbb" style="width: 1050;">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">รูป</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">แคลอรี่</th>
                                <!-- <th scope="col">คะแนน</th> -->
                                <!-- <th scope="col">ดาวทดลอง</th> -->
                                <th scope="col">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($count == 0)
                            <tr>
                                <td class="text-danger">**ไม่มีข้อมูล**</td>
                            </tr>
                            @endif

                            @foreach($food_info as $key => $value)
                            <form action="{{url('/add_data_rating')}}" method="POST" role="form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td class="table_img"><img src="{{ asset('/storage/images/food/'.$value->image) }}" class="img_igd" alt="Image"></td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->calorie }}</td>
                                        <input type="hidden" name="user_id" value="1">
                                        <input type="hidden" name="food_id" value="{{ $value->food_id }}">
                                        <!-- <td>
                                            <input type="number" min="0" max="5" class="form-control" name="score" value="">
                                        </td> -->
                                        <!-- <td>
                                            <i class="fa fa-star" data-index="0" name="score" value=""></i>
                                            <i class="fa fa-star" data-index="1" name="score" value=""></i>
                                            <i class="fa fa-star" data-index="2" name="score" value=""></i>
                                            <i class="fa fa-star" data-index="3" name="score" value=""></i>
                                            <i class="fa fa-star" data-index="4" name="score" value=""></i>
                                        </td> -->
                                        <td>
                                        <a href= "{{url('/menu/rating', $value->food_id)}}" type="button" class="btn btn-primary">view</a>
                                        </td>
                                    </tr>
                                </div>
                            </form>
                            @endforeach
                        </tbody>
                    </table>

                    

                </div>
                {!! $food_info->links() !!}


            </div>
            <a href= "{{url('/show_data_rating')}}" type="button" class="btn btn-danger">ย้อนกลับ</a>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function (){

        resetStarColor();

        $('.fa-star').mouseover(function (){
           resetStarColor();

           var currentIndex = parseInt($(this).data('index'));

           for (var i=0; i <= currentIndex; i++)
                $('.fa-star:eq('+i+')').css('color', 'orange');
        });

        $('.fa-star').mouseleave(function (){
            resetStarColor();
        });

        function resetStarColor() {
            $('.fa-star').css('color', 'black')
        }

    });
</script> -->


@endsection