(function() {
    'use strict';
    window.addEventListener('load', function() {
      var progressItems = document.getElementsByClassName('progress-bar');
      this.console.log("progressItems: " + progressItems.length);
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('TaskForm');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          const Http = new XMLHttpRequest();
          const url='http://localhost/taskboard/header/users.php';
          Http.open("POST", url);
          Http.send();
          var skillLevelEnough = false;
          Http.onreadystatechange = (e) => {
            if(Http.readyState === 4 && Http.status === 200) {
              var users = JSON.parse(Http.responseText);
              for (var user of users) {
                var uiUser = document.getElementById("add_task_user");
                if (uiUser.value === (user.first_name + " " + user.last_name)) {
                  var skill = document.getElementById("add_task_skill");
                  var skill_level = document.getElementById("add_task_skill_level");
                  if (skill.value === user.skill &&
                     (skill_level.value.localeCompare(user.level) === -1 || skill_level.value.localeCompare(user.level) === 0)) {
                       skillLevelEnough = true;
                       document.getElementById("add_task_error").innerHTML = "";
                  } else {
                    // Skill & level not enough
                    document.getElementById("add_task_error").innerHTML = "User not matched for the task. The skill and/or skill level is different than that required by the task!";
                    skillLevelEnough = false;
                  }
                }
              }
            }
          }

          if (form.checkValidity() === false || skillLevelEnough === true) {
            console.log('disable');
            event.preventDefault();
            event.stopPropagation();
          } else {
            window.top.location.replace('http://localhost/taskboard/');
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  $('#EditTask').on('shown.bs.modal', function (e) {
    //get data-id attribute of the clicked element
    var taskId = $(e.relatedTarget).data('task-id');
    var taskName = $(e.relatedTarget).data('task-name');
    var skill = $(e.relatedTarget).data('skill');
    var level = $(e.relatedTarget).data('level');
    var duration = $(e.relatedTarget).data('duration');
    var firstName = $(e.relatedTarget).data('first-name');
    var lastName = $(e.relatedTarget).data('last-name');
    var status = $(e.relatedTarget).data('status');

    document.getElementById("edit-task-id").value = parseInt(taskId);
    document.getElementById("edit-task-name").value = taskName;
    document.getElementById("edit-skill").value = skill;
    document.getElementById("edit-level").value = level;
    document.getElementById("edit-duration").value = duration;
    document.getElementById("edit-assigned-to").value = firstName + ' ' + lastName;
    document.getElementById("edit-status").value = status;
  });
  $('#DeleteTask').on('shown.bs.modal', function (e) {
    //get data-id attribute of the clicked element
    var taskId = $(e.relatedTarget).data('task-id');
    var taskName = $(e.relatedTarget).data('task-name');
    document.getElementById('task-name').innerHTML = "Are you sure you want to delete task <i>" + taskName + "</i>?";
    document.getElementById("TaskIdInput").value = parseInt(taskId);
  });

