@extends('layouts.app')

@section('content')

    <table class="table">

        <thead class="table-dark">
            <tr>
                <th></th>
                <th> Propietario </th>
                <th> Placa </th>
                <th> Marca </th>
                <th> Modelo </th>
                <th> Color </th>
                <th> Número Serie </th>
                <th> Número Motor </th>
                <th> <button class="btn btn-success">Agregar Nuevo Vehiculo</button></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{$vehicle->id}}</td>
                    <td>{{$vehicle->owner_id}}</td>
                    <td>{{$vehicle->plate}}</td>
                    <td>{{$vehicle->brand_id}}</td>
                    <td>{{$vehicle->vehicle_model_id}}</td>
                    <td>{{$vehicle->color}}</td>
                    <td>{{$vehicle->serial_number}}</td>
                    <td>{{$vehicle->engine_serial}}</td>
                    <td><button class="btn btn-outline-danger">eliminar</button> <button class="btn btn-outline-warning">editar</button> </td>
                </tr>
            @endforeach


        </tbody>

    </table>
@endsection