<nav class="navbar navbar-expand-lg sticky-top bg-white b-3">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand me-2" href="https://www.youtube.com/watch?v=xvFZjo5PgG0">
      <img
        src="https://img.icons8.com/ios-filled/50/FFFFFF/filled-message.png"
        height="20"
        alt="Logo"
        loading="lazy"
        style="margin-top: -1px;"
      />
    </a>

    <!-- Toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-dangger" href="https://www.youtube.com/watch?v=xvFZjo5PgG0">Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @isset($dashboard) {{'text-danger fw-bold'}} @endisset" href="/posts">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @isset($home) {{'text-danger fw-bold'}} @endisset" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @isset($create) {{'text-danger fw-bold'}} @endisset" href="/posts/create">Create</a>
        </li>
        <li class="nav-item">
          <a class="btn bg-danger text-white" href="/logout">Logout</a>
        </li>
      </ul>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>