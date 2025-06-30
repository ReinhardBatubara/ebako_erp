<div class="easyui-layout" data-options="fit:true">

    <div data-options="region:'center', border:false">
        <div id="employee_toolbar" style="padding-bottom: 0;">
            <form id="employee_form_search2" style="margin-bottom: 0px">
                ID : <input type="text" size="12" class="easyui-validatebox" name="id" id="employee_id_s" onkeyup="if (event.keyCode == 13) { employee_search() }"/>      
                Name : <input type="text" size="12" class="easyui-validatebox" name="name" id="employee_name_s" onkeyup="if (event.keyCode == 13) { employee_search() }"/>     
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="employee_search()"></a>
                <?php
                if (in_array('add', $action)) {
                    ?>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="employee_add()"> Add</a>
                    <?php
                }if (in_array('edit', $action)) {
                    ?>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="employee_edit()"> Edit</a>
                    <?php
                }if (in_array('delete', $action)) {
                    ?>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="employee_delete()"> Delete</a>
                    <?php
                }
                ?>
            </form>
        </div>
        <table id="employee" 
               class="easyui-datagrid"
               data-options="
                    url:'<?php echo site_url('employee/get') ?>',
                    method:'post',
                    title:'Employee',
                    border:true,
                    singleSelect:true,
                    fit:true,
                    rownumbers:true,
                    fitColumns:false,
                    pagination:true,
                    striped:true,
                    idField:'id',
                    nowrap:true,
                    sortName:'id',
                    sortOrder:'desc',
                    toolbar:'#employee_toolbar'">
            <thead>
                <tr>              
                    <th data-options="field:'id',width:60,align:'center',sortable:true">ID</th>
                    <th data-options="field:'name',width:120,halign:'center',sortable:true">Name</th>
                    <th data-options="field:'startdate_f',width:80,align:'center',sortable:true">Join Date</th>
                    <th data-options="field:'area_id',width:80,align:'center',sortable:true">Area</th>
                    <th data-options="field:'department',width:120,halign:'center',sortable:true">Department</th>
                    <th data-options="field:'sub_department',width:120,halign:'center',sortable:true">Sub Department</th>
                    <th data-options="field:'position',width:100,halign:'center',sortable:true">Job Title</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function () {
                $('#employee').datagrid().datagrid('getPager').pagination({
                    pageList: [30, 50, 70, 90, 110]
                });
            });
        </script>
        <?php
        $this->load->view('employee/add');
        ?>
        </div>

    <div data-options="region:'south', split:true, border:true" style="height:45%">
        <div class="easyui-layout" data-options="fit:true">
            
            <div data-options="region:'west', title:'Department', split:true" style="width:50%">
                <div id="department_toolbar" style="padding-bottom: 0;">
                    <form id="department_form_search" style="margin-bottom: 0px">
                        Name : <input type="text" size="15" class="easyui-validatebox" name="name" onkeyup="if (event.keyCode == 13) { department_search() }"/>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="department_search()"></a>
                        <?php if (in_array('add', $action)) { ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="department_add()"> Add</a>
                        <?php } if (in_array('edit', $action)) { ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="department_edit()"> Edit</a>
                        <?php } if (in_array('delete', $action)) { ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="department_delete()"> Delete</a>
                        <?php } ?>
                    </form>
                </div>
                <table id="department" class="easyui-datagrid"
                       data-options="
                            url:'<?php echo site_url('department/get') ?>',
                            method:'post', border:false, singleSelect:true,
                            fit:true, rownumbers:true, pagination:true,
                            striped:true, idField:'id', toolbar:'#department_toolbar'">
                    <thead>
                        <tr>
                            <th data-options="field:'id',width:80,align:'center',sortable:true">ID</th>
                            <th data-options="field:'name',width:250,sortable:true">Department Name</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div data-options="region:'center', title:'Position'">
                 <div id="position_toolbar" style="padding-bottom: 0;">
                    <form id="position_form_search" style="margin-bottom: 0px">
                        Name : <input type="text" size="15" class="easyui-validatebox" name="name" onkeyup="if (event.keyCode == 13) { position_search() }"/>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="position_search()"></a>
                        <?php if (in_array('add', $action)) { ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="position_add()"> Add</a>
                        <?php } if (in_array('edit', $action)) { ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="position_edit()"> Edit</a>
                        <?php } if (in_array('delete', $action)) { ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="position_delete()"> Delete</a>
                        <?php } ?>
                    </form>
                </div>
                <table id="position" class="easyui-datagrid"
                       data-options="
                            url:'<?php echo site_url('position/get') ?>',
                            method:'post', border:false, singleSelect:true,
                            fit:true, rownumbers:true, pagination:true,
                            striped:true, idField:'id', toolbar:'#position_toolbar'">
                    <thead>
                        <tr>
                            <th data-options="field:'id',width:80,align:'center',sortable:true">ID</th>
                            <th data-options="field:'name',width:250,sortable:true">Position Name</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>