<div class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">GameDev</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-3">
          <a onclick="Game.FreeLook()" class="nav-link active"><i style="margin-right: 0.5rem;" class="far fa-hand-paper"></i>Browse map</a>
        </li>
        <li class="nav-item mb-5">
          <a href="#" onclick="Game.Start()" class="nav-link active"><i style="margin-right: 0.5rem;" class="far fa-hand-paper"></i>Roll a dice!</a>
        </li>
        <li class="nav-item" style="height:400px;flex-wrap: wrap;display: flex;align-content: center;justify-content: center;">
            <? // Modal: Land Info
            include_once "{$Root}/assets/components/dice.php"; ?>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
      </a>
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>
</div>