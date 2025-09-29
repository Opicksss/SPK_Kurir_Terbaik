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
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(.no-export)' 
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            }
        ]
    });
    buttonsTable.buttons().container().appendTo("#dtabel_wrapper .col-md-6:eq(0)");
</script>

<script>
    @if (session('success'))
        toastr["success"]("{{ session('success') }}", "Success");
    @endif

    @if (session('error'))
        toastr["error"]("{{ session('error') }}", "Error");
    @endif

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

<script>

    $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
</script>
