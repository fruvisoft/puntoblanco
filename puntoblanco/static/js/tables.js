$(function() {
    
    $('#fruvi-tables-container').on('click', 'button', function() {
    
        var table_id = $(this).data('table-id');
        
        $.ajax({
            url: '/order/table/' + table_id,
            /*data: {
                table_id: table_number
            },*/
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#table-modal-title').text('Mesa ' + table_id)
                $('#fruvi-order-container').html(response);
                $('#table-modal').modal('show');
            },
            error: function(xhr, status) {
                alert('Error!');
            },
            complete: function (xhr, status) {
                console.log('ajax end');
            }
        });
    });
    
    $('#table-modal-ok-button').on('click', function() {
        console.log('#table-modal-ok-button clicked');
    });
    
    $.ajax({
        url: '/order/plates/',
        type: 'GET',
        dataType: 'html',
        success: function(response) {
            $('#fruvi-plates-container').html(response);
        },
        error: function(xhr, status) {
            alert('Error!');
        },
        complete: function (xhr, status) {
            console.log('ajax end');
        }
    });
    
    $('#fruvi-plates-container').on('click', 'button', function() {
    
        var plate_id = $(this).data('plate-id');
        foobar = '<tr>' + 
            '<td>' + '1' + '</td>' +
            '<td>' + 'plato con id ' + plate_id + '</td>' +
            '<td>' + '100.00' + '</td>';
        $('#fruvi-order > tbody:last').append(foobar);
        console.log('plato' + plate_id);
    });
});