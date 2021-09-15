let playable = false;
let freelook = false;

let Player = {
  Init: function() {
    $('.player').html(`<img src="assets/img/game/pirate.png" class="player_img">`);
    $('.player').css("left", Lands[1].pleft);
    $('.player').css("top", Lands[1].ptop);
    playable = true;
    resetMap();
  },
  Land: async function(land) {
    if(land == 1)
      return Player.Move(1);
    for (let steps = 2; steps < land+1; steps++) {
      Player.Move(steps);
      await wait(1100);
    }
    return;
  },
  Move: function(i) {
    window.scroll(Lands[i].scroll_right, Lands[i].scroll_bottom);
    $('.player').css("left", Lands[i].pleft);
    $('.player').css("top", Lands[i].ptop);
  }
}

let Dice = {
  Roll: function() {
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
            resolve(response);
        }
      });
    });
  }
}

let Lands = {
  1: {
    left: 200,
    top: 350,
    pleft: 280,
    ptop: 130,
    scroll_right: 0,
    scroll_bottom: 0,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט",
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
    resetMap();
    Player.Init();
    let i = 1;
    Object.values(Lands).forEach(Land => {
      $('.lands').append(`
      <div class="land" onclick="getLandInfo(${i})" id="land${i}">
        <img src="assets/img/game/lands/${i}.png" class="land_img" alt="land${i}">
      </div>
      `);
      $(`#land${i}`).css("left", Land.left);
      $(`#land${i}`).css("top", Land.top);
      i++;
    });
  },
  Start: function() {
    if(!playable) return;
    playable = false;
    // This is the main function, it will handle the player round to prevent the user abuse
    // First we will check if the user ip banned
    $.ajax({
      type: "GET",
      url: 'assets/php/checkuser.php',
      dataType: 'text',
      success: async function(text){
        if (text == "true"){
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
    $('#game-over').modal('hide');
    $('#dice').attr('data-side', 1);
    resetMap();
    Player.Move(1);
    playable = true;
  },
  Finish: function(results) {
    $('#over-title').html(results.status.title);
    $('#over-desc').html(results.status.desc);
    $('#game-over').modal('show');
  },
  FreeLook: function() {
    if(!freelook) {
      if(!playable) return;
      freelook = true;
      playable = false;
      resetMap();
      tata.text('Browse Map', 'ניתן לגלול בחופשיות את המפה<br/>טיפ - ניתן ללחוץ על כל אי למידע נוסף', {
        position: 'tm',
        duration: 5000,
      });
      $('body').css('overflow', 'scroll');
    } else {
      Game.New();
      freelook = false;
      tata.text('Browse Map', 'האפשרות בוטלה בהצלחה', {
        position: 'tm',
        duration: 5000,
      });
      $('body').css('overflow', 'hidden');
    }
  }
}

function wait(time) {
  return new Promise(resolve => {
      setTimeout(() => {
          resolve();
      }, time);
  });
}

function getLandInfo(land) {
  $('h3#land-info').html(`${Lands[land].description}`);
  $('#land-info').modal('show');
}

function ShowMap() {
  // https://api.jqueryui.com/draggable/
  jQuery(".game").draggable({ 
    cursor: "move", 
    //containment: "parent",
    //appendTo: "body"
  });
}

function resetMap() {
  window.scroll(0, 0); // Reset the screen to top left pose
}

$(document).ready(function() {
  'use strict';

  screen.orientation.lock('landscape');


  var isMobile = false; 
  if( /Android|webOS|iPhone|iPod|iPad|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $('html').addClass('touch');
      isMobile = true;
  }
  else {
      $('html').addClass('no-touch');
      isMobile = false;
  }
  resetMap();

  $('body').css('height', window.innerHeight);
  $('body').css('width', window.innerWidth);
});

function ShowPassword(input){
  if ($(input)[0].type === "password") {
    $(input)[0].type = "text";
  } else {
    $(input)[0].type = "password";
  }
}
