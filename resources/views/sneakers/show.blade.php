@extends('layouts.app')

@section('title', $sneaker->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $sneaker->name }}</h4>
                <div>
                    <a href="{{ route('sneakers.edit', $sneaker) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('sneakers.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($sneaker->image)
                            <img src="{{ asset('storage/' . $sneaker->image) }}" 
                                 alt="{{ $sneaker->name }}" 
                                 class="img-fluid rounded">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                 style="height: 300px;">
                                <i class="fas fa-shoe-prints fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Brand:</th>
                                <td>{{ $sneaker->brand }}</td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{{ $sneaker->description }}</td>
                            </tr>
                            <tr>
                                <th>Price:</th>
                                <td class="text-success fw-bold">${{ number_format($sneaker->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Size:</th>
                                <td>{{ $sneaker->size }}</td>
                            </tr>
                            <tr>
                                <th>Color:</th>
                                <td>{{ $sneaker->color }}</td>
                            </tr>
                            <tr>
                                <th>Stock:</th>
                                <td>
                                    <span class="badge {{ $sneaker->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $sneaker->stock }} {{ $sneaker->stock == 1 ? 'item' : 'items' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Added:</th>
                                <td>{{ $sneaker->created_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection