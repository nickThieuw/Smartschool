$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
//                var dialog = $( "#dialog" ).dialog({
//                    autoOpen: false, 
//                    open: function( event, ui ) {
//                        $( "[for=title]" ).removeClass( "ui-state-error" );
//                        $( "[for=puntentotaal]" ).removeClass( "ui-state-error" );
//                        $( "#title" ).val("");
//                        $( "#puntentotaal").val("");
//                        $( "#test").prop('checked',false);
//                        $( "#vakantie").prop('checked',false);
//                        $( "#vak").hide();
//                        $( "#vaklabel").hide();
//                        $( "#info").removeAttr("disabled");
//                        $( "select#vak").attr("disabled",true);
//                        $( "#puntentotaal").hide();
//                        $( "#puntentotaallabel").hide();
//                        $( "input#puntentotaal").attr("disabled",true);
//                    },
//                    buttons: {
//                       OK: function() {
//                           var title = $( "#title" ).val();
//                           var start = new moment($( "#start" ).val());
//                           var end = new moment($( "#end").val());
//                           var info = $("#info").val();
//                           var test = $("#test").is(':checked');
//                           var vakantie = $("#vakantie").is(':checked');
//                          checkcontent( title,info,test,start,end, vakantie );
//                       }
//                    },
//                    width: 600,
//                    modal: true
//                 });

//              function checkcontent(title,info,test,start,end,vakantie){
//                  if ( title=="") {
//                          event.preventDefault();
//                          $( "[for=title]" ).addClass( "ui-state-error" );
//                       }else {
//                           $( "[for=title]" ).removeClass( "ui-state-error" );
//                            if (title) {
//                                start = start.format("YYYY-MM-DD");
//                                end = end.format("YYYY-MM-DD");
//                                if(test){
//                                    var puntentotaal = $("input#puntentotaal").val();
//                                    if(puntentotaal==""){
//                                        event.preventDefault();
//                                        $( "[for=puntentotaal]" ).addClass( "ui-state-error" );
//                                    }else{
//                                        $( "[for=title]" ).removeClass( "ui-state-error" );
//                                        var vak = $("select#vak").val();
//                                        
//                                        $.ajax({
//                                        url: 'http://localhost/smartschool/smartschool/toetsentoevoegen.php',
//                                        data: 'action=process'+'&testnaam='+ title+'&puntentotaal='+puntentotaal+'&testdatum='+ start +'&vak='+ vak ,
//                                        type: "POST",
//                                        success: function(json) {
//                                            calendar.fullCalendar('refetchEvents');    //bug opgelost view=OK
//                                           //alert('Input geslaagd!');
//                                        },
//                                           error: function(){
//                                               alert('error');
//                                           }                    
//                                        });
//                                        
//                                        $.ajax({
//                                        url: 'http://localhost/smartschool/smartschool/add_events.php',
//                                        data: 'title='+ title+'&info='+vak+'&start='+ start +'&end='+ end +'&toets=1&vakantie=0' ,
//                                        type: "POST",
//                                        success: function(json) {
//                                            calendar.fullCalendar('refetchEvents');    //bug opgelost view=OK
//                                           //alert('Input geslaagd!');
//                                        },
//                                           error: function(){
//                                               alert('error');
//                                           }                    
//                                        });
//                                    }
//                                    
//                                } else {
//                                    if(vakantie){
//                                      $.ajax({
//                                        url: 'http://localhost/smartschool/smartschool/add_events.php',
//                                        data: 'title='+ title+'&info='+info+'&start='+ start +'&end='+ end +'&toets=0&vakantie=1' ,
//                                        type: "POST",
//                                        success: function(json) {
//                                            calendar.fullCalendar('refetchEvents');    //bug opgelost view=OK
//                                           //alert('Input geslaagd!');
//                                        },
//                                           error: function(){
//                                               alert('error');
//                                           }                    
//                                        });  
//                                    } else {
//                                        $.ajax({
//                                        url: 'http://localhost/smartschool/smartschool/add_events.php',
//                                        data: 'title='+ title+'&info='+info+'&start='+ start +'&end='+ end +'&toets=0&vakantie=0' ,
//                                        type: "POST",
//                                        success: function(json) {
//                                            calendar.fullCalendar('refetchEvents');    //bug opgelost view=OK
//                                           //alert('Input geslaagd!');
//                                        },
//                                           error: function(){
//                                               alert('error');
//                                           }                    
//                                        });
//                                    }
//                                }
//                            }
//                            calendar.fullCalendar('unselect');
//                            $( "#dialog" ).dialog( "close" );
//                       }
//
//              };
                
		var calendar = $('#calendar').fullCalendar({
			editable: false,
                        theme: false,
                        selectable: false,
                        selectHelper: false,
                        eventSources: [
                            
                            {
                                url:"http://localhost/smartschool/smartschool/events.php",
                                className:"evenement",
                                textColor: 'white'
                            },
                            
                            {
                                url:"http://localhost/smartschool/smartschool/eventstoetsen.php",
                                className:"testevent",
                                textColor: 'white'
                            },
                            
                            {
                                url:"http://localhost/smartschool/smartschool/eventvakantie.php",
                                className:"vakantie fc-bgevent",
                                textColor: 'white',
                                backgroundColor: 'blue',
                                allDay: true,
                                rendering: 'background',
                                stick:true
                            }
                      
                        ],
//                        events: [
//                            {
//                                title: "test background",
//                                start: "2015-03-13",
//                                end: "2015-03-20",
//                            }  
//                        ],
                        //INPUT nieuwe event
                        
//                        select: function(start, end, allDay) {
//                            $("#start").val(start);
//                            $("#end").val(end);
//                            
//                         dialog.dialog( "open" );
//                        },
                        

                        //VERPLAATSEN
                        
//                        eventDrop: function(event, delta) {
//                        
//                        start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
//                        end = start;
//
//                         $.ajax({
//                         url: 'http://localhost/smartschool/smartschool/update_events.php',
//                         data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
//                         type: "POST",
//                         success: function(json) {
//                            //alert("Verplaatsen geslaagd!");
//                            //calendar.fullCalendar('refetchEvents'); 
//                         },
//                         error: function(){
//                         alert('error');
//                         }
//                         });
//                        },
                        
                        //RESIZEN-UPDATEN
                        
//                        eventResize: function(event) {
//                        
//                        start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
//                        end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
//                        
//                        $.ajax({
//                         url: 'http://localhost/smartschool/smartschool/update_events.php',
//                         data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
//                         type: "POST",
//                         success: function(json) {
//                             calendar.fullCalendar('refetchEvents'); 
//                             //alert("Update geslaagd");
//                         },
//                         
//                         error: function(){
//                         alert('error');
//                          }
//                         });
//
//                        },
                        
                        //DELETEN
                        
//                        eventClick: function(event) {
//
//                                if (confirm("Wil je dit event echt verwijderen?")) {
//                                        $.ajax({
//                                        url: 'http://localhost/smartschool/smartschool/delete_events.php',
//                                        data: 'id=' + event.id,
//                                        type: "POST",
//                                        success: function(json){
//                                                
//                                                calendar.fullCalendar('refetchEvents');     //view OK
//                                                //location.reload();                        //view NOK
//                                                //alert("Delete geslaagd!");
//                                            },
//                                             error: function(){
//                                                alert('error');
//                                                }
//                                        });
//                                }
//
//                        }
                        
                        
			
		}); 
	});
