<script>
    var buttonsTable = $("#dtabel").DataTable({
        lengthChange: false,
        scrollY: "390px",
        scrollCollapse: true,
        paging: false,
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        },
        buttons: ["excel", "pdf"]
    });
    buttonsTable.buttons().container().appendTo("#dtabel_wrapper .col-md-6:eq(0)");

</script>
