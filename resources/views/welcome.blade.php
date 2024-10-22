@if(session('role_id') == 1)
    <h1>Hello SuperAdmin</h1>
    <p>{{ session('user_name') }}, you have logged in.</p>

@elseif(session('role_id') == 2)
    <h1>Hello Vendor</h1>
    <p>{{ session('user_name') }}, you have logged in.</p>

@elseif(session('role_id') == 3)
    <h1>Hello User</h1>
    <p>{{ session('user_name') }}, you have logged in.</p>

@endif


