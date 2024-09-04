@extends('layouts.app')

@section('content')

    <table class="table">

        <thead class="table-dark">
            <tr>
                <th></th>
                <th> Marcas </th>
                <th> <button class="btn btn-success">Agregar Nueva Marca</button></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($brands as $brand)
                <tr>
                    <td>{{$brand->id}}</td>
                    <td>{{$brand->name}}</td>
                    <td><button class="btn btn-outline-danger">eliminar</button> <button class="btn btn-outline-warning">editar</button> </td>
                </tr>
            @endforeach


        </tbody>

    </table>
@endsection
