$(document).ready(function () {
    
    
    $('#search_text').keyup(function () {
            var txt = $(this).val();
        console.log(txt);
            if (txt != '') {
                //$('#guestTable').html('');
                $.ajax({
                    url: "fetch_guest.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    success: function (data) {
                        $('#guestTable').html(data);
                    }
                });
            } else {
               $('#guestTable').html(data);
            }
        });
    // code to read selected table row cell data (values).
    $(".actionButton").on('click', function () {
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(0)").html();
        var col2 = currentRow.find("td:eq(1)").html();
        var col3 = currentRow.find("td:eq(4)").html();

        document.getElementById("firstname").value = col1;
        document.getElementById("lastname").value = col2;
        document.getElementById("idNo").value = col3;

        

    });
});
