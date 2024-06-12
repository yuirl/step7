@extends('layouts.app')

@section('content')
<div class = "container">
    <div class = "row justify-content-center">
        <div class = "col-md-8">
            <div class = "card">
            
                <div class = "card-body">
                    <dl class = "row mt-3">
                        <dt class = "col-sm-3"> {{ __('商品情報ID')}} </dt>
                        <dd class = "col-sm-9"> {{ $product->id }} </dd>
                        <dt class = "col-sm-3"> {{ __('商品画像') }} </dt>
                        <dd class= "com-sm-9"> <img src="{{ asset($product->img_path) }}" width="300"> </dd>
                        <dt class= "col-sm-3"> {{ __('商品名') }} </dt>
                        <dd class= "com-sm-9"> {{ $product->product_name }} </dd>
                        <dt class= "col-sm-3"> {{ __('メーカー名') }}</dt>
                        <dd class= "com-sm-9"> {{ $product->company->name }} </dd>
                        <dt class= "col-sm-3"> {{ __('価格') }} </dt>
                        <dd class= "com-sm-9"> {{ $product->price }} </dd>
                        <dt class= "col-sm-3"> {{ __('在庫数') }} </dt>
                        <dd class= "com-sm-9"> {{ $product->stock }} </dd>
                        <dt class= "col-sm-3"> {{ __('コメント') }} </dt>
                        <dd class= "com-sm-9"> {{ $product->comment }} </dd>
                    </dl>
                    <div class = "row mb-0">
                        <div class = "col-md-6 offset-md-4">
                            <a href = "{{ route('products.edit',$product) }}" class = "btn btn-primary">
                                {{ __('編集') }}
                            </a>
                            @if (Route::has('home'))
                            <a class = "btn btn-primary" href = "{{ route('home') }}">
                                {{ __('戻る')}}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection