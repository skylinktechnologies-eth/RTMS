// Basic DataTable
$(function(){
	$('#basicExample').DataTable({
		'iDisplayLength': 10,
		"language": {
			"lengthMenu": "Display _MENU_ Records Per Page",
			"info": "Showing Page _PAGE_ of _PAGES_",
		}
	});
});



// FPrint/Copy/CSV
$(function(){
	$('#copy-print-csv').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5',
			'print'
		],
		'iDisplayLength': 10,
	});
});

$(function(){
    $('#copy-print-sales').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                title: 'Sales Report'
            },
            {
                extend: 'excelHtml5',
                title: 'Sales Report'
            },
            {
                extend: 'csvHtml5',
                title: 'Sales Report'
            },
            {
                extend: 'pdfHtml5',
                title: 'Sales Report',
                customize: function(doc) {
                    // Find the table element in the PDFMake definition
                    var table = doc.content[1].table;

                    // Center align content
                    table.widths = Array(table.body[0].length + 1).join('*').split('');
                    table.body.forEach(row => {
                        row.forEach(cell => {
                            cell.alignment = 'center';
                        });
                    });

                    // Increase font size
                    table.body[0].forEach(cell => {
                        cell.fontSize = 14;
                    });
                }
            },
            {
                extend: 'print',
                title: 'Sales Report'
            }
        ],
        iDisplayLength: 10,
        title: 'Sales Report', // Set the default DataTables title
    });
});

$(function(){
    $('#copy-print-purchase').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                title: 'Purchase Report'
            },
            {
                extend: 'excelHtml5',
                title: 'Purchase Report'
            },
            {
                extend: 'csvHtml5',
                title: 'Purchase Report'
            },
            {
                extend: 'pdfHtml5',
                title: 'Purchase Report',
                customize: function(doc) {
                    // Find the table element in the PDFMake definition
                    var table = doc.content[1].table;

                    // Center align content
                    table.widths = Array(table.body[0].length + 1).join('*').split('');
                    table.body.forEach(row => {
                        row.forEach(cell => {
                            cell.alignment = 'center';
                        });
                    });

                    // Increase font size
                    table.body[0].forEach(cell => {
                        cell.fontSize = 14;
                    });
                }
            },
            {
                extend: 'print',
                title: 'Purchase Report'
            }
        ],
        iDisplayLength: 10,
        title: 'Purchase Report', // Set the default DataTables title
    });
});
$(function(){
    $('#copy-print-inventory').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                title: 'Inventory Report'
            },
            {
                extend: 'excelHtml5',
                title: 'Inventory Report'
            },
            {
                extend: 'csvHtml5',
                title: 'Inventory Report'
            },
            {
                extend: 'pdfHtml5',
                title: 'Inventory Report',
                customize: function(doc) {
                    // Find the table element in the PDFMake definition
                    var table = doc.content[1].table;

                    // Center align content
                    table.widths = Array(table.body[0].length + 1).join('*').split('');
                    table.body.forEach(row => {
                        row.forEach(cell => {
                            cell.alignment = 'center';
                        });
                    });

                    // Increase font size
                    table.body[0].forEach(cell => {
                        cell.fontSize = 14;
                    });
                }
            },
            {
                extend: 'print',
                title: 'Inventory Report'
            }
        ],
        iDisplayLength: 10,
        title: 'Inventory Report', // Set the default DataTables title
    });
});


// Fixed Header
$(document).ready(function(){
	var table = $('#fixedHeader').DataTable({
		fixedHeader: true,
		'iDisplayLength': 10,
		"language": {
			"lengthMenu": "Display _MENU_ Records Per Page",
			"info": "Showing Page _PAGE_ of _PAGES_",
		}
	});
});


// Vertical Scroll
$(function(){
	$('#scrollVertical').DataTable({
		"scrollY": "207px",
		"scrollCollapse": true,
		"paging": false,
		"bInfo" : false,
	});
});



// Row Selection
$(function(){
	$('#rowSelection').DataTable({
		'iDisplayLength': 5,
		"language": {
			"lengthMenu": "Display _MENU_ Records Per Page",
			"info": "Showing Page _PAGE_ of _PAGES_",
		}
	});
	var table = $('#rowSelection').DataTable();

	$('#rowSelection tbody').on( 'click', 'tr', function () {
		$(this).toggleClass('selected');
	});

	$('#button').on('click', function () {
		alert( table.rows('.selected').data().length +' row(s) selected' );
	});
});



// Highlighting rows and columns
$(function(){
	$('#highlightRowColumn').DataTable({
		'iDisplayLength': 10,
		"language": {
			"lengthMenu": "Display _MENU_ Records Per Page",
		}
	});
	var table = $('#highlightRowColumn').DataTable();  
	$('#highlightRowColumn tbody').on('mouseenter', 'td', function (){
		var colIdx = table.cell(this).index().column;
		$(table.cells().nodes()).removeClass('highlight');
		$(table.column(colIdx).nodes()).addClass('highlight');
	});
});



// Using API in callbacks
$(function(){
	$('#apiCallbacks').DataTable({
		'iDisplayLength': 10,
		"language": {
			"lengthMenu": "Display _MENU_ Records Per Page",
		},
		"initComplete": function(){
			var api = this.api();
			api.$('td').on('click', function(){
			api.search(this.innerHTML).draw();
		});
		}
	});
});


// Hiding Search and Show entries
$(function(){
	$('#hideSearchExample').DataTable({
		'iDisplayLength': 10,
		"searching": true,
		"language": {
			"lengthMenu": "Display _MENU_ Records Per Page",
			"info": "Showing Page _PAGE_ of _PAGES_",
		}
	});
});
