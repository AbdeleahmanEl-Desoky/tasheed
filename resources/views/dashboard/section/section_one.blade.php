@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div id="kagepisuceng" class="kagepisuceng">

                <ol class="kagepisuceng__indicators">
                    @foreach ($Products as $index=>$Product)
                @if($index ==0)
                    <li class="kagepisuceng__indicator kagepisuceng__indicator_active" data-slide-to="0"></li>
                @else
                    <li class="kagepisuceng__indicator" data-slide-to="{{$index+1}}"></li>
                @endif
                @endforeach
                </ol>   
                
                <div class="kagepisuceng__items">
                    @foreach ($Products as $index=>$Product)
                   @if ($index == 0)
                    <div class="kagepisuceng__item kagepisuceng__item_1 kagepisuceng__item_active">
                        <div class="kagepisuceng__item_inner">

                            <span class="kagepisuceng__item_img">
                                <img class="kagepisuceng__item_photo"
                                    src="{{ $Product->image_path }}" alt="">
                            </span>

                            <span class="kagepisuceng__item_testimonial">
                                <span class="kagepisuceng__item_name">{{ $Product->name}}</span>
                                <span class="kagepisuceng__item_post"> {{ $Product->description }} </span>
                                <span class="kagepisuceng__item_name">{{ $Product->sale_price}}$</span>
                            </span>
                        </div>
                    </div>
                   @else
                    <div class="kagepisuceng__item kagepisuceng__item_{{$index+1}}">
                        <div class="kagepisuceng__item_inner">
                            <span class="kagepisuceng__item_img">
                                <img src="{{ $Product->image_path }}"
                                    alt="">
                            </span>

                            <span class="kagepisuceng__item_testimonial">
                                <span class="kagepisuceng__item_name">{{ $Product->name}}</span>
                                <span class="kagepisuceng__item_post">{{ $Product->description }}</span>
                                <span class="kagepisuceng__item_text">{{ $Product->sale_price}}$</span>
                            </span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <a class="kagepisuceng__control kagepisuceng__control_prev" href="#" role="button"></a>
                <a class="kagepisuceng__control kagepisuceng__control_next" href="#" role="button"></a>
            </div>


            @foreach ($categories as $index=>$c)
            @if($c->id == $id)
            <div class="mina" band threed="1" outlines="0" noselect padded>
                <div class="threed-parent">
                    <div class="threed-child" block>
                        <div>  <img src="{{ $c->image_path }}"
                            alt=""></div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </section>


    </div><!-- end of content wrapper -->
@endsection
