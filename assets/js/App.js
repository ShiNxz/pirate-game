let playable = false; // make default on false
let freelook = false; // make default on false

let Player = {
  Init: function() {
    // initialize the player
    $('.player').html(`<img src="assets/img/game/pirate.png" class="player_img">`); // append the player image
    $('.player').css("left", Lands[1].pleft); // set the location of the player to the first island
    $('.player').css("top", Lands[1].ptop); // set the location of the player to the first island
  },
  Land: async function(land) {
    // land the user on every land before the selected land
    if(land == 1)
      return Player.Move(1);
    for (let steps = 2; steps < land+1; steps++) {
      Player.Move(steps);
      await wait(1100);
    }
    return;
  },
  Move: function(i) {
    // land the user on the selected land
    window.scroll(Lands[i].scroll_right, Lands[i].scroll_bottom); // change the window location so it will follow the player
    $('.player').css("left", Lands[i].pleft); // change the player div location
    $('.player').css("top", Lands[i].ptop); // change the player div location
  }
}

let Dice = {
  Roll: function() {
    // send server side function to get random number and give the player win/lose
    return new Promise(async resolve => 
    {
      $.ajax({
        type: "GET",
        url: 'assets/php/dice.php',
        dataType: 'json',
        success: async function(response) {
            dice.dataset.side = response.num;
            dice.classList.toggle("reRoll");
            await wait(1500);
            resolve(response); // return the selected number
        }
      });
    });
  }
}

// lands configuration
let Lands = {
  1: {
    left: 200, // the land left pixels
    top: 350, // the land top pixels
    pleft: 280, // the player left pixels on the land
    ptop: 130, // the player top pixels on the land
    scroll_right: 0, // how many pixels to scroll right when landing the player in this island
    scroll_bottom: 0,  // how many pixels to scroll down when landing the player in this island
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט", // the island description when clicking on an island
  },
  2: {
    left: 900,
    top: 120,
    pleft: 1040,
    ptop: 0,
    scroll_right: 100,
    scroll_bottom: 0,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט",
  },
  3: {
    left: 1745,
    top: 180,
    pleft: 1870,
    ptop: 120,
    scroll_right: 550,
    scroll_bottom: 50,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט",
  },
  4: {
    left: 880,
    top: 360,
    pleft: 1100,
    ptop: 540,
    scroll_right: 100,
    scroll_bottom: 200,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט",
  },
  5: {
    left: 170,
    top: 940,
    pleft: 280,
    ptop: 800,
    scroll_right: 0,
    scroll_bottom: 450,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט",
  },
  6: {
    left: 1660,
    top: 580,
    pleft: 1880,
    ptop: 740,
    scroll_right: 1200,
    scroll_bottom: 450,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט",
  },
}

let Game = {
  Init: function() {
    // initialize the game
    resetMap(); // reset the window location
    Player.Init(); // initialize the player
    let i = 1;
    // initialize the lands
    Object.values(Lands).forEach(Land => {
      $('.lands').append(`
      <div class="land" onclick="getLandInfo(${i})" id="land${i}">
        <img src="assets/img/game/lands/${i}.png" class="land_img" alt="land${i}">
      </div>
      `);
      $(`#land${i}`).css("left", Land.left); // set he land position
      $(`#land${i}`).css("top", Land.top); // set he land position
      i++;
    });
    playable = true; // after the init => make the game playable
  },
  Start: function() {
    // This is the main function, it will handle the player round to prevent user abuse
    if(!playable) return; // if the game isn't initialized
    playable = false; // change playable to false to prevent multiple games at the same time
    
    // send ajax request to check if the user isn't ip banned
    $.ajax({
      type: "GET",
      url: 'assets/php/checkuser.php',
      dataType: 'text',
      success: async function(text){
        console.log(text);
        if (text == 'verified'){
          // User validated -> Start
          let results = await Dice.Roll();
          await Player.Land(results.num);
          Game.Finish(results);
        } else {
          // User banned -> terminate
          alert('חלה שגיאה!');
        }
      },
      error: function() {
        alert('חלה שגיאה!');
      }
  });
  },
  New: function() {
    // reset the current game and start a new one
    $('#game-over').modal('hide'); // hide the game-over modal
    $('#dice').attr('data-side', 1); // reset the dice to 1
    resetMap(); // reset the window location
    ToggleMenu(true); // toggle the side menu on
    Player.Move(1); // reset the player location to land 1
    playable = true; // make the game playable again
  },
  Finish: function(results) {
    // show the player the game results after he rolled the dice
    $('#over-title').html(results.status.title);
    $('#over-desc').html(results.status.desc);
    $('#game-over').modal('show');
  },
  FreeLook: function() {
    // give the user an option to scroll and see the map
    if(!freelook) { // if the isn't user already in freelook mode =>
      if(!playable) return; // check if the user rolled the dice
      freelook = true; // set the freelook mode to true
      playable = false; // set the game mode to false => means the player cant roll the dice while free look mode
      resetMap(); // reset the window location
      ToggleMenu(false); // toggle the sidemenu for better view (optional)
      // alert the user that the mode is on ->
      tata.text('Browse Map', 'ניתן לגלול בחופשיות את המפה<br/>טיפ - ניתן ללחוץ על כל אי למידע נוסף', {
        position: 'tm',
        duration: 5000,
      });
      $('body').css('overflow', 'scroll'); // make it possible to scroll the page
      $('#browse_map').html('<i style="margin-right: 0.5rem;" class="far fa-hand-paper"></i> Cancel Browse Map'); // change the button text
      $('#browse_map').css('background-color', '#fd0d0d'); // make the button red
    } else { // if the player is already in freelook mode =>
      $('#browse_map').html('<i style="margin-right: 0.5rem;" class="far fa-hand-paper"></i> Browse Map'); // change the button text to the default
      $('#browse_map').css('background-color', '#0d6efd'); // change the button to the default color
      Game.New(); // reset the game
      freelook = false; // set the freelook mode to false
      tata.text('Browse Map', 'האפשרות בוטלה בהצלחה', { // alert the user
        position: 'tm',
        duration: 5000,
      });
      $('body').css('overflow', 'hidden'); // make it impossible to scroll the window
    }
  }
}

/**
 * pause the current function x miliseconds
 * 
 * @param {type} int Miliseconds.  
**/
function wait(time) {
  return new Promise(resolve => {
      setTimeout(() => {
          resolve();
      }, time);
  });
}

/**
 * get the selected land info as a modal
 * 
 * @param {type} int land id.  
**/
function getLandInfo(land) {
  $('h3#land-info').html(`${Lands[land].description}`);
  $('#land-info').modal('show');
}

/**
 * toggle on / off the sidemenu
 * 
 * @param {type} boolean true -> toggle on / false -> toggle off.  
**/
function ToggleMenu(i) {
  if(i) {
    // toggle on
    $('.sidebar').removeClass('untoggled');
    $('.sidebar-collapse').css('width', '0');
  } else {
    // toggle off
    $('.sidebar').addClass('untoggled');
    $('.sidebar-collapse').css('width', '3rem');
  }
}

/**
 * reset the window location to 0x,0y
**/
function resetMap() {
  window.scroll(0, 0); // Reset the screen to top left pose
}

/**
 * get the logged user stats
**/
function getStats() {
  // get the logged user stats (wins/loses) and show the stats modal
  $.ajax({
    type: "GET",
    url: 'assets/php/stats.php',
    dataType: 'json',
    success: function(response) {
      if(!response) return;
      $('#wins').html(response.won);
      $('#loses').html(response.lost);
      $('#stats-modal').modal('show');
    }
  });
}

/**
 * show a modal with the leaderboard sorted by wins
**/
function leaderboard() {
  $.ajax({
    type: "GET",
    url: 'assets/php/leaderboard.php',
    dataType: 'json',
    success: function(response) {
      console.log(response);
      if(!response) return;
      let obj = '';
      let i = 1;
      response.forEach(row => {
        obj += `
        <tr>
          <th scope="row">${i}</th>
          <td>${row.email}</td>
          <td>${row.wins}</td>
          <td>${row.loses}</td>
        </tr>`;
        i++;
      });
      
      $('.leaderboard').html(obj);
      $('#leaderboard').modal('show');
    }
  });
}

$(document).ready(function() {
  'use strict';

  // check if the user using mobile
  var isMobile = false; 
  if( /Android|webOS|iPhone|iPod|iPad|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $('html').addClass('touch');
      isMobile = true;
  }
  else {
      $('html').addClass('no-touch');
      isMobile = false;
      Game.Init();
  }

  // if the user using mobile then check if he using portrait or landscape mode
  if(isMobile) {
    if (window.matchMedia("(orientation: portrait)").matches) {
      alert('שגיאה! על מנת לשחק עליך להעביר את מכשיר הטלפון למצב landscape');
    }
    window.addEventListener("orientationchange", function(event) {
      if(event.target.screen.orientation.angle == 90 || event.target.screen.orientation.angle == 180) {
        Game.Init();
      }
    });
  }
});

/**
 * change the form input from password to text and the opposite
 * 
 * @param {type} forminput the password form input.  
**/
function ShowPassword(input){
  if ($(input)[0].type === "password") {
    $(input)[0].type = "text";
  } else {
    $(input)[0].type = "password";
  }
}
