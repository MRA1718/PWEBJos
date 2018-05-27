<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="index.html">Hi   {{ Auth::user()->name }}</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="/home">
          <i class="fa fa-fw fa-address-book"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="charts.html">
          <i class="fa fa-fw fa-area-chart"></i>
          <span class="nav-link-text">Pengeluaran</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="/income">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Pemasukan</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-wrench"></i>
          <span class="nav-link-text">Components</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
          <li>
            <a href="navbar.html">Navbar</a>
          </li>
          <li>
            <a href="cards.html">Cards</a>
          </li>
        </ul>
      </li>


    </ul>

    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>Logout</a>

      </li>
    </ul>
  </div>
</nav>
