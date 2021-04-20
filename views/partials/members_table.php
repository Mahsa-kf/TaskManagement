<?php
/* This page is rendered when it call the function on list-member.php
 * function name: showUsersTable($users, $roles, $project_details, $actionLink, $buttonLabel,$buttonAction)
  *Objective: to display who are the member in this project (top) and
  * to display who are remaining that is not on the list and
  * remainders can be added with different role.
*/
  ?>

<?php if ($users) { ?>
    <table class="table table-hover">
        <thead class="thead-light ">
        <tr>
            <th scope="col">UserID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col"><label for="role">Role</label></th>
            <th scope="col">Action</th>

        </tr>
        </thead>
        <tbody>

        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['user_id'] ?></td>
                <td><?php echo $user['first_name'] ?></td>
                <td><?php echo $user['last_name'] ?></td>
                <td>
                    <div>
                    <select class="col-sm-9" name="role-<?= $user['user_id'] ?>" id="role-<?= $user['user_id'] ?>"
                            onchange="setSelectedValue<?= $user['user_id'] ?>()">
                        <option value="0" select="selected">Please select a role</option>
                        <?php foreach ($roles as $role) { ?>
                            <option value="<?= $role->id; ?>"><?= $role->description; ?></option>
                        <?php
                        if (isset($user['role_id']) && $role->id == $user['role_id']) {
                        ?>
                            <script type="text/javascript" >
                                document.getElementById("role-<?= $user['user_id'] ?>").selectedIndex = <?= $role->id ?>;
                            </script>
                            <?php
                        }
                            ?>
                        <?php } ?>
                        <script type="text/javascript">
                            function setSelectedValue<?= $user['user_id'] ?>() {
                                let addform = document.getElementById("AddMember-<?= $user['user_id'] ?>");
                                let deleteform = document.getElementById("DeleteMember-<?= $user['user_id'] ?>");
                                let roleSelect = document.getElementById("role-<?= $user['user_id'] ?>");
                                let selectedValue = roleSelect.value;

                                addform.roleid.value = selectedValue;
                                deleteform.roleid.value = selectedValue;
                            }
                        </script>
                    </select>
                    </div>
                    <span id="roleError" <?php if ( $buttonLabel == 'Add'){ ?>style="display: none; "<?php } ?>></span>
                </td>
                <td class=" ">
                    <div class="row text-center justify-content-center">
                        <div class="col-12 col-sm-6 col-md-6 ">
                            <form action="<?= $actionLink ?>" method="post" id="AddMember-<?= $user['user_id'] ?>">
                                <input type="hidden" name="projectId" value="<?= $project_details->id ?>"/>
                                <input type="hidden" name="userid" value="<?= $user['user_id']; ?>"/>
                                <input type="hidden" name="roleid" />
                                <input type="hidden" name="<?= $buttonLabel ?>" value="<?= $buttonLabel ?>"/>
                                <input type=<?= $buttonAction ?> value="<?= $buttonLabel ?>" class="button btn btn-info" onclick="addMember<?= $user['user_id'] ?>()"/>
                            </form>
                            <script type="text/javascript">
                                function addMember<?= $user['user_id'] ?>() {
                                    let form = document.getElementById("AddMember-<?= $user['user_id'] ?>");
                                    var errorMsg = document.querySelector('#roleError');
                                    if(form.roleid.value) {
                                        form.submit();
                                    } else {
                                        errorMsg.innerHTML = "please select role for this member";
                                    }

                                }
                            </script>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6"
                             <?php if ($buttonLabel == 'Add'){ ?>style="display: none; "<?php } ?>>
                            <form action="./delete-member.php" method="post" id="DeleteMember-<?= $user['user_id'] ?>">
                                <input type="hidden" name="projectId" value="<?= $project_details->id ?>"/>
                                <input type="hidden" name="userid" value="<?= $user['user_id']; ?>"/>
                                <input type="hidden" name="roleid" value="<?= $role->id ?>"/>
                                <input type="submit" class="button btn btn-danger" name="Delete"
                                       value="Delete"/>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>