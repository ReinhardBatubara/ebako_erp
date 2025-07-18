<div id="stock_in_detail_toolbars" style="padding-bottom: 0;">
  Item Code : 
  <input type="text" 
         size="12" 
         name="itemcode"
         id="stock_in_detail_search_itemcode"
         class="easyui-validatebox" 
         onkeyup="if (event.keyCode === 13) {
               stock_in_detail_search();
             }"/>       
  Item Description : 
  <input type="text" 
         size="20" 
         name="itemdescription"
         id="stock_in_detail_search_itemdescription"
         class="easyui-validatebox" 
         onkeyup="if (event.keyCode === 13) {
               stock_in_detail_search();
             }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="stock_in_detail_search()"></a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="stock_in_detail_add()"> Add</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="stock_in_detail_edit()"> Edit</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="stock_in_detail_delete()"> Delete</a>
</div>
<table id="stock_in_detail"></table>
<script type="text/javascript">
  $(function() {
    $('#stock_in_detail').datagrid({
      url: '<?php echo site_url('goodsreceive/stock_in_detail_get') ?>',
      method: 'post',
      border: true,
      singleSelect: true,
      fit: true,
      rownumbers: true,
      fitColumns: false,
      pagination: true,
      striped: true,
      sortName: 'id',
      sortOrder: 'desc',
      toolbar: '#stock_in_detail_toolbars',
      columns: [[
          {field: 'sto_so_chck', checkbox: true},
          {field: 'itemcode', title: 'Item Code', width: 100, halign: 'center', sortable: "true"},
          {field: 'itemdescription', title: 'Item Description', width: 400, halign: 'center', sortable: "true"},
          {field: 'qty', title: 'Qty', width: 80, align: 'center', sortable: "true"},
          {field: 'unitcode', title: 'Unit', width: 80, align: 'center', sortable: "true"}
        ]]
    });
  });
</script>