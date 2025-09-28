@extends('layouts.app')

@section('title', 'Sneakers Menu')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="card-title mb-0">Sneakers Menu</h2>
                    <a href="{{ route('sneakers.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add New Item
                    </a>
                </div>

                @if($sneakers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Description</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Stock</th>
                                    <th>Price ($)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sneakers as $sneaker)
                                <tr>
                                    <td>
                                        @if($sneaker->image)
                                            <img src="{{ asset('storage/' . $sneaker->image) }}" 
                                                 alt="{{ $sneaker->name }}" 
                                                 class="img-thumbnail" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-shoe-prints text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $sneaker->name }}</td>
                                    <td>{{ $sneaker->brand }}</td>
                                    <td>{{ Str::limit($sneaker->description, 50) }}</td>
                                    <td>{{ $sneaker->size }}</td>
                                    <td>{{ $sneaker->color }}</td>
                                    <td>
                                        <span class="badge {{ $sneaker->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $sneaker->stock }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($sneaker->price, 2) }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('sneakers.show', $sneaker) }}" 
                                               class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('sneakers.edit', $sneaker) }}" 
                                               class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('sneakers.destroy', $sneaker) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-shoe-prints fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No sneakers available.</p>
                        <a href="{{ route('sneakers.create') }}" class="btn btn-primary">
                            Add Your First Sneaker
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection