/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/* global url */

function costcenter_view() {
    $("#messagelistcontainer").html("<center><img style='padding-top:50px;' src='images/loading1.gif'/></center>");
    $('#messagelistcontainer').load(url + 'costcenter');
    my_y_position = 0;
}

function costcenter_search(offset) {
    $('#tbl_costcenter').data('selected-id', null);

    $("#costcenterdata").html("<center><img style='padding-top:50px;' src='images/loading1.gif'/></center>");
    $.post(url + 'costcenter/search/' + offset,
            $('#costcenter_search_form').serializeObject()
            , function (content) {
                $('#costcenterdata').empty();
                $('#costcenterdata').append(content);
                $('#bvan_tbl_costcenter_qzx').scrollTop(my_y_position);
                //console.log(content);
            });
}

// TAMBAHKAN FUNGSI BARU INI
// Gunakan event delegation '.on()' agar berfungsi bahkan setelah tabel di-refresh oleh AJAX
$(document).on('click', '#tbl_costcenter .data-row', function() {
    // Ambil id dari atribut data-id
    var id = $(this).data('id');

    // Simpan id yang terpilih di dalam elemen tabel itu sendiri
    $('#tbl_costcenter').data('selected-id', id);
    
    // Hapus class 'row-selected' dari semua baris lain
    $('#tbl_costcenter .data-row').removeClass('row-selected');
    
    // Tambahkan class 'row-selected' ke baris yang baru saja diklik
    $(this).addClass('row-selected');
});

function costcenter_add() {
    if ($('#costcenter_dialog')) {
        $('#bodydata').append("<div id='costcenter_dialog'></div>");
    }

    $("#costcenter_dialog").load(url + 'costcenter/add', function () {
        $(this).dialog({
            modal: true,
            width: 'auto',
            height: 'auto',
            title: 'ADD COST CENTER',
            position: {my: "center", at: "center", of: window},
            overlay: {
                opacity: 0.7,
                background: "black"
            }, buttons: {
                Save: function () {
                    if ($("#costcenter_add_form").valid()) {
                        $.post(url + 'costcenter/save', $("#costcenter_add_form").serializeObject(), function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $("#costcenter_dialog").dialog('close');
                                costcenter_search($('#offset').val());
                            } else {
                                display_error_message(result.msg);
                            }
                        });
                    }
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            },
            create: function () {
                $(this).css("maxHeight", 500);
                $(this).css("maxWidth", '100%');
            }
        });
    });
}


function costcenter_edit() {
    // Ambil ID yang tersimpan dari data tabel
    var id = $('#tbl_costcenter').data('selected-id');

    // Periksa apakah ada baris yang sudah dipilih
    if (!id) {
        alert('Silakan pilih baris data yang akan diubah terlebih dahulu.');
        return; // Hentikan fungsi jika tidak ada ID
    }

    if ($('#costcenter_dialog')) {
        $('#bodydata').append("<div id='costcenter_dialog'></div>");
    }

    $("#costcenter_dialog").load(url + 'costcenter/edit/' + id, function () {
        $(this).dialog({
            modal: true,
            width: 'auto',
            height: 'auto',
            title: 'EDIT COST CENTER',
            position: {my: "center", at: "center", of: window},
            overlay: {
                opacity: 0.7,
                background: "black"
            }, buttons: {
                Save: function () {
                    if ($("#costcenter_edit_form").valid()) {
                        $.post(url + 'costcenter/update', $("#costcenter_edit_form").serializeObject(), function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $("#costcenter_dialog").dialog('close');
                                costcenter_search($('#offset').val());
                            } else {
                                display_error_message(result.msg);
                            }
                        });
                    }
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            },
            create: function () {
                $(this).css("maxHeight", 500);
                $(this).css("maxWidth", '100%');
            }
        });
    });
}

function costcenter_set_member(id) {
    if ($('#costcenter_dialog')) {
        $('#bodydata').append("<div id='costcenter_dialog'></div>");
    }

    $("#costcenter_dialog").load(url + 'costcenter/set_member/' + id, function () {
        $(this).dialog({
            modal: true,
            width: 'auto',
            height: 'auto',
            title: 'SET MEMBER',
            position: {my: "center", at: "center", of: window},
            overlay: {
                opacity: 0.7,
                background: "black"
            }, buttons: {
                Save: function () {
                    if ($("#costcenter_set_member_form").valid()) {
                        $.post(url + 'costcenter/do_set_member', $("#costcenter_set_member_form").serializeObject(), function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $("#costcenter_dialog").dialog('close');
                                costcenter_search($('#offset').val());
                            } else {
                                display_error_message(result.msg);
                            }
                        });
                    }
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            },
            create: function () {
                $(this).css("maxHeight", 500);
                $(this).css("maxWidth", '100%');
            }
        });
    });
}

function costcenter_delete(id) {

    // Ambil ID yang tersimpan dari data tabel
    var id = $('#tbl_costcenter').data('selected-id');

    // Periksa apakah ada baris yang sudah dipilih
    if (!id) {
        alert('Silakan pilih baris data yang akan dihapus terlebih dahulu.');
        return; // Hentikan fungsi jika tidak ada ID
    }

    if ($('#costcenter_dialog')) {
        $('#bodydata').append("<div id='costcenter_dialog'></div>");
    }

    $("#costcenter_dialog").dialog({
        modal: true,
        width: 'auto',
        height: 'auto',
        position: {my: "center", at: "center", of: window},
        title: 'DELETE COST CENTER',
        overlay: {
            opacity: 0.7,
            background: "black"
        }, buttons: {
            Delete: function () {
                $.post(url + 'costcenter/delete/' + id, function (content) {
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $("#costcenter_dialog").dialog('close');
                        $('#tbl_costcenter').data('selected-id', null);
                        costcenter_search($('#offset').val());
                    } else {
                        display_error_message(result.msg);
                    }
                    costcenter_view();
                });
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        },
        create: function () {
            $(this).css("maxHeight", 500);
            $(this).css("maxWidth", '100%');
        }
    }).html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>\n\
                These items will be permanently deleted and cannot be recovered<br/> \
                Are you sure?</p>');
}

