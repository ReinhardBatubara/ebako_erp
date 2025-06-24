var url; // Variabel global untuk menyimpan URL save/update

// Fungsi untuk mencari data
function directlabour_search() {
    $('#directlabour_grid').datagrid('reload', {
        description: $('#dl_description_s').val()
    });
}

// Fungsi untuk membuka dialog tambah data
function directlabour_add() {
    $('#directlabour-form').dialog('open').dialog('setTitle', 'New Direct Labour');
    $('#directlabour-input').form('clear');
    url = base_url + 'directlabour/save';
}

// Fungsi untuk membuka dialog edit data
function directlabour_edit() {
    var row = $('#directlabour_grid').datagrid('getSelected');
    if (row) {
        $('#directlabour_dialog').dialog('open').dialog('setTitle', 'Edit Direct Labour');
        $('#directlabour_form').form('load', row);
        url = base_url + 'directlabour/update' + row.id;
    } else {
        $.messager.alert('Warning', 'Please select a row to edit.', 'warning');
    }
}

// Fungsi untuk menyimpan (baik data baru maupun update)
function directlabour_save() {
    $('#directlabour_form').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#directlabour_dialog').dialog('close');
                $('#directlabour_grid').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

// Fungsi untuk menghapus data
function directlabour_delete() {
    var row = $('#directlabour_grid').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Are you sure you want to delete this data?', function(r) {
            if (r) {
                $.post(base_url + 'directlabour/delete', { 
                    id: row.id 
                }, function(result) {
                    if (result.success) {
                        $('#directlabour_grid').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Warning', 'Please select a row to delete.', 'warning');
    }
}