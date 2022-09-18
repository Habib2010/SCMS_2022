/**
 * Nodes
 *
 * for NodesController
 */


/**
 * functions to execute when document is ready
 *
 * only for NodesController
 *
 * @return void
 */

$(document).ready(function($){

    var prid = 0;

    var taid = 0;

    var headRow = '';

    var subRow = '';

    var maximum;

    var pmaximum;

	

    //---------Head Row Add--------

    $("#headRowAdd").click(function() {

        prid = $('table tr.rowHead').size();
       
        pmaximum = null;

        $('table tr.rowHead').each(function() {

            var value = parseInt($(this).attr('pid'));
            
            pmaximum = (value > pmaximum) ? value : pmaximum;
            
        });

        if(pmaximum){ 

            prid = pmaximum + 1;

        }

        headRow = getTableRows(prid,0,true);

        $("#table1").append(headRow);

        textareaH();		

    });

	

    //---------Sub Row Add--------

    $('#table1').on('click','.apnd span',function(){

        prid = $(this).closest('tr').attr('pid'); 

        taid = $('table tr.pid_' + prid).size();

        maximum = null;

        $('table tr.pid_' + prid).each(function() {

            var value = parseInt($(this).attr('tid'));

            maximum = (value > maximum) ? value : maximum;

        });

        if(maximum){ 

            taid = maximum + 1;

        }

        //alert(taid);

		

        var subRow = getTableRows(prid,taid,false);

        $(subRow).insertAfter($(this).closest('tr'));

        $(this).closest('tr.rowHead').find('td.rowspan').attr('rowspan',function(i,rs){ 

            return parseInt(rs)+1;

        });

		

        textareaH();

    });

	

    //---------Sub Row Delete--------

    $('#table1').on('click','.minus span',function() {

        if( confirm('Are you sure?') ){

            //prevAll('tr:has(td[rowspan]):first')

            $(this).closest('tr').prevAll('tr.rowHead:first').find('td.rowspan').attr('rowspan',function(i,rs){

                return parseInt(rs)-1;

            });

            $(this).closest('tr').remove();

        }

    });

	

    //---------Sub Row Mouse--------

    $('#table1').on('mouseenter','tr td:not(.rowspan)',function(){

        $('.minus',this.parentNode).show();

    }).on('mouseleave','tr td:not(.rowspan)',function(){

        $('.minus',this.parentNode).hide();

    });

	

    //---------Head Row Delete--------

    $('#table1').on('click','.minusHead span',function() {

        if( confirm('Are you sure?') ){

            var rowsToDel = $(this).closest('td').attr('rowspan');

            rowsToDel--;

            $(this).closest('tr').nextAll(':lt('+rowsToDel+')').addBack().remove();

        }

    });

	

    //---------Head Row Mouse--------

    $('#table1').on('mouseenter','tr td.rowspan',function(){

        $('.minusHead',this).show();

    }).on('mouseleave','tr td.rowspan',function(){

        $('.minusHead',this).hide();

    });

    //----------

    textareaH();

});



//-----------------------for serial no----------------------



// $(document).on("click", ".append, .remove", function(){

//        

//       $("td.input").each(function(){                 

//           $(element).text(index + 1); 

//        });

//    });

//-------------- resize textarea --------------

function textareaH() {

    //  changes mouse cursor when highlighting loawer right of box

    jQuery("textarea").mousemove(function(e) {

        var myPos = jQuery(this).offset();

        myPos.bottom = jQuery(this).offset().top + jQuery(this).outerHeight();

        myPos.right = jQuery(this).offset().left + jQuery(this).outerWidth();

		

        if (myPos.bottom > e.pageY && e.pageY > myPos.bottom - 16 && myPos.right > e.pageX && e.pageX > myPos.right - 16) {

            jQuery(this).css({
                cursor: "nw-resize"
            });

        }

        else {

            jQuery(this).css({
                cursor: ""
            });

        }

    })

    //  the following simple make the textbox "Auto-Expand" as it is typed in

    .keyup(function(e) {

        //  this if statement checks to see if backspace or delete was pressed, if so, it resets the height of the box so it can be resized properly

        if (e.which == 8 || e.which == 46) {

            jQuery(this).height(parseFloat(jQuery(this).css("min-height")) != 0 ? parseFloat(jQuery(this).css("min-height")) : parseFloat(jQuery(this).css("font-size")));

        }

        //  the following will help the text expand as typing takes place

        while(jQuery(this).outerHeight() < this.scrollHeight + parseFloat(jQuery(this).css("borderTopWidth")) + parseFloat(jQuery(this).css("borderBottomWidth"))) {

            jQuery(this).height(jQuery(this).height()+1);

        };

    });

}

//for seat plan sms 
function room_sms(room, roo){
   
    $('#btn'+roo).hide();
    $('#ajximg'+roo).show();
   
    $.ajax({                   
        url: '/admissions/get_by_room/' + escape(roo),
        cache: false,
        type: 'GET',
        data: {
            data1: room
        },
        dataType: 'HTML',
        success: function (clients) {
            //var strs = clients.split("#");
            $('#roomBtn'+clients).html('SMS Sent Successfully.....');
        }
    });
    
    
    
    
}

