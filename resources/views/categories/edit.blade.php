@extends('layouts.admin')
@section('title', 'Edit Category')
@section('content')
<div class="page-wrap"><div class="page-heading"><div><div class="page-eyebrow">Menu organization</div><h1 class="page-title">Edit Category</h1><p class="page-subtitle">Update the category name used across your menu.</p></div><a href="{{ route('categories.index') }}" class="btn btn-outline-soft"><i class="fa-solid fa-arrow-left me-2"></i>Back to Categories</a></div>
<div class="row justify-content-center"><div class="col-lg-6"><div class="surface"><div class="surface-header"><h2 class="surface-title">Category Details</h2></div><div class="surface-body"><form method="POST" action="{{ route('categories.update', $category) }}">@csrf @method('PUT')<div class="mb-4"><label class="form-label">Category Name</label><input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required></div><button class="btn btn-gold w-100">Save Changes</button></form></div></div></div></div></div>
@endsection
