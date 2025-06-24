<div id="rtp_dialog_receive" class="easyui-dialog"
     data-options="closed:true, modal:true, border:'thin', buttons:'#rtp_dialog_receive_buttons'"
     style="width:450px; padding:10px;">
    <form id="rtp_form_receive" method="post" novalidate>
        <input type="hidden" name="returnproductionid">
        <table cellpadding="5">
            <tr>
                <td>RTP No:</td>
                <td><input id="rtp_receive_no" class="easyui-textbox" readonly></td>
            </tr>
            <tr>
                <td>Date:</td>
                <td><input name="date" class="easyui-datebox" required="true" data-options="formatter:myformatter,parser:myparser" style="width:150px;"></td>
            </tr>
            <tr>
                <td>Qty to Receive:</td>
                <td><input name="qty" class="easyui-numberbox" required="true" data-options="min:0,precision:2"></td>
            </tr>
            <tr>
                <td>Remark:</td>
                <td><input name="remark" class="easyui-textbox" style="width:250px; height:50px;" multiline="true"></td>
            </tr>
        </table>
    </form>
</div>
<div id="rtp_dialog_receive_buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="returnproduction_save_receive()" style="width:90px">Receive</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#rtp_dialog_receive').dialog('close')" style="width:90px">Cancel</a>
</div>
