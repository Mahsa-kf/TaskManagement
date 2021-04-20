// window.onload()
// {
//     document.getElementById("role-<?= $user['user_id'] ?>").selectedIndex = <?= $role->id ?>;
//
//
// function setSelectedValue<?= $user['user_id'] ?>()
//     {
//         let addform = document.getElementById("AddMember-<?= $user['user_id'] ?>");
//         let deleteform = document.getElementById("DeleteMember-<?= $user['user_id'] ?>");
//         let roleSelect = document.getElementById("role-<?= $user['user_id'] ?>");
//         let selectedValue = roleSelect.value;
//
//         //console.log(form);
//         //console.log(roleSelect);
//         //console.log(selectedValue);
//
//         addform.roleid.value = selectedValue;
//         deleteform.roleid.value = selectedValue;
//     }
// };