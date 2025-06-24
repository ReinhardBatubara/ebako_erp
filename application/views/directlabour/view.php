<div id="directlabour_toolbar" style="padding-bottom: 0;">
    Description :
    <input type="text" size="20" class="easyui-textbox" id="dl_description_s"
           onkeypress="if (event.keyCode === 13) directlabour_search()" />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="directlabour_search()"></a>
    
    <?php if (in_array('add', $accessmenu)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="directlabour_add()">Add</a>
    <?php } if (in_array('edit', $accessmenu)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="directlabour_edit()">Edit</a>
    <?php } if (in_array('delete', $accessmenu)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="directlabour_delete()">Delete</a>
    <?php } ?>
</div>

<table id="directlabour_grid" data-options="
       url:'<?php echo site_url('directlabour/get') ?>',
       method:'post',
       title:'Direct Labour',
       border:true,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#directlabour_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="description" width="60" sortable="true">Description</th>
            <th field="unit" width="15" align="center" sortable="true">Unit</th>
            <th field="price" width="25" align="right" sortable="true" formatter="formatRupiah">Price</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
    // Fungsi untuk memformat angka menjadi format Rupiah
    function formatRupiah(value, row) {
        if (value) {
            <?php if (in_array('view_price', $accessmenu)) { ?>
                return new Intl.NumberFormat('id-ID').format(value);
            <?php } else { ?>
                return "-";
            <?php } ?>
        }
        return value;
    }

    // Inisialisasi Datagrid saat halaman dimuat
    $(function() {
        $('#directlabour_grid').datagrid();
    });
</script>

<?php
// Memuat file dialog
$this->load->view('directlabour/add');
?>