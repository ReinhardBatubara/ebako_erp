<div id="directlabour_dialog" class="easyui-dialog"
     data-options="closed:true, modal:true, border:'thin', buttons:'#directlabour_dialog_buttons'"
     style="width:450px; padding:10px;">
    <form id="directlabour_form" method="post" novalidate>
        <input type="hidden" name="id" id="dl_id">
        <table cellpadding="5">
            <tr>
                <td align="right">Description:</td>
                <td><input name="description" class="easyui-textbox" required="true" style="width:280px;"></td>
            </tr>
            <tr>
                <td align="right">Unit:</td>
                <td>
                    <select name="unit" class="easyui-combobox" required="true" style="width:150px;">
                        <option value=""></option>
                        <?php
                        if (isset($unit)) {
                            foreach ($unit as $result) {
                                echo "<option value='" . $result->codes . "'>" . $result->codes . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">Price:</td>
                <td>
                    <input name="price" class="easyui-numberbox" required="true"
                           data-options="precision:0,groupSeparator:'.',decimalSeparator:','"
                           style="width:150px; text-align: right;">
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="directlabour_dialog_buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="directlabour_save()" style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#directlabour_dialog').dialog('close')" style="width:90px">Cancel</a>
</div>