@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">

<style>
	label {
		color: #ffffff !important;
	}
	.btn-succeess2{
		background: #287233 !important;
		color: #ffffff !important;
	}

	.btn-danger2{
		background: #960000 !important;
		color: #ffffff !important;
	}

	.btn-info2{
		background:#3A58A2 !important;
		color: #ffffff !important;
	}

	.table{
		background: #ffffff !important;
		color: #001C5F !important; 
	}

	table.dataTable thead tr, table.dataTable thead{
		background: #144E97 !important;
		color: #ffffff !important;
	}

	.pagination .page-item.active .page-link{
		background: #5CBDEB !important;
	}
</style>
@endpush

@push('page_vendor_js')
<script src="{{asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
@endpush


@push('custom_js')
<script>
	$(document).ready(function () {
		$('#mytable').DataTable({
			// dom: 'flBrtip',
			responsive: true,
			// buttons: [
			// 	'csv', 'pdf', 'print', 'excel'
			// ]
		});

		$('.dataTables_wrapper.dt-bootstrap4.no-footer').addClass('row justify-content-center')
		$('.dataTables_length').addClass('col-12 col-md-6 col-lg-3 mt-1 text-center')
		$('.dataTables_filter').addClass('col-12 col-md-6 col-lg-3 mt-1 text-center')
		$('.dt-buttons').addClass('col-12 col-md-12 col-lg-6 mt-1 text-center mb-2')
		$('.dataTables_info').addClass('col-12 col-md-6 mt-1')
		$('.dataTables_paginate').addClass('col-12 col-md-6 mt-1')
		$('.dt-buttons').removeClass('btn-group')
		$('#mytable').addClass('col-12 mt-4 border-0')
		$('.dt-buttons .btn').removeClass('btn-secondary')
		$('.dt-buttons .btn.buttons-csv').addClass('btn-succeess2')
		$('.dt-buttons .btn.buttons-pdf').addClass('btn-danger2')
		$('.dt-buttons .btn.buttons-print').addClass('btn-info2')
		$('.dt-buttons .btn.buttons-csv').html('<i class="feather icon-download"></i> CSV')
		$('.dt-buttons .btn.buttons-pdf').html('<i class="feather icon-download"></i> PDF')
		$('.dt-buttons .btn.buttons-print').html('<i class="feather icon-printer"></i> Print')
	});

</script>
@endpush