@extends('layouts.app')

@section('content')
<div class = "container">
    <div class = "row justify-content-center">
        <div class = "col-md-8">
            <div class = "card">
                <div class = "card-header">{{ __('商品情報編集画面') }}</div>

                <div class = "card-body">
                    <form method = "POST" action = "{{ route('products.update', $product) }}" enctype = "multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class = "row mb-3">
                            <label for = "product_id" class = "col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                            <div class = "col-md-6 d-flex align-items-center">
                                <div> {{ $product->id }} </div>
                            </div>
                        </div>  

                        <div class = "row mb-3">
                            <label for = "product_name" class = "col-md-4 col-form-label text-md-end">{{ __('商品名') }}<span style = "color: red;">*</span></label>

                            <div class="col-md-6">
                                <input id = "product_name" type = "text" class = "form-control @error('product_name') is-invalid @enderror" name = "product_name" value = "{{ $product -> product_name }}" autocomplete = "product_name" autofocus>

                                @error('product_name')
                                    <span class = "invalid-feedback" role = "alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <label for = "company_id" class = "col-md-4 col-form-label text-md-end">{{ __('メーカー名') }}<span style = "color: red;">*</span></label>

                            <div class="col-md-6">
                                <select id = "company_id" class = "form-select @error('company_id') is-invalid @enderror" name = "company_id" autocomplete = "company_id" size = "1">
                                    @foreach($companies as $company)
                                        <option value = "{{ $company -> id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>
                                            {{ $company -> company_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('company_id')
                                    <span class = "invalid-feedback" role = "alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    
                        <div class = "row mb-3">
                            <label for = "price" class = "col-md-4 col-form-label text-md-end">{{ __('価格') }}<span style = "color: red;">*</span></label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stock" class="col-md-4 col-form-label text-md-end">{{ __('在庫数') }}<span style="color: red;">*</span></label>

                            <div class="col-md-6">
                                <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $product->stock }}" autocomplete="stock">

                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">{{ __('コメント') }}</label>

                            <div class="col-md-6">
                                <textarea id="comment" class="form-control" name="comment">{{ $product->comment }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="img_path" class="col-md-4 col-form-label text-md-end">{{ __('商品画像') }}</label>

                            <div class="col-md-6">
                                <input id="img_path" type="file" class="form-control @error('img_path') is-invalid @enderror" name="img_path" accept="image/*">
                                <img src="{{ asset($product->img_path) }}" alt="商品画像" class="product_image" width=300>

                                @error('img_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('更新') }}
                                </button>

                                @if (Route::has('home'))
                                <a class="btn btn-primary" href="{{ route('products.show', $product) }}">
                                    {{ __('戻る')}}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
