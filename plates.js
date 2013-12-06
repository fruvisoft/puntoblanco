$(function() {

    $('#second').hide();

    $('#to-main').click( function() {
    
        $('#second').hide();
        $('#main').show();
    });

    $('.btncamera').click( function() {
    
        var tr = $(this).parents('tr');
        var plate = tr.data('plate');
		
		console.log('plate:' + plate);
		console.log('button:' + 'camera');
        
        $.ajax({
            url: 'get_image.php',
            data: {
                plate: plate
            },
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#main').hide();
                $('#second').show();
                $('#image').html(response);
            },
            error: function(xhr, status) {
                alert('Error!');
            },
            complete: function (xhr, status) {
                //console.log('ajax end');
            }
        });
    });
    
    $('.btnadd').click( function() {
    
        var tr = $(this).parents('tr');
        var plate = tr.data('plate');
		
		console.log('plate:' + plate);
		console.log('button:' + 'add');
        
        $.ajax({
            url: 'add_plate.php',
            data: {
                plate: plate,
				value: '+1',
            },
            type: 'POST',
            dataType: 'html',
            success: function(response) {
                $('.cant', tr).text(response);
            },
            error: function(xhr, status) {
                alert('Error!');
            },
            complete: function (xhr, status) {
                //console.log('ajax end');
            }
        });
    });
    
    $('.btnsubtract').click( function() {
    
        var tr = $(this).parents('tr');
        var plate = tr.data('plate');
		
		console.log('plate:' + plate);
		console.log('button:' + 'subtract');
        
        $.ajax({
            url: 'add_plate.php',
            data: {
                plate: plate,
				value: '-1',
            },
            type: 'POST',
            dataType: 'html',
            success: function(response) {
                $('.cant', tr).text(response);
            },
            error: function(xhr, status) {
                alert('Error!');
            },
            complete: function (xhr, status) {
                //console.log('ajax end');
            }
        });
    });

});