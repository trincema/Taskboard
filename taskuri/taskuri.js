(function() {
    'use strict';
    window.addEventListener('load', function() {
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
  $('#DeleteTask').on('shown.bs.modal', function (e) {
    //get data-id attribute of the clicked element
    var taskId = $(e.relatedTarget).data('task-id');
    var taskName = $(e.relatedTarget).data('task-name');
    document.getElementById('task-name').innerHTML = "Are you sure you want to delete task <i>" + taskName + "</i>?";
    document.getElementById("TaskIdInput").value = parseInt(taskId);
  })