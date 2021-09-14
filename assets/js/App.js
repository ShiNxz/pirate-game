let playable = false;

let Player = {
  Init: function() {
    $('.player').html(`<img src="assets/img/game/pirate.png" class="player_img">`);
    $('.player').css("left", Lands[1].pleft);
    $('.player').css("top", Lands[1].ptop);
    playable = true;
  },
  Land: async function(land) {
    if(!playable) return;
    for (let steps = 2; steps < land+1; steps++) {
      Player.Move(steps);
      await wait(1100);
    }
  },
  Move: function(i) {
    if(!playable) return;
    window.scroll(Lands[i].scroll_right, Lands[i].scroll_bottom);
    $('.player').css("left", Lands[i].pleft);
    $('.player').css("top", Lands[i].ptop);
  }
}

let Cube = {
  Min: 1,
  Max: 6,
  Throw: function() {
    if(!playable) return;
    // rand between this.Min and this.Max
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
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט"
  },
  2: {
    left: 900,
    top: 120,
    pleft: 1040,
    ptop: 0,
    scroll_right: 100,
    scroll_bottom: 0,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט"
  },
  3: {
    left: 1745,
    top: 180,
    pleft: 1870,
    ptop: 120,
    scroll_right: 550,
    scroll_bottom: 50,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט"
  },
  4: {
    left: 880,
    top: 360,
    pleft: 1100,
    ptop: 540,
    scroll_right: 100,
    scroll_bottom: 200,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט"
  },
  5: {
    left: 170,
    top: 940,
    pleft: 280,
    ptop: 800,
    scroll_right: 0,
    scroll_bottom: 450,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט"
  },
  6: {
    left: 1660,
    top: 580,
    pleft: 1880,
    ptop: 740,
    scroll_right: 1200,
    scroll_bottom: 450,
    description: "לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית קולהע צופעט למרקוח איבן איף, ברומץ כלרשט מיחוצים. קלאצי סחטיר בלובק. תצטנפל בלינדו למרקל אס לכימפו, דול, צוט ומעיוט - לפתיעם ברשג - ולתיעם גדדיש. קוויז דומור ליאמום בלינך רוגצה. לפמעט"
  },
}

let Game = {
  Init: function() {
    window.scroll(0, 0);
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
  $('body').css('cursor', 'url(https://maps.gstatic.com/mapfiles/openhand_8_8.cur), default');
  //$('body').css('overflow', 'scroll');
  //var element = document.querySelector('.app')
  //panzoom(element);
  jQuery(".game").draggable({ 
    cursor: "move", 
    containment: "app",
    //stop: function() {
    //  if(jQuery(".game").position().left < 1)
    //      jQuery(".game").css("left", "720px");
    //}
});

}

$(document).ready(function() {

    'use strict';

    var isMobile = false; 
    if( /Android|webOS|iPhone|iPod|iPad|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('html').addClass('touch');
        isMobile = true;
    }
    else {
        $('html').addClass('no-touch');
        isMobile = false;
    }

    Game.Init();
});

function ShowPassword(input){
    console.log($(input)[0].type);
    if ($(input)[0].type === "password") {
      $(input)[0].type = "text";
    } else {
      $(input)[0].type = "password";
    }
}
