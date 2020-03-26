<?php
require_once(__DIR__ . '/useapi.php');
run_cmd_exec("languages", $lang_list, $return_var)
?>
<h2>Submit</h2>
<form method="POST" action="./submit.php" class="ats-submit-form">
    <div>
        <input type="hidden" name="problemId" value="<?= $problem_id ?>"> </input>
        <textarea name="usercode" rows="5" maxlength="65536"></textarea>
    </div>
    <div>
        <select name="lang">
            <?php
            foreach ($lang_list as $lang) {
            ?>
                <option value="<?= $lang ?>"><?= $lang ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <input type="submit" value="Submit"></input>
</form>