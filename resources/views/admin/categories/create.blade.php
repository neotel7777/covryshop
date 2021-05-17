@extends('adminlte::page')

@section('title', 'Админ панель')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Категории</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Категории</a></li>
                <li class="breadcrumb-item active">Создание Категории</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('categories.index') }}" class="btn-success btn">Назад</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="col-12">
                            <div class="form-group">
                                <label for="InputCatTitle">Имя категории*</label>
                                <input type="text" class="form-control" id="InputCatTitle"  name="title" placeholder="Имя категории" value="{{ old('title') }}">
                            </div>
                            @if($errors->message->first('title')!='')
                            <div class="alert alert-danger">{{ $errors->message->first('title') }}</div>
                            @endif
                            <div class="form-group">
                                <label for="InputNameField">URL категории(latin)*</label><button class="getTranlate btn-default btn">Транслитерировать имя</button>
                                <input type="text" class="form-control" id="InputNameField"  name="name" placeholder="URL категории(latin)" value="{{ old('name') }}">
                            </div>
                            @if($errors->message->first('name')!='')
                                <div class="alert alert-danger">{{ $errors->message->first('name') }}</div>
                            @endif
                            <div class="form-group">
                                <label for="selectParentCategory">Родительская категория</label>
                                <select class="custom-select form-control-border" name="parent" id="selectParentCategory">
                                    <option value="0">Корень</option>
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if(old('parent') == $category->id) SELECTED @endif>{{ $category->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="InputMetaTitleField">Заголовок метатегов</label>
                                <input type="text" class="form-control" id="InputMetaTitleField"  name="meta_title" placeholder="Заголовок метатегов" value="{{ old('meta_title') }}">
                            </div>
                            <div class="form-group">
                                <label for="InputMetaDescriptionField">Описание для метатегов</label>
                                <textarea class="form-control" name="meta_description" id="InputMetaDescriptionField" rows="5">{{ old('meta_description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="InputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name='image' id="InputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Выбрать фото</label>
                                    </div>
                                </div>
                            </div>
                            @if($errors->message->first('image')!='')
                                <div class="alert alert-danger">{{ $errors->message->first('image') }}</div>
                            @endif
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function (){

            $(".getTranlate").on('click',function (e){
                var value = $("#InputCatTitle").val();
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url     : '{{ route('categories.create') }}',
                    type    : 'GET',
                    data    : {
                        'getTranslate': 'go',
                        'value': value
                    },
                    success : function (result){
                        $("#InputNameField").val(result);
                    }
                })
            })
        });
    </script>
@stop
