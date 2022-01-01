@extends('products.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('products.index') }}" class="btn btn-primary"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input. <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('products.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <strong>Name : </strong>
                    <input type="text" placeholder="Name" name="name" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <strong>Alamat : </strong>
                    <textarea style="100px;" type="text" placeholder="Alamat" name="alamat"
                        class="form-control"></textarea>
                </div>
            </div>

            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <strong>Detail : </strong>
                    <textarea style="150px;" type="text" placeholder="Detail" name="detail"
                        class="form-control"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 text-center">
                <button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>
        </div>
    </form>
@endsection
