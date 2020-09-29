@php
$boxed=$data->getElement();
$items=$boxed->items;
@endphp
<div class="bg-lighter trending-products">
    <div class="heading heading-flex mb-3">
        <div class="heading-left">
            <h2 class="title">{{$boxed->title}}</h2><!-- End .title -->
        </div><!-- End .heading-left -->

        <div class="heading-right">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <?php $i=0;?>
                @foreach ($items as $item)
                    
                <li class="nav-item">
                    <a class="nav-link {{$i==0?"active":""}}" id="trending-all-link" data-toggle="tab" href="#boxeditems_{{$item->id}}" role="tab" aria-controls="trending-all-tab" aria-selected="true">{{$item->title}}</a>
                </li>
                <?php $i+=1;?>
                @endforeach
               
            </ul>
        </div><!-- End .heading-right -->
    </div><!-- End .heading -->

    <div class="tab-content tab-content-carousel">
        <?php $i=0;?>
        @foreach ($items as $item)
            
            @include(\App\Setting\HomePage::theme('elements.boxeditem'),['item'=>$item,'i'=>$i])
            <?php $i+=1;?>
        @endforeach
      
    </div><!-- End .tab-content -->
</div><!-- End .bg-lighter -->