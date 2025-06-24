<div id="rtp_dialog_add" class="easyui-dialog" 
     data-options="closed:true, modal:true, border:'thin', buttons:'#rtp_dialog_add_buttons'"
     style="width:550px; padding:10px;">
    <form id="rtp_form_add" method="post" novalidate>
        <input type="hidden" name="id">
        <table cellpadding="5">
            <tr>
                <td>Date:</td>
                <td><input name="date" class="easyui-datebox" required="true" data-options="formatter:myformatter,parser:myparser" style="width:150px;"></td>
            </tr>
            <tr>
                <td>Item:</td>
                <td>
                    <input name="itemid" id="rtp_add_itemid" required="true" style="width:350px;">
                </td>
            </tr>
            <tr>
                <td>Qty:</td>
                <td><input name="qty" class="easyui-numberbox" required="true" data-options="min:0,precision:2" style="width:150px;"></td>
            </tr>
            <tr>
                <td>Unit (UoM):</td>
                <td>
                    <select name="unitid" id="rtp_add_unitid" class="easyui-combobox" required="true" style="width:150px;">
                       <!-- Opsi unit akan diisi oleh JavaScript -->
                    </select>
                </td>
            </tr>
             <tr>
                <td>Remark:</td>
                <td><input name="remark" class="easyui-textbox" style="width:350px; height:60px" multiline="true"></td>
            </tr>
        </table>
    </form>
</div>
<div id="rtp_dialog_add_buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="returnproduction_save()" style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#rtp_dialog_add').dialog('close')" style="width:90px">Cancel</a>
</div>
