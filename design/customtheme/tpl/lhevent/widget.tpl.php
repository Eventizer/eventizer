//http://jszen.blogspot.com/2007/03/how-to-build-simple-calendar-with.html
//https://www.eventbrite.com.au/t/event-calendar - kaip pvz 
//http://code.tutsplus.com/tutorials/how-to-build-a-beautiful-calendar-widget--net-12538 - kaip pvz

//https://github.com/jacwright/date.format
(function() {
    
    Date.shortMonths = ['<?=__t('event/widget','Jan')?>', '<?=__t('event/widget','Feb')?>', '<?=__t('event/widget','Mar')?>', '<?=__t('event/widget','Apr')?>', '<?=__t('event/widget','May')?>', '<?=__t('event/widget','Jun')?>', '<?=__t('event/widget','Jul')?>', '<?=__t('event/widget','Aug')?>', '<?=__t('event/widget','Sep')?>', '<?=__t('event/widget','Oct')?>', '<?=__t('event/widget','Nov')?>', '<?=__t('event/widget','Dec')?>'];
    Date.longMonths = ['<?=__t('event/widget','January')?>', '<?=__t('event/widget','February')?>', '<?=__t('event/widget','March')?>', '<?=__t('event/widget','April')?>','<?=__t('event/widget','May')?>', '<?=__t('event/widget','June')?>', '<?=__t('event/widget','July')?>', '<?=__t('event/widget','August')?>', '<?=__t('event/widget','September')?>','<?=__t('event/widget','October')?>', '<?=__t('event/widget','November')?>', '<?=__t('event/widget','December')?>'];
    Date.shortDays = ['<?=__t('event/widget','Sun')?>', '<?=__t('event/widget','Mon')?>', '<?=__t('event/widget','Tue')?>', '<?=__t('event/widget','Wed')?>', '<?=__t('event/widget','Thu')?>', '<?=__t('event/widget','Fri')?>', '<?=__t('event/widget','Sat')?>'];
    Date.longDays = ['<?=__t('event/widget','Sunday')?>', '<?=__t('event/widget','Monday')?>', '<?=__t('event/widget','Tuesday')?>', '<?=__t('event/widget','Wednesday')?>', '<?=__t('event/widget','Thursday')?>', '<?=__t('event/widget','Friday')?>', '<?=__t('event/widget','Saturday')?>'];
    
    // defining patterns
    var replaceChars = {
        // Day
        d: function() { return (this.getDate() < 10 ? '0' : '') + this.getDate(); },
        D: function() { return Date.shortDays[this.getDay()]; },
        j: function() { return this.getDate(); },
        l: function() { return Date.longDays[this.getDay()]; },
        N: function() { return (this.getDay() == 0 ? 7 : this.getDay()); },
        S: function() { return (this.getDate() % 10 == 1 && this.getDate() != 11 ? 'st' : (this.getDate() % 10 == 2 && this.getDate() != 12 ? 'nd' : (this.getDate() % 10 == 3 && this.getDate() != 13 ? 'rd' : 'th'))); },
        w: function() { return this.getDay(); },
        z: function() { var d = new Date(this.getFullYear(),0,1); return Math.ceil((this - d) / 86400000); }, // Fixed now
        // Week
        W: function() { 
            var target = new Date(this.valueOf());
            var dayNr = (this.getDay() + 6) % 7;
            target.setDate(target.getDate() - dayNr + 3);
            var firstThursday = target.valueOf();
            target.setMonth(0, 1);
            if (target.getDay() !== 4) {
                target.setMonth(0, 1 + ((4 - target.getDay()) + 7) % 7);
            }
            return 1 + Math.ceil((firstThursday - target) / 604800000);
        },
        // Month
        F: function() { return Date.longMonths[this.getMonth()]; },
        m: function() { return (this.getMonth() < 9 ? '0' : '') + (this.getMonth() + 1); },
        M: function() { return Date.shortMonths[this.getMonth()]; },
        n: function() { return this.getMonth() + 1; },
        t: function() { var d = new Date(); return new Date(d.getFullYear(), d.getMonth(), 0).getDate() }, // Fixed now, gets #days of date
        // Year
        L: function() { var year = this.getFullYear(); return (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)); },   // Fixed now
        o: function() { var d  = new Date(this.valueOf());  d.setDate(d.getDate() - ((this.getDay() + 6) % 7) + 3); return d.getFullYear();}, //Fixed now
        Y: function() { return this.getFullYear(); },
        y: function() { return ('' + this.getFullYear()).substr(2); },
        // Time
        a: function() { return this.getHours() < 12 ? 'am' : 'pm'; },
        A: function() { return this.getHours() < 12 ? 'AM' : 'PM'; },
        B: function() { return Math.floor((((this.getUTCHours() + 1) % 24) + this.getUTCMinutes() / 60 + this.getUTCSeconds() / 3600) * 1000 / 24); }, // Fixed now
        g: function() { return this.getHours() % 12 || 12; },
        G: function() { return this.getHours(); },
        h: function() { return ((this.getHours() % 12 || 12) < 10 ? '0' : '') + (this.getHours() % 12 || 12); },
        H: function() { return (this.getHours() < 10 ? '0' : '') + this.getHours(); },
        i: function() { return (this.getMinutes() < 10 ? '0' : '') + this.getMinutes(); },
        s: function() { return (this.getSeconds() < 10 ? '0' : '') + this.getSeconds(); },
        u: function() { var m = this.getMilliseconds(); return (m < 10 ? '00' : (m < 100 ?
    '0' : '')) + m; },
        // Timezone
        e: function() { return "Not Yet Supported"; },
        I: function() {
            var DST = null;
                for (var i = 0; i < 12; ++i) {
                        var d = new Date(this.getFullYear(), i, 1);
                        var offset = d.getTimezoneOffset();
    
                        if (DST === null) DST = offset;
                        else if (offset < DST) { DST = offset; break; }                     else if (offset > DST) break;
                }
                return (this.getTimezoneOffset() == DST) | 0;
            },
        O: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + '00'; },
        P: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + ':00'; }, // Fixed now
        T: function() { return this.toTimeString().replace(/^.+ \(?([^\)]+)\)?$/, '$1'); },
        Z: function() { return -this.getTimezoneOffset() * 60; },
        // Full Date/Time
        c: function() { return this.format("Y-m-d\\TH:i:sP"); }, // Fixed now
        r: function() { return this.toString(); },
        U: function() { return this.getTime() / 1000; }
    };

    // Simulates PHP's date function
    Date.prototype.format = function(format) {
        var date = this;
        return format.replace(/(\\?)(.)/g, function(_, esc, chr) {
            return (esc === '' && replaceChars[chr]) ? replaceChars[chr].call(date) : chr;
        });
    };

}).call(this);


var widget = {
	// these are labels for the days of the week
	cal_days_labels :  Date.shortDays,

	// these are human-readable month name labels, in order
	cal_months_labels : Date.longMonths,
	
	// these are the days of the week for each month, in order
	cal_days_in_month : [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
	
	//current date
	cal_current_date : new Date(),
	
	calendar : function(month, year) {
	  this.month = (isNaN(month) || month == null) ? widget.cal_current_date.getMonth() : month;
	  this.year  = (isNaN(year) || year == null) ? widget.cal_current_date.getFullYear() : year;
	  this.html = '';
	  return this;
	},
	//http://stackoverflow.com/questions/814564/inserting-html-elements-with-javascript
	appendHTML : function (htmlStr) {
        var frag = document.createDocumentFragment(),
            temp = document.createElement('div');
        temp.innerHTML = htmlStr;
        while (temp.firstChild) {
            frag.appendChild(temp.firstChild);
        };
        return frag;
    },
    
    createHtmlElement : function (name, el_class, id, css_style) {
    	var el = document.createElement(name);
    	
    	if (el_class) {
    		el.className = el_class;
    	}
    	
    	if (id) {
    		el.setAttribute('id',id) ;
    	}
    	 
    	if (typeof(css_style) == 'object') { 
    	for (var i in css_style) {
    	   el.style[i] = css_style[i];
    	 
    	}
	    	
			
		}
		
    	
    	return el;
    },
    
     addCss : function(css_content) {
        var head = document.getElementsByTagName('head')[0];
        var style = document.createElement('style');
        style.type = 'text/css';

        if(style.styleSheet) {
          style.styleSheet.cssText = css_content;
        } else {
          rules = document.createTextNode(css_content);
          style.appendChild(rules);
        };

        head.appendChild(style);
    },
	
	calendarWidget : function (Month, Year) {
	    var div_cal =  widget.createHtmlElement('div','calendar', 'calendar');
	    var w_h = widget.createHtmlElement('div','widget-heading','');
  		
	    w_h.innerHTML ='<h3 class="widget-title"><?=__t('event/widget','Events calendar')?></h3>';
	    div_cal.appendChild(w_h);
	    
		var cal = widget.calendar(Month, Year);
		var firstDay = new Date(cal.year, cal.month, 1);
		var startingDay = firstDay.getDay();
  
		// find number of days in month
  		var monthLength = widget.cal_days_in_month[cal.month];
  		
  		// compensate for leap year
		if (cal.month == 1) { // February only!
		   if((cal.year % 4 == 0 && cal.year % 100 != 0) || cal.year % 400 == 0){
		     monthLength = 29;
		   }
		}
		
		var thiscal = this;
	    
	   
  		var monthName = widget.cal_months_labels[cal.month];
  		var width = (typeof eventWidget != 'undefined' && typeof eventWidget.opt != 'undefined' && typeof eventWidget.opt.widget_width != 'undefined') ? parseInt(eventWidget.opt.widget_width)+'px' : '100%';
  		
  		var style = {'width':'100%'};
  		
  		var table = widget.createHtmlElement('table','calendar-table','',style);
  		
  		// do the header
  		var tr = widget.createHtmlElement('tr');
  		
  		var h_html = '<th><a href="#" class="prev" onclick="widget.changeMonth(false,'+thiscal.month+','+thiscal.year+')">&laquo;</a></th><th colspan="5">';
 		h_html +=  monthName + '&nbsp;' + thiscal.year;
  		h_html += '</th><th><a href="#" class="next" onclick="widget.changeMonth(true,'+thiscal.month+','+thiscal.year+')">&raquo;</a></th>';
  		
  		tr.innerHTML = h_html;
  		table.appendChild(tr);
  		
  		// do the weeks in header
  		var tr_w = widget.createHtmlElement('tr','calendar-weeks');
  		h_weeks = '';
		for(var i = 0; i <= 6; i++ ){
		    h_weeks += '<td class="calendar-header-day">';
		    h_weeks += widget.cal_days_labels[i];
		    h_weeks += '</td>';
		}
	
		tr_w.innerHTML = h_weeks;
  		table.appendChild(tr_w);
  		
  		
  		// fill in the days
		var day = 1;
		
		// this loop is for is weeks (rows)
		for (var i = 0; i < 9; i++) {
		
  			var tr_d = widget.createHtmlElement('tr','calendar-days');
  			
			// this loop is for weekdays (cells)
			for (var j = 0; j <= 6; j++) { 
				var td_d = widget.createHtmlElement('td','calendar-day');
				var day_html = '';
				
				if (day <= monthLength && (i > 0 || j >= startingDay)) {
					day_html += '<a href="#" onclick="widget.showEvents('+thiscal.year+','+thiscal.month+','+day+'); return false;">';
					day_html += day;
					day++;
					day_html += '</a>';
				}
				
				td_d.innerHTML = day_html;
				tr_d.appendChild(td_d);
			}

			// stop making rows if we've run out of days
			if (day > monthLength) {
				break;
			} else {
				table.appendChild(tr_d);
			}
		}
  		
  		//create container for events
  		var events = widget.createHtmlElement('div','events_container','events_container');
  		
  		div_cal.appendChild(table);
  		div_cal.appendChild(events);
  		
		return div_cal;
	},
	
	changeMonth : function (method, month, year) {
		if (method === false) {
			var month = month-1;
			
			if (month == -1) {
			 	month = 11;
			 	year = year -1;
			}
			
		} else {
			var month = month+1;
			if (month == 12) {
			 	month = 0;
			 	year = year + 1;
			}
		}
			
	   widget.showWidget(month, year);
	},
	
	showWidget : function (month, year) {
	   var dm = document.getElementById('widget_container');
	   var width = (typeof eventWidget != 'undefined' && typeof eventWidget.opt != 'undefined' && typeof eventWidget.opt.widget_width != 'undefined') ? parseInt(eventWidget.opt.widget_width)+'px' : '100%';
  	
       dm.style.width = width;
	   var ca = document.getElementById('calendar');
	   if (ca) {
	       dm.removeChild(dm.childNodes[0]);
	   }
			
		
	   	widget.addCss(<?php ($theme !== false && $theme->custom_container_css !== '') ? print '\''.str_replace(array("\n","\r"), '', $theme->custom_container_css).'\'' : '' ?>);
	   
		dm.appendChild(widget.calendarWidget(month, year));
	},
	
	showEvents :  function (year, month, day) {
	   var events = document.getElementById('events_container');
       events.className += ' show';
	   events.innerHTML = '<small><?=__t('event/widget','Loading...')?></small>';
       var date = year+'-'+(month+1)+'-'+day;
       var data = "date="+date;
       
      
	   var items =  widget.postJSON('/event/showeventajax',data);
	   events.innerHTML = '';
	   
	  if(items.length != 0){
    	   for (var index in items) {
    	       var html = '';
    	       var el =  widget.createHtmlElement('div','ev-events-item', '');
    	       html += '<h3>';
    	       html += items[index].title;
    	       html += '</h3>';
    	       html += '<div>';
    	       var from = new Date(items[index].start_date* 1000);
    	       var to = new Date(items[index].end_date* 1000);
    	       html += from.format('Y/m/d') +' - '+ to.format('Y/m/d');
    	       html += '</div>';
    	       html += '<hr />';
    	       el.innerHTML = html;
    	       events.appendChild(el);
    	   }
        } else {
           var el =  widget.createHtmlElement('div','ev-events-item', '');
           el.innerHTML = '<p>'+'<?=__t('event/widget','No events at this moment')?>'+'</p>';
    	   events.appendChild(el);
        }
	},
	
	postJSON : function(url, data, callback) {
        var request = new XMLHttpRequest();            
        request.open("POST", url, false);                    // POST to the specified url
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");        
        request.send(data);
        return JSON.parse(request.responseText);
        
    }
};

widget.showWidget();

