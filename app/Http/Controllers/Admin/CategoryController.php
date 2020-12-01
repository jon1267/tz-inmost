<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{

    private $pageTitle = 'Категории товаров';
    private $createRoute = 'admin.category.create';
    private $editRoute = 'admin.category.edit';
    private $destroyRoute = 'admin.category.destroy';
    private $indexRoute = 'admin.category.index';
    private $storeRoute = 'admin.category.store';
    private $updateRoute = 'admin.category.update';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        return view('admin.categories.model2_content', [
            'title' => $this->pageTitle,
            'models' => Category::paginate(5),
            'createRoute' => $this->createRoute,
            'editRoute' => $this->editRoute,
            'destroyRoute' => $this->destroyRoute,
            'storeRoute' => $this->storeRoute,
            'updateRoute' => $this->updateRoute,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // модалка c формой показывается по клику на кнопе создать, тут ничего не нужно...
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //dd($request);
        if (Category::create($request->except('_token'))) {
            return redirect()->route($this->indexRoute)
                ->with(['status' => 'Данные успешно добавлены']);
        }

        $request->flash();
        return redirect()->route($this->indexRoute)
            ->with(['error' => 'Ошибка добавления данных']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        //$model = Category::find($id);
        //return view('admin.handbooks.update_modal', ['model' => $model])->render();
        //оно (выше) не запускает модальное окно с формой :( а значит нет смысла...
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreCategoryRequest  $request
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        //dd($request, $id);
        if ($request->has('id')) {
            $category = Category::find($request->id);
            $category->update($request->except('_token', '_method', 'id'));

            return redirect()->route($this->indexRoute)
                ->with(['status' => 'Данные успешно изменены']);
        }

        $request->flash();
        return redirect()->route($this->indexRoute)
            ->with(['error' => 'Ошибка обновления данных']);

    }

    /**
     * @param Int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        //dd($id, gettype($id));// Внедрен модели (Category $goods) тут не работает, тупо возвр null(!)
        $category = Category::find($id);

        if($category->delete()) {
            return redirect()->route($this->indexRoute)
                ->with(['status' => 'Данные успешно удалены.']);
        }

        return redirect()->route($this->indexRoute)
            ->with(['error' => 'Ошибка удаления данных.']);
    }
}
