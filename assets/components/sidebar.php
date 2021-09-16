<div class="sidebar-collapse">
  <a onclick="ToggleMenu(true)" class="nav-link active"><i class="fas fa-arrow-left"></i></a>
</div>
<div class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">GameDev</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item mb-3">
        <a onclick="ToggleMenu(false)" class="nav-link active"><i style="margin-right: 0.5rem;" class="fas fa-arrow-right"></i>Close Menu</a>
      </li>
      <li class="nav-item mb-3">
        <a onclick="Game.FreeLook()" id="browse_map" class="nav-link active"><i style="margin-right: 0.5rem;" class="far fa-hand-paper"></i>Browse map</a>
      </li>
      <li class="nav-item mb-5">
        <a href="#" onclick="leaderboard()" class="nav-link active"><i style="margin-right: 0.5rem;" class="fas fa-dice"></i>Leaderboard</a>
      </li>
      <li class="nav-item mb-5">
        <a href="#" onclick="Game.Start()" class="nav-link active"><i style="margin-right: 0.5rem;" class="fas fa-dice"></i>Roll a dice!</a>
      </li>
      <li class="nav-item" style="height:400px;flex-wrap: wrap;display: flex;align-content: center;justify-content: center;">
          <? // Modal: Land Info
          include_once "{$Root}/assets/components/dice.php"; ?>
      </li>
  </ul>
  <hr>
  <? if($logged) { ?>
    <strong class="user-email"><? echo htmlspecialchars($User["Email"]); ?>
    <br>
      <a onclick="getStats()"> צפייה בנתונים •</a>
    <br>
      <a href="?logout"> התנתק • </a>
    </strong>
  <? } else { ?>
      <button class="btn btn" onclick="$('#register').modal('show');"> הרשמה •</button>
      <button class="btn btn-primary"  onclick="$('#login').modal('show');"> התחברות • </button>
  <? } ?>
</div>