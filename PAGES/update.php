<?php
include_once("../Connections/connection.php");
$con = connection();

if (isset($_POST['update'])) {
    $noteId = $_POST['edited_note_id'];
    $editedNotesTopic = $_POST['edited_notes_topic'];
    $editedNotesDescription = $_POST['edited_notes_description'];

    // Use prepared statements to prevent SQL injection
    $updateQuery = "UPDATE dashboard_note SET notes_topic = ?, notes_description = ? WHERE id = ?";
    
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("ssi", $editedNotesTopic, $editedNotesDescription, $noteId);
    
    $stmt->execute();

    // Close the statement
    $stmt->close();
}
?>