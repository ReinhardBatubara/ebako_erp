<br/><br/><br/>
<center>
    <div class="panel" style="width: 400px;">
        <h4>Edit Direct Labour</h4><br/>
        <form action="<?php echo site_url('directlabour/update'); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $directlabour->id; ?>">
            <table>
                <tr>
                    <td align="right"><span class="labelelement">Description :</span></td>
                    <td><input type="text" name="description" size="30" value="<?php echo $directlabour->description; ?>" required /></td>
                </tr>
                <tr>
                    <td align="right"><span class="labelelement">Unit :</span></td>
                    <td>
                        <select name="unit" required>
                            <option value=""></option>
                            <?php foreach ($unit as $result) {
                                $selected = ($directlabour->unit == $result->codes) ? "selected" : "";
                                echo "<option value='" . $result->codes . "' $selected>" . $result->codes . "</option>";
                            } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><span class="labelelement">Price :</span></td>
                    <td><input type="number" name="price" value="<?php echo $directlabour->price; ?>" required /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><br/>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?php echo site_url('directlabour'); ?>" class="btn btn-default">Cancel</a>
                    </td>
                </tr>
            </table>
            <br/>
        </form>
    </div>
</center>