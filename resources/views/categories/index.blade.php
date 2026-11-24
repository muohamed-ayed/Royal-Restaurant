@extends('layouts.admin')
@section('title', 'Categories')
@section('content')
<div class="page-wrap">
    <div class="page-heading"><div><div class="page-eyebrow">Menu organization</div><h1 class="page-title">Categories</h1><p class="page-subtitle">Create and manage the categories used to organize your restaurant menu.</p></div><span class="pill"><i class="fa-solid fa-layer-group me-2"></i>{{ $categories->count() }} Categories</span></div>
    <div class="row g-4">
        <div class="col-lg-4"><div class="surface"><div class="surface-header"><h2 class="surface-title"><i class="fa-solid fa-plus text-gold me-2"></i>Add Category</h2></div><div class="surface-body"><form method="POST" action="{{ route('categories.store') }}">@csrf<div class="mb-4"><label class="form-label">Category Name</label><input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="e.g. Pizza" required></div><button type="submit" class="btn btn-gold w-100"><i class="fa-solid fa-check me-2"></i>Save Category</button></form></div></div></div>
        <div class="col-lg-8"><div class="surface"><div class="surface-header d-flex justify-content-between align-items-center"><h2 class="surface-title">Categories List</h2><span class="pill">{{ $categories->count() }} total</span></div><div class="table-wrap"><table class="table"><thead><tr><th>Name</th><th>Meals</th><th class="text-end">Actions</th></tr></thead><tbody>
        @forelse($categories as $category)<tr><td class="fw-semibold">{{ $category->name }}</td><td><span class="pill">{{ $category->meals_count }}</span></td><td class="text-end"><div class="d-inline-flex gap-2"><a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-soft btn-sm">Edit</a><form action="{{ route('categories.destroy', $category) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger-soft btn-sm" onclick="return confirm('Delete this category?')">Delete</button></form></div></td></tr>
        @empty<tr><td colspan="3"><div class="empty-state"><div class="empty-icon"><i class="fa-solid fa-layer-group"></i></div><h3 class="h5 text-light">No categories yet</h3><p class="mb-0">Add your first category using the form.</p></div></td></tr>@endforelse
        </tbody></table></div></div></div>
    </div>
</div>
@endsection
