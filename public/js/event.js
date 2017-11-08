var verbose = true;
var first = true;
var pendingRequest = false;

function htmlrequest(requesttype, url, data, onSucces, identifier) {
    $.ajax({
        type: requesttype,
        url: url,
        data: data,
        success: function (json) {
            onSucces(json, identifier);
        },
        error: function () {
            document.getElementById(identifier).innerHTML = "Er liep iets fout bij het ophalen van deze data.";
        }
    });
}

function SortById(item1, item2) {
    var id1 = item1.id;
    var id2 = item2.id;
    return ((id1 < id2) ? -1 : ((id1 > id2) ? 1 : 0));
}

function makemsgbox(id, source, message, created) {
    return '<div id="msgid-' + id + '" class="card w-100"><div class="card-header">' + source + '</div><div class="card-body">' + message + '</div></div>';
}

function publishmsg(json, identifier) {
    if (!pendingRequest) {
        pendingRequest = true;
        try {
            json = JSON.parse(json);
        } catch (Exception) {
        }
        if (json.length > 0) {
            $('#lastmsgid').text(json[0].id);
            if (first) {
                $(identifier).html("");
            }
            json.sort(SortById);
            $.each(json, function (i, item) {
                $html = $(makemsgbox(item.id, item.source, item.content, item.created_at));
                $(identifier).prepend($html);
                if (!first) {
                    $html.hide().slideDown(1000);
                }
            });
            if (first) {
                first = false;
            }
            if (verbose) {
                console.log(json.length + " new message(s) added.")
            }
        } else {
            if (verbose) {
                console.log("No messages added.");
            }
        }
        pendingRequest = false;
    } else {
        if (verbose) {
            console.log("On interval, there was still a request pending.")
        }
    }
}

$(document).ready(function () {
    if (verbose) {
        console.log("ready!");
    }

    if ($("#eventid") != null && $("#eventid").text() != "") {
        htmlrequest("GET", "/api/texts/" + $("#eventid").text(), {}, publishmsg, "#msg-container");
    } else {
        if (verbose) {
            console.log("eventid was not provided.")
        }
    }

    setInterval(function () {
        if ($("#eventid") != null && $("#eventid").text() != "" && $("#lastmsgid") != null && $("#lastmsgid").text() != "") {
            htmlrequest("POST", "/api/texts/" + $("#eventid").text() + "/" + $('#lastmsgid').text(), {}, publishmsg, "#msg-container");
        } else {
            if (verbose) {
                console.log("eventid and/or lastmsgid were not provided.")
            }
        }
    }, 5000);
});