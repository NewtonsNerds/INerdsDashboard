var TableAjax = function (settings) {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }

    var handleRecords = function (settings) {

        var grid = new Datatable();

        grid.init({
            src: $(settings.table),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
            	"dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r><'table-scrollable't><'row'<'col-md-8 col-sm-12'i><'col-md-4 col-sm-12'p>>", // datatable layout
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": settings.url, // ajax source
                },
				"columnDefs" : [ 
					{
						'orderable' : false,
						'searchable': false,
						"targets" : 'col-checkbox',
						"render" : function(data, type, full) {
							return '<input type="checkbox" name="id[]" value="'+ full.DT_RowId + '">';
						}
					},
					{
						'orderable' : false,
						'searchable': false,
						"targets" : 'col-project-listing-action',
						"render" : function(data, type, full) {
							html = '<a class="btn btn-sm btn-default" href="/project/' + full.DT_RowId + '/task">View Tasks</a>\
								<a class="btn btn-sm btn-default" href="/project/update/' + full.DT_RowId + '">Edit</a>';
							return html;
						}
					},
					{
						'orderable' : false,
						'searchable': false,
						"targets" : 'col-task-listing-action',
						"render" : function(data, type, full) {
							html = '<a class="btn btn-sm btn-default" href="/task/update/' + full.DT_RowId + '">Edit</a>';
							return html;
						}
					},
					{
						'orderable' : false,
						'searchable': false,
						"targets" : 'col-tag-listing-action',
						"render" : function(data, type, full) {
							html = '<a class="btn btn-sm btn-default" href="/tag/update/' + full.DT_RowId + '">Edit</a>';
							return html;
						}
					},
				],
                "order": [
                    [1, "desc"]
                ]// set first column as a default sort by asc
            }
        });
        
        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());console.log(action.val());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionName", "filterByStatus");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
        
        return grid;
    }

    return {

        //main function to initiate the module
        init: function (settings) {

            initPickers();
            grid = handleRecords(settings);
            return grid;
        }

    };

}();