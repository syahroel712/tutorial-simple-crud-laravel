/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document).ready(function () {
    $(".example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('.example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    // Summernote
    $('.textarea').summernote({
        height: 200
    });
    $('.number').keyup(function (e) {
        this.value = this.value.replace(/[^0-9.]/g, '');
        this.value = this.value.replace(/(\..*)\./g, '$1');
    });
    $('.number2').keyup(function (e) {

        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function (index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $('.select2bs4tag').select2({
        theme: 'bootstrap4',
        tags: true,
    })
});
