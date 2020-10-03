function loadimage(id) {
    elements = document.querySelectorAll(".sid-" + id);
    elements.forEach((element) => {
        element.src = element.dataset.src;
    });
}

function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchinput");
    filter = input.value.toUpperCase();
    table = document.getElementById("ordertable");
    tr = table.querySelectorAll(".search");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        txtValue = tr[i].dataset.search;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}

//single item
function accept(id) {
    query(1, of + id);
}

function delivery(id) {
    query(2, of + id);
}

function pickup(id) {
    query(3, of + id);
}

function delivered(id) {
    query(4, of + id);
}

function reject(id) {
    query(5, of + id);
}

function returned(id) {
    query(6, of + id);
}

//allitem

function acceptall(id) {
    query(1, osf + id);
}

function deliveryall(id) {
    query(2, osf + id);
}

function pickupall(id) {
    query(3, osf + id);
}
function deliveredall(id) {
    query(4, osf + id);
}

function rejectall(id) {
    query(5, osf + id);
}

function returnedall(id) {
    query(6, osf + id);
}

//rotutes

function messages(status, id) {
    switch ((status)) {
        case 1:
            return "Order #" + id + " Has Been Accepted";
            break;
        case 2:
            return "Order #" + id + " Has Been Set On Delivery";
            break;
        case 3:
            return "Order #" + id + " Has Been Marked as pickup";
            break;
        case 4:
            return "Order #" + id + " Has Been Marked as Delivered";
            break;
        case 5:
            return "Order #" + id + " Has Been Rejected";
            break;
        case 6:
            return "Order #" + id + " Has Been Returned";
            break;
        default:
            "";
    }
}

function route(status) {
    return url.replace("_s_", status);
}

function query(status, formid) {
    var statusurl = route(status);
    console.log(status, formid, statusurl);
    $.post(statusurl, $("#" + formid).serialize(), function (data, stat, xhr) {
        console.log("status", stat);
        if (stat == "success") {
            data.id.forEach((_id) => {
                $.notify(
                    {
                        // options
                        message: messages(status, _id),
                    },
                    {
                        // settings
                        type: "success",
                    }
                );
                $("#" + o + _id).remove();
                $("#" + oi + _id).remove();
            });
            if (data.count == 0) {
                $("#" + r + data.sid).remove();
                $("#" + om + data.sid)
                    .modal("hide")
                    .destroy();
                // $('#'+om+data.sid).remove();
            }
        } else {
            $.notify(
                {
                    // options
                    message: "Some Problem occured",
                },
                {
                    // settings
                    type: "danger",
                }
            );
        }
        console.log(data);
    });
}
