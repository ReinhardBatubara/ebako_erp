<table class="tablesorter2" width="100%">
    <thead>
        <tr>
            <th width="1%">NO</th>
            <th>Description</th>
            <th width="20%">Unit</th>            
            <th width="30%">Price (Rp)</th>
            <th width="100">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($directlabor as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $no++; ?></td>
                <td><?php echo $result->description ?></td>
                <td align="center"><?php echo $result->unit ?></td>
                <td align="right">
                    <?php
                    if (in_array('view_price', $accessmenu)) {
                        echo number_format($result->price, 0, ',', '.');
                    } else {
                        echo "-";
                    }
                    ?>
                </td>
                <td align="center">
                    <?php
                    if (in_array('edit', $accessmenu)) {
                        echo "<a href='javascript:directlabour_edit($result->id)'><img src='images/edit.png' class='miniaction'/>&nbsp;Edit&nbsp;</a>";
                    }
                    if (in_array('delete', $accessmenu)) {
                        echo "<a href='javascript:directlabour_delete($result->id)'><img src='images/delete.png' class='miniaction'/>&nbsp;Delete</a>";
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <img src="images/first.png" onclick="directlabour_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="directlabour_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="directlabour_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="directlabour_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>
