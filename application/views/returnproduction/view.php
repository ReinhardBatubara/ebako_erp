<div id="rtp_toolbar" style="padding:5px;">
    <form id="rtp_search_form" onsubmit="returnproduction_search();return false;">
        <input id="rtp_no_s" class="easyui-textbox" style="width:120px;" prompt="RTP No...">
        <input id="rtp_start_date_s" class="easyui-datebox" style="width:120px;" prompt="Start Date" data-options="formatter:myformatter,parser:myparser">
        <input id="rtp_end_date_s" class="easyui-datebox" style="width:120px;" prompt="End Date" data-options="formatter:myformatter,parser:myparser">
        <input id="rtp_item_s" class="easyui-textbox" style="width:200px;" prompt="Item Code / Desc...">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="returnproduction_search()">Search</a>
        <span class="toolbar-separator" style="float:none;"></span>
        
        <?php if (in_array('add', $accessmenu)) : ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="returnproduction_add()">Add</a>
        <?php endif; if (in_array('edit', $accessmenu)) : ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="returnproduction_edit()">Edit</a>
        <?php endif; if (in_array('delete', $accessmenu)) : ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="returnproduction_delete()">Delete</a>
        <?php endif; ?>
    </form>
</div>

<table id="rtp_grid" data-options="
       url: '<?php echo site_url('returnproduction/get') ?>',
       method: 'post', title: 'Return Production', border: true,
       singleSelect: true, fit: true, rownumbers: true,
       pagination: true, pageSize: 50, striped: true,
       sortName: 'id', sortOrder: 'desc', toolbar: '#rtp_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="returnproduction_no" width="12" sortable="true">RTP No</th>
            <th field="date" width="10" sortable="true">Date</th>
            <th field="name_return_by" width="15" sortable="true">Returned By</th>
            <th field="item_code" width="15" sortable="true">Item Code</th>
            <th field="item_description" width="25" sortable="true">Item Description</th>
            <th field="qty" width="5" align="center">Qty</th>
            <th field="unit_code" width="5" align="center">UoM</th>
            <th field="action" width="13" align="center" formatter="rtp_action_formatter">Action</th>
        </tr>
    </thead>
</table>

<script type="text/javascript" src="<?php echo base_url("js/returnproduction.js") ?>"></script>
<script>
    function myformatter(date){
        if (!date) return '';
        var y = date.getFullYear(); var m = date.getMonth()+1; var d = date.getDate();
        return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
    }
    function myparser(s){
        if (!s) return new Date();
        var ss = (s.split('-'));
        var y = parseInt(ss[0],10); var m = parseInt(ss[1],10); var d = parseInt(ss[2],10);
        return (!isNaN(y) && !isNaN(m) && !isNaN(d)) ? new Date(y,m-1,d) : new Date();
    }
    $(function(){ $('#rtp_grid').datagrid(); });
</script>

<?php
// $this->load->view('returnproduction/add');
// $this->load->view('returnproduction/receive');
?>
