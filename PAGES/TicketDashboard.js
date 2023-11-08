const header = document.querySelector("header");
const menuToggler = document.querySelectorAll("#menu_Toggle");
menuToggler.forEach(toggler => {
  toggler.addEventListener("click", () => header.classList.toggle("showMenu"));
});



// Handle search input
$('#searchInput').on('input', function () {
    var searchTerm = $(this).val().toLowerCase();
    $('tbody tr').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
    });
});



// Handle cancel edit button click
$(document).on('click', '.cancel-edit-btn', function () {
    // Hide the Bootstrap modal
    $('#editModal').modal('hide');
});


// edit button

$(document).on('click', '.edit-btn', function (e) {
    e.preventDefault();
    var ticketId = $(this).data('id');
    var status = $(this).closest('tr').find('td:eq(2)').text();
    var priority = $(this).closest('tr').find('td:eq(6)').text();
    var subject = $(this).closest('tr').find('td:eq(7)').text();
    var contactName = $(this).closest('tr').data('contact-name');
    var contactPhoneNumber = $(this).closest('tr').data('contact-phone-number');
    var contactEmail = $(this).closest('tr').data('contact-email');
    var description = $(this).closest('tr').find('td:eq(8)').text();

    // Set values in the edit form
    $('#editTicketId').val(ticketId);
    $('#editPriority').val(priority);
    $('#editStatus').val(status);
    $('#editSubject').val(subject);
    $('#editContactName').val(contactName).prop('readonly', true);
    $('#editContactPhoneNumber').val(contactPhoneNumber).prop('readonly', true);
    $('#editContactEmailAddress').val(contactEmail).prop('readonly', true);
    $('#editDescription').val(description);

    // Show the Bootstrap modal
    $('#editModal').modal('show');
});

// Handle save edit button click
$(document).on('click', '.save-edit-btn', function () {
    // Get the contact field values
    var editedContactName = $('#editContactName').val();
    var editedContactPhoneNumber = $('#editContactPhoneNumber').val();
    var editedContactEmail = $('#editContactEmailAddress').val();



    // Update contact fields in the modal before hiding
    $('#editModal').on('hidden.bs.modal', function () {
        $('#editContactName').val(editedContactName);
        $('#editContactPhoneNumber').val(editedContactPhoneNumber);
        $('#editContactEmailAddress').val(editedContactEmail);
    });

    // Hide the Bootstrap modal
    $('#editModal').modal('hide');
});





// Handle delete button click
$(document).on('click', '.delete-btn', function () {
    if (confirm('Are you sure you want to delete this ticket?')) {
        // If the user confirms, submit the form
        $(this).closest('form').submit();
    }
});
