<br/><br/><br/>
<center>
    <div class="panel" style="width: 400px;">
        <h4>Add Direct Labour</h4><br/>
        <form action="<?php echo site_url('directlabour/save'); ?>" method="post">
            <table>
                <tr>
                    <td align="right"><span class="labelelement">Description :</span></td>
                    <td><input type="text" name="description" size="30" required /></td> 
                </tr>
                <tr>
                    <td align="right"><span class="labelelement">Unit :</span></td>
                    <td>
                        <select name="unit" required>
                            <option value=""></option>
                            <?php foreach ($unit as $result) {
                                echo "<option value='" . $result->codes . "'>" . $result->codes . "</option>";
                            } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><span class="labelelement">Price :</span></td>
                    <td><input type="number" name="price" value="0" required /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><br/>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?php echo site_url('directlabour'); ?>" class="btn btn-default">Cancel</a>
                    </td>
                </tr>
            </table>
            <br/>
        </form>
    </div>
</center>