$(document).ready(function() {
	document.title='Summary';
	$('#example').DataTable(
		{
			"dom": '<"container-fluid"<"row"<"col"<"buttons"B>><"col"f><"col"l>>>rt<"container-fluid"<"row"<"col"i><"col"p>>><"clear">',
			"paging": true,
			"pagingType": "simple",
			"responsive": true,
			"autoWidth": true,
			"buttons": [
					{
            extend: 'excelHtml5',
            text: 'Excel',
            customize: function( xlsx ) {
              var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
              source.setAttribute('name','New Name');
						}
					}
			] 
		}
	);
});