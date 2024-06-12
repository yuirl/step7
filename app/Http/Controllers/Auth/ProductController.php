<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Company;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ProductsRegister; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //商品情報一覧
    public function index(Request $request){
        $query = Product::query();
        $search_words = $request -> input('search');

        //if you search by name of products
        if($search_words){
            $query -> where('product_name', 'LIKE', '%'. $search_words. '%');
        }

        $company_search = $request -> input('company_id');
        //if you search by company name
        if($company_search){
            $query -> where('company_id', $company_search);
        }  

        $products = $query -> paginate(10);
        $companies = Company::all();

        return view('home' , compact ('products' , 'companies') );
    }




    //商品登録画面のメーカー名選択用ドロップダウンリスト
    public function create(){
        $companies = Company::all();
        return view('products.products_register', compact('companies'));
    }

    //送付されたデータをデータベースに登録する(商品登録画面)
    public function store(Request $request){
        $request  ->  validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'nullable',
            'img_path' => 'nullable|image|max:2048',
        ]);

        //新しく商品（レコード）を作る
        $product = new Product([
            'product_name' => $request -> get('product_name'),
            'company_id' => $request -> get('company_id'),
            'price' => $request -> get('price'),
            'stock' => $request -> get('stock'),
            'comment' => $request -> get('comment'),
        ]);
            
        if($request -> hasFile('img_path')){
            $filename = $request -> img_path -> getClientOriginalName();
            $filePath = $request -> img_path -> storeAs('products', $filename, 'public');
            $product -> img_path = '/storage/'.$filePath;
        }

        $product -> save();

        return redirect( route('products.create') ); 
    }

    //商品詳細画面
    public function show(Product $product){
        return view('products.products_detail', ['product' => $product]);
    }

    //商品編集画面
    public function edit(Product $product){
        $companies = Company::all();
        return view('products.products_editor', compact('product', 'companies'));
    }

    public function update(Request $request, Product $product){
        $request -> validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $product -> product_name = $request -> product_name;
        $product -> company_id = $request -> company_id;
        $product -> price = $request -> price;
        $product -> stock = $request -> stock;
        $product -> comment = $request -> comment;
        
        if($request -> hasFile('img_path')){
            $filename = $request -> img_path -> getClientOriginalName();
            $filePath = $request -> img_path -> storeAs('products', $filename, 'public');
            $product -> img_path = '/storage/?'.$filepath;
        }

        $product  ->  save();

        return redirect() -> route('products.edit', $product -> id); //hasChanged
    }

    //商品情報削除
    public function destroy(Product $product){
        $product -> delete();
        return redirect('/home');
    }
}
