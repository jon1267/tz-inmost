@extends('admin.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-baseline">
                            <h3 class="card-title">Все товары</h3>
                            <div>
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary ml-4">Добавить товар</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @if($products)
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Цена</th>
                                    <th>Изображение</th>
                                    <th>Акционная цена</th>
                                    <th style="width: 100px;">Действия</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            @if(isset($product->img))
                                                <img src="{{asset('img/'.$product->img) }}" width="70"  alt="image">
                                            @endif
                                        </td>
                                        <td>{{ $product->action_price }}</td>

                                        <td>
                                            <form action="{{ route('admin.product.destroy', $product) }}" class="form-inline " method="POST" id="post-delete-{{$product->id}}">
                                                <div class="form-group">
                                                    {{-- ссылка независима, к форме не привязана, просто чтоб кнопы были в строку --}}
                                                    <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-primary btn-sm mr-1" title="Редактировать пост"> <i class="fas fa-pen"></i> </a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" href="#" role="button" title="Удалить пост"
                                                            onclick="confirmDelete('{{$product->id}}', 'post-delete-')" >
                                                        <i class="fas fa-trash" ></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            @if(method_exists($products, 'links'))
                                {{ $products->links() }}
                            @endif
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
