@extends('admin.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="m-0">{{ (isset($product)) ? 'Обновление товара' : 'Ввод товара' }}</h5>
                        </div>
                        <div class="card-body">

                            <!-- -->
                            <form  action="{{ (isset($product)) ? route('admin.product.update', $product) : route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($product))
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name">Наименование товара</label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text"
                                           id="title" name="title" placeholder="Наименование товара"
                                           value="{{(isset($product->title)) ? $product->title : old('title')}}">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Цена товара</label>
                                    <input class="form-control @error('price') is-invalid @enderror" type="text"
                                           id="price" name="price" placeholder="Цена товара"
                                           value="{{(isset($product->price)) ? $product->price : old('price')}}">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="action_price">Акционная цена товара</label>
                                    <input class="form-control @error('action_price') is-invalid @enderror" type="text"
                                           id="action_price" name="action_price" placeholder="Акционная цена товара"
                                           value="{{(isset($product->action_price)) ? $product->action_price : old('action_price')}}">
                                    @error('action_price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @if(isset($product) && (!is_null($product->img)))
                                    <div class="form-group">
                                        <label for="old_img"><small>Старое изображение</small></label>
                                        <div><img id="old_img" src="{{asset('img/'.$product->img)}}" width="100" alt="Image"></div>
                                    </div>
                                @endif

                                <div class="form-group ">
                                    <label for="exampleInputFile">Изображение товара</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('img') is-invalid @enderror" id="img" name="img" aria-describedby="customFileInput">
                                            <label class="custom-file-label" for="customFileInput">Выберите изображение</label>
                                        </div>
                                    </div>
                                    @error('img')
                                        <span class="invalid-feedback" style="display: inline-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-5">
                                    <label for="title">Категория товара (испльзуйте Ctrl+Click) </label><br>
                                    <select multiple id="category" name="category[]" size="3"
                                            class="form-control @error('category') is-invalid @enderror" >
                                        @foreach($categories as $category)
                                            {{--<option value="{{ $category->id }}">{{ $category->title }}</option>--}}
                                            <option value="{{ $category->id }}"
                                            @if(isset($product) && in_array($category->id, $product->categories()->where('product_id', $product->id)->pluck('category_id')->toArray()))  selected  @endif>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- dd($product->categories()->where('product_id', $product->id)->pluck('category_id')) --}}
                                    @error('category')
                                        <span class="invalid-feedback" style="display: inline-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="far fa-save mr-2"></i>Сохранить товар </button>
                                    <a href="{{ route('admin.product.index') }}" class="btn btn-info ml-2"> <i class="fas fa-sign-out-alt mr-2"></i>Отмена</a>
                                </div>
                            </form>
                            <!-- -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
