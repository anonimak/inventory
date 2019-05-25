$().ready(function(){
    // validasi
    
    // validasi login form
    $("#login_form").validate();
    // validasi list_part_form
    $("#list_part_form").validate();
    // validasi supplier_form
    $("#supplier_form").validate();
    // validasi part masuk
    $("#part_masuk_form").validate();


    // datatable
    $('.datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        responsive: true,
        language: {
        search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });
});
