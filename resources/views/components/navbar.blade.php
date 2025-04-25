@props(['page'])
<link rel="stylesheet" href="{{ asset('css/navBar.css') }}">
<nav class="indigoTheme {{ in_array($page, ['authentication', 'messaging']) ? 'relative' : 'absolute' }}">
    <div id="left-section">
        <div id="logo-wrapper">
            <img src="{{ asset('assets/research-svgrepo-com.svg') }}" alt="EduPortal Logo">
            <h1 id="logo-title">EduPortal</h1>
        </div>
        @if ($page !== 'authentication' && session('UserType') && session('UserID'))
            <button id="accountManagement-button" class="indigoTheme shadow {{ $page === 'account' ? 'active' : '' }}"
                onclick="window.location.href = '{{ route('account.manage', ['userType' => strtolower(session('UserType')), 'userId' => session('UserID')]) }}';">
                Account Management
            </button>
            <button id="adminDashboard-button" class="indigoTheme shadow {{ $page === 'dashboard' ? 'active' : '' }}"
                onclick="window.location.href = '{{ route('admin.dashboard') }}';">
                Dashboard
            </button>
        @endif
    </div>
</nav>
