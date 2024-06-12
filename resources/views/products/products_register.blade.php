@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品新規登録画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="product_name" class="col-md-4 col-form-label text-md-end">{{ __('商品名') }}<span style="color: red;">*</span></label>

                            <div class="col-md-6">
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autocomplete="product_name" autofocus>

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company_id" class="col-md-4 col-form-label text-md-end">{{ __('メーカー名') }}<span style="color: red;">*</span></label>

                            <div class="col-md-6">
                                <select id="company_id" class="form-select @error('company_id') is-invalid @enderror" name="company_id" required autocomplete="company_id" size="1">
                                    <option value="" disabled selected>メーカー名を選択</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company -> id }}">{{ $company -> company_name }}</option>
                                @endforeach
                                </select>

                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('価格') }}<span style="color: red;">*</span></label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="price">

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
                                <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" required autocomplete="stock">

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
                                <textarea id="comment" class="form-control" name="comment"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="img_path" class="col-md-4 col-form-label text-md-end">{{ __('商品画像') }}</label>

                            <div class="col-md-6">
                                <input id="img_path" type="file" class="form-control" name="img_path" accept="image/*">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('新規登録') }}
                                </button>

                                @if (Route::has('home'))
                                <a class="btn btn-primary" href="{{ route('home') }}">
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
