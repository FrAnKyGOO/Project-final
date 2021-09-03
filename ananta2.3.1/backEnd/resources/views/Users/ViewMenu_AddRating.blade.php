@extends('Users\master_user')

@section('style')
<link href="{{ asset('css/food/food_show_style.css') }}" rel="stylesheet">
<link href="{{ asset('css/Users/viewmenu_rating.css') }}" rel="stylesheet">
@endsection

@section('nav')

@endsection

@section('title')
แสดงเมนูอาหาร
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <form action="{{url('/ViewMenu_AddRating')}}" method="POST" role="form">


                {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{Auth::user()->user_profile->user_id}}">
                <input type="hidden" name="food_id" value="{{$food->food_id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">คะแนนเมนูอาหาร</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rating-css">
                        <div class="star-icon">
                            <input type="radio" value="1" name="score_rating" checked id="rating1">
                            <label for="rating1" class="fa fa-star"></label>
                            <input type="radio" value="2" name="score_rating" id="rating2">
                            <label for="rating2" class="fa fa-star"></label>
                            <input type="radio" value="3" name="score_rating" id="rating3">
                            <label for="rating3" class="fa fa-star"></label>
                            <input type="radio" value="4" name="score_rating" id="rating4">
                            <label for="rating4" class="fa fa-star"></label>
                            <input type="radio" value="5" name="score_rating" id="rating5">
                            <label for="rating5" class="fa fa-star"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>

            </form>



        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 colblock">
        <div class="row">
            <div class="col-md-9 col-sm-8 colhead1">
                <span class="sphead" style="font-size: 150%;">ข้อมูลเมนู</span>
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

        <div class="row">
            <div class="col-md-4">

                <div class="row rowfoodinfo">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-9">
                        <img src="{{ asset('/storage/images/food/'.$food->image) }}" id="profileDisplay">
                    </div>
                </div>

            </div>


            <div class="col-md-4">
                <div class="row rowfoodinfo">
                    <div class="col-md-3 colfoodinfo">
                        <span>ชื่อ</span>
                    </div>
                    <div class="col-md-9">
                        <label class="form-control lainfo">{{ $food->name }}</label>
                    </div>
                </div>

                <div class="row rowfoodinfo">
                    <div class="col-md-3 colfoodinfo">
                        <span>ประเภท</span>
                    </div>
                    <div class="col-md-9">
                        <label class="form-control lainfo">{{ $food->cate_food->name }}</label>
                    </div>
                </div>

                <div class="row rowfoodinfo">
                    <div class="col-md-3 colfoodinfo">
                        <span>แคลอรี่</span>
                    </div>
                    <div class="col-md-9">
                        <label class="form-control lainfo">{{ $food->calorie }}</label>
                    </div>
                </div>

                <div class="row rowfoodinfo">
                    <div class="col-md-3 colfoodinfo">
                        <span>ไขมัน</span>
                    </div>
                    <div class="col-md-9">
                        <label class="form-control lainfo">{{ $food->fat }}</label>
                    </div>
                </div>

            </div>


            <div class="col-md-4">

                <div class="row rowfoodinfo">
                    <div class="col-md-3 colfoodinfo">
                        <span>โปรตีน</span>
                    </div>
                    <div class="col-md-9">
                        <label class="form-control lainfo">{{ $food->protein }}</label>
                    </div>
                </div>

                <div class="row rowfoodinfo">
                    <div class="col-md-3 colfoodinfo">
                        <span>คาร์โบไฮเดรต</span>
                    </div>
                    <div class="col-md-9">
                        <label class="form-control lainfo">{{ $food->carbohydrate }}</label>
                    </div>
                </div>

                <div class="row rowfoodinfo">
                    <div class="col-md-3 colfoodinfo">
                        <span>ใยอาหาร</span>
                    </div>
                    <div class="col-md-9">
                        <label class="form-control lainfo">{{ $food->fiber }}</label>
                    </div>
                </div>



            </div>

        </div>

    </div>
    <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->


    <!-- วัตถุดิบ -->
    <div class="col-md-12 colblock">

        <div class="row">
            <div class="col-md-9 col-sm-8 colhead1">
                <span class="sphead" style="font-size: 150%;">รายการวัตถุดิบในเมนู</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <span>จำนวนวัตถุดิบที่ใช้: {{$count_iof}}</span>
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
                                <th scope="col">รายละเอียด</th>
                                <th scope="col">จำนวน</th>
                                <th scope="col">หน่วย</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($count_iof == 0)
                            <tr>
                                <td class="text-danger">**ไม่มีข้อมูล**</td>
                            </tr>
                            @endif

                            @foreach($iof as $key => $value)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td class="table_img"><img src="{{ asset('/storage/images/igd/'.$value->igd_info->image) }}" class="img_igd" alt="Image"></td>
                                <td>{{ $value->igd_info->name }}</td>
                                <td>{{ $value->description }}</td>
                                <td>{{ $value->value }}</td>
                                <td>{{ $value->unit }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                {!! $iof->links() !!}
            </div>
        </div>


    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <!-- รายการวิธีทำ -->
    <div class="col-md-12 colblock">

        <div class="row">
            <div class="col-md-9 col-sm-8 colhead1">
                <span class="sphead" style="font-size: 150%;">รายการวิธีทำ</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <span>จำนวนวิธีทำ: {{$count_step}}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive" style="table-layout: fixed; width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับที่</th>
                            <th scope="col">รายละเอียด</th>

                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($count_step != 0)
                        @foreach($step as $key => $value)

                        <tr>
                            <th scope="row">{{ $value->order }}</th>
                            <td>{{ $value->step }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="text-danger">**ไม่มีข้อมูล**</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-md-2"></div> -->
                <div class="col-md-12">
                    <div class="row rowfoodinfo">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ให้คะแนนเมนู</button>
                    </div>
                </div>
            <!-- <div class="col-md-2"></div> -->
        </div>

    </div>



    @endsection