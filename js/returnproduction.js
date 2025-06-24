var rtp_url; // Variabel global untuk menyimpan URL Add/Edit

// Fungsi Formatter untuk membuat tombol aksi di setiap baris Datagrid
function rtp_action_formatter(value, row, index) {
    var actions = '';
    actions += '<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="returnproduction_print(' + row.id + ')">Print</a> ';
    if (row.is_received !== true) { // Hanya tampilkan jika belum di-receive
        actions += '<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="returnproduction_receive(' + row.id + ')">Receive</a>';
    }
    return actions;
}

// Memuat ulang data di grid berdasarkan input pencarian
function returnproduction_search() {
    $('#rtp_grid').datagrid('reload', {
        returnproduction_no: $('#rtp_no_s').val(),
        start_date: $('#rtp_start_date_s').datebox('getValue'),
        end_date: $('#rtp_end_date_s').datebox('getValue'),
        item_description: $('#rtp_item_s').val()
    });
}

// Membuka dialog untuk menambah data baru
function returnproduction_add() {
    $('#rtp_dialog_add').dialog('open').dialog('setTitle', 'New Return Production');
    $('#rtp_form_add').form('clear');
    
    // Inisialisasi combogrid item
    $('#rtp_add_itemid').combogrid({
        panelWidth: 500,
        url: '<?php echo site_url("item/getfordialog"); ?>',
        idField: 'id',
        textField: 'description',
        mode: 'remote',
        fitColumns: true,
        columns: [[
            {field:'partnumber',title:'Part Number',width:30},
            {field:'description',title:'Description',width:50},
            {field:'unitcode',title:'UoM',width:20}
        ]],
        onSelect: function(index, row) {
            // Setelah item dipilih, isi dropdown unit
            $('#rtp_add_unitid').combobox('clear');
            $('#rtp_add_unitid').combobox('reload', '<?php echo site_url("item/get_available_units")?>/' + row.id);
        }
    });

    rtp_url = '<?php echo site_url('returnproduction/save') ?>';
}

// Membuka dialog untuk mengedit data yang dipilih
function returnproduction_edit() {
    var row = $('#rtp_grid').datagrid('getSelected');
    if (row) {
        $('#rtp_dialog_add').dialog('open').dialog('setTitle', 'Edit Return Production');
        $('#rtp_form_add').form('load', row);
        
        // Atur nilai dan teks untuk combogrid
        var itemGrid = $('#rtp_add_itemid').combogrid('grid');
        itemGrid.datagrid('loadData', [row]); // Tampilkan data saat ini
        $('#rtp_add_itemid').combogrid('setValue', row.itemid);
        
        rtp_url = '<?php echo site_url('returnproduction/update') ?>/' + row.id;
    } else {
        $.messager.alert('Warning', 'Please select a row to edit.', 'warning');
    }
}

// Menyimpan data (baru atau update)
function returnproduction_save() {
    $('#rtp_form_add').form('submit', {
        url: rtp_url,
        onSubmit: function() { return $(this).form('validate'); },
        success: function(content) {
            handleJsonResponse(content, '#rtp_dialog_add', '#rtp_grid');
        }
    });
}

// Menghapus data
function returnproduction_delete() {
    var row = $('#rtp_grid').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Are you sure you want to delete this data?', function(r) {
            if (r) {
                $.post('<?php echo site_url('returnproduction/delete') ?>', { id: row.id }, function(result) {
                    if (result.success) {
                        $('#rtp_grid').datagrid('reload');
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

// Membuka dialog receive
function returnproduction_receive(id) {
    var row = $('#rtp_grid').datagrid('getSelected');
    if (row) {
        $('#rtp_dialog_receive').dialog('open').dialog('setTitle', 'Receive Item for ' + row.returnproduction_no);
        $('#rtp_form_receive').form('clear');
        $('#rtp_form_receive').form('load', { returnproductionid: id });
        $('#rtp_receive_no').textbox('setValue', row.returnproduction_no);
    } else {
         $.messager.alert('Warning', 'Please select the correct row first.', 'warning');
    }
}

// Menyimpan data receive
function returnproduction_save_receive() {
    $('#rtp_form_receive').form('submit', {
        url: '<?php echo site_url('returnproduction/save_receive') ?>',
        onSubmit: function() { return $(this).form('validate'); },
        success: function(content) {
            handleJsonResponse(content, '#rtp_dialog_receive', '#rtp_grid');
        }
    });
}

// Membuka halaman print
function returnproduction_print(id) {
    window.open('<?php echo site_url('returnproduction/prints') ?>/' + id, '_blank');
}

// Fungsi helper untuk menangani respon JSON
function handleJsonResponse(content, dialogId, gridId) {
    try {
        var result = JSON.parse(content);
        if (result.success) {
            $(dialogId).dialog('close');
            $(gridId).datagrid('reload');
        } else {
            $.messager.alert('Error', result.msg, 'error');
        }
    } catch (e) {
        $.messager.alert('Response Error', 'An error occurred: ' + content, 'error');
    }
}
