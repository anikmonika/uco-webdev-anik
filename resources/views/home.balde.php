<x-template>
    <div class="container-fuild">
        <div class="row">
            @for($i=0;$i<5;$i++)
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <img src="https://obs.line-scdn.net/r/ect/ect/image_167414553700388254722dc5318t110595f1" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">CARLYN BAG {{$i}}</h5>
                        <p class="card-text"></p>
                        <a href="{{ route('catalog-detail', ['id'=> $i]) }}" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</x-template>
