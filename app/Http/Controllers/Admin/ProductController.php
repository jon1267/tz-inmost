<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Services\Images\Img;

class ProductController extends Controller
{
    private $img;

    public function __construct(Img $img)
    {
        $this->img = $img;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title = 'Управление товарами';
        $products = Product::paginate(5);

        return view('admin.products.products_content')
            ->with(['title'=>$title, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.products.products_create')
            ->with([
                'title'=> 'Добавить товар',
                'categories' => $categories = Category::all()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //dd($request);
        $data = $request->except('_token', 'category');
        $data['img'] = $this->img->getImg($request);
        $categories = $request->category;

        $product = Product::create($data);
        $product->categories()->attach($categories);

        return redirect()->route('admin.product.index')
            ->with(['status' => 'Данные успешно добавлены']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.products.products_create', [
            'title'=> 'Обновление товара',
            'product' => $product,
            'categories' => $categories = Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $data = $request->except('_token', '_method' ,'category');
        $data['img'] = $this->img->updateImg($request, $product);
        $categories = $request->category;

        $product->update($data);
        $product->categories()->sync($categories);

        return redirect()->route('admin.product.index')
            ->with(['status' => 'Данные успешно обновлены']);;
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('admin.product.index')
            ->with(['status' => 'Данные удалены']);

    }
}
