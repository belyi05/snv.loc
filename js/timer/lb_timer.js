/**
 * timer counter
 *
 * @description
 *
 * Created by LastByte 
 * last modified 29/04/2012 - 21:06
 *
 * use jquery library (http://jquery.com/)
 */
 
/**
 * @description
 */
$(function() {
  lb_timer.init();
});
 
/** 
 * lb_timer Class
 *
 * @description
 */
function lb_timer(element) {
  lb_timer.count++; // update index for dynamic create
  var deadline = $(element).attr('lbt_deadline') || 0;
  var date = new Date(); // today
  var timezone = date.getTimezoneOffset(); // timezone
  var today = parseInt(date.getTime() / 1000) - (timezone * 60);
  
  this.element = $(element);
  this.deadline = parseInt(deadline);
  this.date = deadline - today;
  this.display = $(element).attr('lbt_display') || 'full';
  this.start(); // start timer
}

/**
 * item count
 *
 * @description
 */
lb_timer.count = 0;

/**
 * initialize
 *
 * @description
 */
lb_timer.init = function() {
  $('.lb-timer:not(.lb-timer-processed)').addClass('lb-timer-processed').each(function(n) {
    var base = 'lb-timer-' + (lb_timer.count+1);
    lb_timer[base] = new lb_timer(this);
  });  
}

/**
 * language
 *
 * @description
 */
lb_timer.parseTime = {
  /**
   * day
   *
   * @description
   */
  day: function(lng, n) {
    // specific language 
    var language = {
      'ru': {
        'def': 'дней',
        '2-4,22-24': 'дня',
        '1,21,31': 'день',
      },
    }
    var pattern = language[lng] || language['ru'];
    return lb_timer.parseTime.format(pattern, n);
  },
  /**
   * hour
   *
   * @description
   */
  hour: function(lng, n) {
    // specific language 
    var language = {
      'ru': {
        'def': 'часов',
        '1,21': 'час',
        '2-4,22-23': 'часа',
      },
    }
    var pattern = language[lng] || language['ru'];
    return lb_timer.parseTime.format(pattern, n);
  },
  /**
   * min
   *
   * @description
   */
  min: function(lng, n) {
    // specific language 
    var language = {
      'ru': {
        'def': 'минут',
        '2-4,22-24,32-34,42-44,52-54': 'минуты',
        '1,21,31,41,51': 'минута',
      },
    }
    var pattern = language[lng] || language['ru'];
    return lb_timer.parseTime.format(pattern, n);
  },
  /**
   * sec
   *
   * @description
   */
  sec: function(lng, n) {
    // specific language 
    var language = {
      'ru': {
        'def': 'секунд',
        '2-4,22-24,32-34,42-44,52-54': 'секунды',
        '1,21,31,41,51': 'секунда',
      },
    }
    var pattern = language[lng] || language['ru'];
    return lb_timer.parseTime.format(pattern, n);
  },
  /**
   * format
   *
   * @description
   */
  format: function(pattern, n) {
    var s = pattern['def'];
    
    // apply specification
    for (var key in pattern) {
      // ignore default pattern
      if (key !== 'def') {
        // get condition
        var condition = key.split(',');
        // apply condition
        for (var cid in condition) {
          // range condition
          if (condition[cid].indexOf('-') > -1) {
            var range = condition[cid].split('-');
            if (n >= parseInt(range[0]) && n <= parseInt(range[1])) {
              s = pattern[key];
            }
          }
          // compare condition
          else {
            if (parseInt(condition[cid]) == n) {
              s = pattern[key];
            }
          }
        }        
      }
    }
    
    return s;
  },
  /**
   * number
   *
   * @description
   */
  number: function(n) {
    if (n < 10) n = '0' + n;
    return n;
  }
}

/**
 * toString
 *
 * @description
 */
lb_timer.prototype.toString = function() {
  var dd = parseInt(this.date / 86400);
  var hh = parseInt((this.date - dd * 86400) / 3600);
  var mm = parseInt((this.date - dd * 86400 - hh * 3600) / 60);
  var ss = parseInt(this.date - dd * 86400 - hh * 3600 - mm * 60);
  
  return this.format(dd, hh, mm, ss);
}

/**
 * format
 *
 * @description
 */
lb_timer.prototype.format = function(dd, hh, mm, ss) {
  var s = '';
  var replace = {
    '!dd': dd,
    '!DD': lb_timer.parseTime.day('ru', dd),
    '!hh': lb_timer.parseTime.number(hh),
    '!HH': lb_timer.parseTime.hour('ru', hh),
    '!mm': lb_timer.parseTime.number(mm),
    '!MM': lb_timer.parseTime.min('ru', mm),
    '!ss': lb_timer.parseTime.number(ss),
    '!SS': lb_timer.parseTime.sec('ru', ss),
  }

  switch (this.display) {   
    case 'full':
      s = '!dd !DD !hh !HH !mm !MM !ss !SS';
      break;
      
    case 'short':
      s = '!dd !DD !hh:!mm:!ss';
      break;
      
    case 'tiny':
    default:
      s = '!hh:!mm:!ss';
      break;
  }
  
  for (var pattern in replace) {
    s = s.replace(pattern, replace[pattern]);
  }
  
  return s;
}

/** 
 * Start
 *
 * @description
 */
lb_timer.prototype.start = function() {
  var timer = this;
  timer.interval = timer.interval || setInterval(function() {
    timer.step(); // call step function
  }, 1000);
}

/**
 * Stop
 *
 * @description
 */
lb_timer.prototype.stop = function() {
  if (this.interval) {
    clearInterval(this.interval);
  }
}

/**
 * Reset
 *
 * @description
 */
lb_timer.prototype.reset = function() {
  this.date = this.deadline;
}

/**
 * step
 *
 * @description
 */
lb_timer.prototype.step = function() {
  // step
  if (this.date > 0) {
    this.date -= 1;
  }
  // stop timer
  else {
    this.date = 0;
    this.stop();
  }
  this.element.html(this.toString());
}