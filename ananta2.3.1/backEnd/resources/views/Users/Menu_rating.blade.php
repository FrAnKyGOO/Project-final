@extends('Users\master_user')



@section('title')
รายการการให้คะแนนเมนูอาหาร
@endsection

@section('style')
<link href="{{ asset('css/Users/show_food_user.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <form action="{{url('/add_data_nutrition')}}" method="POST" role="form" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12 colblock">


                    <div class="row">
                        <div class="col-md-9 col-sm-8 colhead1">
                            <span class="sphead" style="font-size: 150%;">รายการคะแนนเมนูอาหาร</span>
                        </div>
                        <div class="col-md-3 col-sm-4 colhead2">
                            <a href="{{ url('/rating_menu') }}" class="btn btn-success" style="height: 100%; width: 100%;">ให้คะแนนเมนูอาหาร</a>
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
                        
                        <div class="col-md-12 mb-3">
                            <span>จำนวนเมนูที่ให้คะแนน: {{$count}}</span>
                        </div>
                    </div>
                   

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table tbb">
                                    <thead>
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">รูป</th>
                                            <th scope="col">ชื่อ</th>
                                            <th scope="col">แคลอรี่</th>
                                            <th scope="col">คะแนน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($count == 0)
                                        <tr>
                                            <td class="text-danger">**ไม่มีข้อมูล**</td>
                                        </tr>
                                        @endif

                                        @foreach($ratingDB as $key => $value)

                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            <td class="table_img"><img src="{{ asset('/storage/images/food/'.$value->food->image) }}" class="img_igd" alt="Image"></td>
                                            <td>{{ $value->food->name }}</td>
                                            <td>{{ $value->food->calorie }}</td>
                                            <td>{{ $value->rating_score}}</td>

                                            <!-- <td>
                                                <button type="submit" class="btn btn-primary">แก้ไข</button>
                                            </td> -->

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {!! $ratingDB->links() !!}
                    </div>

                    <!-- <button type="submit" class="btn btn-success">บันทึก</button> -->

                </div>
            </form>
        </div>
    </div>
             

@endsection