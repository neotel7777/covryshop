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
                <li class="breadcrumb-item active">Категории</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('categories.create') }}" class="btn-success btn">Создать категорию</a>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table data-table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя категории</th>
                            <th>URL</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>   $(function () {
            var table = $('.data-table').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",

                columns: [

                    {data: 'id', name: 'ID'},
                    {data: 'title', name: 'Имя категории'},
                    {data: 'name', name: 'URL'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });
            $(".data-table").on("init.dt", function(){
                $('.delete_row').on('click', function() {
                    var id = $(this).attr('data-id'), row = $(this).closest('tr');
                    if(confirm('Это действие безвозвратно удалит категорию. Вы уверены?')) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: '/admin/categories/' + id,
                            type: 'DELETE',
                            success: function () {
                                row.remove();
                            }
                        })
                    }
                })
            })


        });
    </script>
@stop
