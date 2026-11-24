@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="page-wrap">
    <div class="page-heading">
        <div>
            <div class="page-eyebrow">Management overview</div>
            <h1 class="page-title">Welcome to Admin Dashboard</h1>
            <p class="page-subtitle">Your restaurant at a glance. Manage categories and meals from one place.</p>
        </div>
        <span class="pill"><i class="fa-solid fa-shield-halved me-2"></i>Administrator</span>
    </div>
    <div class="row g-4">
        <div class="col-md-4"><a href="{{ route('categories.index') }}" class="text-decoration-none"><div class="surface stat-card h-100"><div class="d-flex justify-content-between align-items-start"><div><div class="stat-label">Categories</div><div class="stat-value">{{ $categoriesCount }} Total</div><p class="muted small mt-2 mb-0">Manage menu categories</p></div><div class="stat-icon"><i class="fa-solid fa-layer-group"></i></div></div></div></a></div>
        <div class="col-md-4"><a href="{{ route('meals.index') }}" class="text-decoration-none"><div class="surface stat-card h-100"><div class="d-flex justify-content-between align-items-start"><div><div class="stat-label">Meals</div><div class="stat-value">{{ $mealsCount }} Available</div><p class="muted small mt-2 mb-0">Manage restaurant meals</p></div><div class="stat-icon"><i class="fa-solid fa-utensils"></i></div></div></div></a></div>
        <div class="col-md-4"><div class="surface stat-card h-100"><div class="d-flex justify-content-between align-items-start"><div><div class="stat-label">Admins</div><div class="stat-value">{{ $adminsCount }} Registered</div><p class="muted small mt-2 mb-0">Administrator accounts</p></div><div class="stat-icon"><i class="fa-solid fa-users-gear"></i></div></div></div></div>
    </div>
    <div class="surface mt-4 p-4 p-lg-5">
        <div class="page-eyebrow"><i class="fa-solid fa-bullhorn me-2"></i>Announcements</div>
        <div class="mt-3 d-grid gap-3">
            <div class="d-flex gap-3 align-items-center"><i class="fa-solid fa-circle-check text-gold"></i><span>System running smoothly</span></div>
            <div class="d-flex gap-3 align-items-center"><i class="fa-solid fa-circle-check text-gold"></i><span>Keep your categories organized</span></div>
            <div class="d-flex gap-3 align-items-center"><i class="fa-solid fa-circle-check text-gold"></i><span>Review meal details and images regularly</span></div>
        </div>
        <div class="mt-4"><a href="{{ route('home') }}" target="_blank" class="btn btn-gold"><i class="fa-solid fa-arrow-up-right-from-square me-2"></i>View Website</a></div>
    </div>
</div>
@endsection
