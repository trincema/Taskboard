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
          if (form.checkValidity() === false) {
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

