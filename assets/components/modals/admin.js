let init = false;
/**
 * show a modal with the all players actions
**/
function adminMenu() {
    if(init) return $('#admin').modal('show');
    $.ajax({
        type: "GET",
        url: 'assets/php/admin.php',
        dataType: 'json',
        success: function(response) {
            if(!response) return;
            let obj = '';
            let i = 1;
            response.forEach(row => {
                obj += `
                <tr>
                    <th scope="row" style="width: 5%">${i}</th>
                    <td style="width: 20%;">${row.ip}</td>
                    <td>${row.action}</td>
                    <td style="width: 20%;">לפני ${row.timestamp}</td>
                </tr>`;
                i++;
            });
            $('.admin').html(obj);

            $(`#admin_table`).DataTable({
                aaSorting: [[ 0, "desc" ]],
                aLengthMenu:[5],
                oLanguage: {
            		oAria: {
            			sSortAscending: ": activate to sort column ascending",
            			sSortDescending: ": activate to sort column descending"
            		},
            		oPaginate: {
            			sFirst: "ראשון",
            			sLast: "אחרון",
            			sNext: "הבא",
            			sPrevious: "הקודם"
            		},
            		sEmptyTable: "לא נמצא מידע זמין",
            		sInfo: "מציג _START_ עד _END_ מתוך _TOTAL_ תוצאות",
            		sInfoEmpty: "מציג 0 עד 0 מתוך 0 תוצאות",
            		sInfoFiltered: "(filtered from _MAX_ total entries)",
            		sInfoPostFix: "",
            		sDecimal: "",
            		sThousands: ",",
            		sLengthMenu: "מציג _MENU_ תוצאות",
            		sLoadingRecords: "טוען...",
            		sProcessing: "טוען...",
            		sSearch: "חיפוש:",
            		sSearchPlaceholder: "",
            		sUrl: "",
            		sZeroRecords: "לא נמצאו תוצאות"
            	},
            });

            $('#admin').modal('show');
            init = true;
        }
    });
}