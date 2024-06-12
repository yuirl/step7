@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品一覧画面') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mb-3">
                        <form action="{{ route('products.index') }}" method="GET" class="row g-3">
                            <div class="col-sm-12 col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="検索キーワード" value="{{ request('search') }}">
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <select id="company_id" name="company_id" class="form-select" size="1">
                                    <option value="" disabled selected style="display:none;"> メーカー名 </option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company -> id }}"> {{ $company -> company_name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                 <button class="btn btn-outline-secondary" type="submit"> 検索 </button>
                             </div>
                        </form>
                    </div>

                    <div class="row mb-3">
                    <link rel="stylesheet" type="text/css" href="css/styles.css">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="90px;"> ID </th>
                                    <th width="100px;"> 商品画像 </th>
                                    <th width=";"> 商品名 </th>
                                    <th width=";"> 価格 </th>
                                    <th width=";"> 在庫数 </th>
                                    <th width=";"> メーカー名 </th>
                                    <th width=";">
                                        <a class="btn btn-primary mb-3" href="{{ route('products.create') }}">
                                        {{ __('新規登録') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product -> id }}</td>
                                    <td><img src="{{ asset($product -> img_path) }}" alt="商品画像" width=100></td>    
                                    <td>{{ $product -> product_name }}</td>    
                                    <td>{{ $product -> price }}</td>    
                                    <td>{{ $product -> stock }}</td>
                                    <td>{{ $product -> company -> company_name }}
                                    <td>
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm mx-1"> 詳細 </a>
                                        <script src="{{ asset('js/confirmDelete.js') }}"></script>
                                        <form id= "deleteForm" method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline" onclick="return confirmDelete()" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-1"> 削除 </button>
                                        </form>
                                    <td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $products -> appends(request() -> query() ) -> links() }}
    </div>
</div>
@endsection
